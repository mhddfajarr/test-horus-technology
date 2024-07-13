<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class History extends Component
{
    public $selectedCategory = null;
    public $data = [];
    public $totalCount = [
        'total' => 0,
        'food' => 0,
        'hotel' => 0,
    ];

    public function mount()
    {
        $this->fetchVouchers();
        $this->totalCount = $this->countTotalVouchers();
    }

    public function render()
    {
        return view('livewire.history', [
            'data' => $this->data,
            'totalCount' => $this->totalCount,
        ]);
    }


    private function getVoucherDetails($voucherClaims)
    {
        $vouchers = [];

        foreach ($voucherClaims as $claim) {
            $voucherResponse = Http::get('http://test-horus.test:8080/api/vouchers/' . $claim['id_voucher']);

            if ($voucherResponse->successful()) {
                $voucherData = $voucherResponse->json();
                if (is_array($voucherData) && isset($voucherData['data'])) {
                    $claim['voucher'] = $voucherData['data']; // Gabungkan data voucher dengan data voucher_claim
                    $vouchers[] = $claim;
                }
            }
        }

        return $vouchers;
    }

    public function fetchVouchers()
{
    // Ambil semua data voucher claim
    $response = Http::get('http://test-horus.test:8080/api/vouchersClaim');

    if ($response->successful()) {
        $voucherClaims = $response->json();
        if (is_array($voucherClaims) && isset($voucherClaims['data'])) {
            $filteredClaims = $voucherClaims['data'];

            // Jika ada kategori yang dipilih, filter data berdasarkan kategori di tabel voucher
            if ($this->selectedCategory) {
                $filteredClaims = array_filter($filteredClaims, function($claim) {
                    // Ambil detail voucher berdasarkan id_voucher di voucher claim
                    $voucherResponse = Http::get('http://test-horus.test:8080/api/vouchers/' . $claim['id_voucher']);
                    if ($voucherResponse->successful()) {
                        $voucherData = $voucherResponse->json();
                        // Cek apakah kategori sesuai dengan yang dipilih
                        return isset($voucherData['data']['kategori']) && $voucherData['data']['kategori'] === $this->selectedCategory;
                    }
                    return false;
                });
            }

            $this->data = $this->getVoucherDetails($filteredClaims);
        } else {
            $this->data = []; // Jika data tidak sesuai, set data menjadi array kosong
        }
    } else {
        $this->data = []; // Jika request gagal, set data menjadi array kosong
    }
}

    public function delete($id)
    {
        $response = Http::delete('http://test-horus.test:8080/api/vouchersClaim/' . $id);
        if ($response->successful()) {
            $this->fetchVouchers();
            $this->totalCount = $this->countTotalVouchers();
        }
    }

    
    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->fetchVouchers(); 
    }

    private function countTotalVouchers()
    {   
        // Ambil semua data voucher claim
        $getData = Http::get('http://test-horus.test:8080/api/vouchersClaim');
        
        if ($getData->successful()) {
            $data = $getData->json(); 
        } else {
            return [
                'total' => 0,
                'food' => 0,
                'hotel' => 0,
            ]; // Kembali dengan nilai nol jika request gagal
        }

        $allVoucher = count($data['data']);
        $voucherFood = 0;
        $voucherHotel = 0;

        foreach ($data['data'] as $voucherClaim) {
            // Ambil data voucher terkait
            $voucherResponse = Http::get('http://test-horus.test:8080/api/vouchers/' . $voucherClaim['id_voucher']);
            if ($voucherResponse->successful()) {
                $voucherData = $voucherResponse->json();

                // Hitung kategori berdasarkan data voucher
                if (isset($voucherData['data']['kategori'])) {
                    if ($voucherData['data']['kategori'] == 'food') {
                        $voucherFood++;
                    } elseif ($voucherData['data']['kategori'] == 'hotel') {
                        $voucherHotel++;
                    }
                }
            }
        }

        return [
            'total' => $allVoucher,
            'food' => $voucherFood,
            'hotel' => $voucherHotel,
        ];
    }
}
