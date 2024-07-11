<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class History extends Component
{
    public $selectedCategory = null;
    public $data = [];

    public function mount()
    {
        $this->fetchVouchers();
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
        $url = 'http://test-horus.test:8080/api/vouchersClaim';

        
        if ($this->selectedCategory) {
            $url .= '?kategori=' . $this->selectedCategory;
        }
        
        $response = Http::get($url);

        if ($response->successful()) {
            $voucherClaims = $response->json();
            if (is_array($voucherClaims) && isset($voucherClaims['data'])) {
                $this->data = $this->getVoucherDetails($voucherClaims['data']);
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
        }
    }

    public function render()
    {
        return view('livewire.history', ['data' => $this->data]);
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->fetchVouchers(); 
    }
}
