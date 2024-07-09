<?php

namespace App\Http\Controllers\api;

use App\Models\Voucher;
use App\Models\VoucherClaim;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class VoucherClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = VoucherClaim::All();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendapatkan data voucher claim',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //ambil data di voucher claims untuk menyimpan id nya untuk pengecekan selanjutnya
        $getDataVoucherClaim = Http::get('http://test-horus.test:8080/api/vouchersClaim');
        if ($getDataVoucherClaim->successful()) {
            $dataVoucherClaim = $getDataVoucherClaim->json();
            $voucherClaimId = array_column($dataVoucherClaim['data'], 'id_voucher');
        }

        $rules = [
            'id_voucher' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed', 
                'errors' => $validator->errors()
            ], 422);
        }

        $voucherClaim = new VoucherClaim();
        $getDataVoucher =  Http::get('http://test-horus.test:8080/api/AllVouchers');
        if ($getDataVoucher->successful()) {
            $data = $getDataVoucher->json();
            $tanggalClaim = now();
            $voucherIds = array_column($data['data'], 'id');
            if (in_array($request->id_voucher, $voucherIds)) {
                if(in_array($request->id_voucher, $voucherClaimId)){
                    return response()->json([
                        'status' => false,
                        'message' => 'Data voucher sudah diclaim', 
                    ], 400);
                }
                $voucherClaim->id_voucher = $request->id_voucher;
                $voucherClaim->tanggal_claim = $tanggalClaim;
                $store = $voucherClaim->save();

                $getDataVoucherById = Http::get('http://test-horus.test:8080/api/vouchers/' . $request->id_voucher);
                if ($getDataVoucherById->successful()) {
                    $dataVoucherById = $getDataVoucherById->json();
                }
                
                $updateStatusVoucher = Http::put('http://test-horus.test:8080/api/vouchers/' . $request->id_voucher, [
                    'nama' => $dataVoucherById['data']['nama'],
                    'foto' => $dataVoucherById['data']['foto'],
                    'kategori' => $dataVoucherById['data']['kategori'],
                    'status' => 0,
                ]);

                    if($updateStatusVoucher->successful()){
                        return response()->json([
                            'status' => true,
                            'message' => 'Berhasil menambahkan data voucher claim', 
                        ], 200);
                    }else{
                        return response()->json('message');
                    }

               
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data voucher tidak ditemukan',
                ], 404);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}