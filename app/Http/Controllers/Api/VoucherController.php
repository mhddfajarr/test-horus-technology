<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        $data = Voucher::All();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendapatkan data Voucher',
            'data' => $data
        ], 200);
    }

    //mendapatkan voucher yang active saja
    public function index(Request $request)
    {
        // Ambil input kategori dari request
        $category = $request->input('kategori');

        // Validasi kategori
        if ($category && !in_array($category, ['food', 'hotel'])) {
            return response()->json([
                'status' => false,
                'message' => 'Kategori tidak valid'
            ], 400); // 400 Bad Request jika kategori tidak valid
        }

        // Query data vouchers berdasarkan kategori jika kategori diberikan
        $vouchers = $category ? Voucher::where('kategori', $category)->where('status', 1)->get() : Voucher::where('status', 1)->get();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendapatkan data voucher',
            'data' => $vouchers
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'nama' => 'required|max:100|min:3',
            'kategori' => 'required',
            'status' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        $voucher = new Voucher();
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan data voucher',
                'data' => $validator->errors()
            ],422);
        }
        $voucher->nama = $request->nama;
        $voucher->foto = $request->foto;
        $voucher->kategori = $request->kategori;
        $voucher->status = $request->status;

        $store = $voucher->save();

        return response()->json([
            'status'=>true,
            'message'=> 'berhasil menambahkan voucher baru'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Voucher::find($id);
        if($data){
            return response()->json([
                'status' => true,
                'message' => 'Data voucher berhasil ditemukan',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=> 'Data voucher tidak ditemukan'
            ],400);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $voucher = Voucher::find($id);

        if(empty($voucher)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }
        $rules = [
            'nama' => 'required|max:100|min:3',
            'kategori' => 'required',
            'status' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Gagal update data voucher',
                'data' => $validator->errors()
            ],422);
        }
        $voucher->nama = $request->nama;
        $voucher->foto = $request->foto;
        $voucher->kategori = $request->kategori;
        $voucher->status = $request->status;

        $update = $voucher->save();

        return response()->json([
            'status'=>true,
            'message'=> 'Berhasil update voucher baru'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::find($id);

        if(empty($voucher)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $delete = $voucher->delete();

        return response()->json([
            'status'=>true,
            'message'=> 'Berhasil menghapus voucher '
        ],200);
    }
}
