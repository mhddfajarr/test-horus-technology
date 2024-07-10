<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class VoucherIndex extends Component
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
        // Load data awal ketika komponen pertama kali di-render
        $this->fetchVouchers();
        $this->totalCount = $this->countTotalVouchers();
    }
    public function render()
    {
        return view('livewire.voucher-index', [
            'title' => "Voucher",
            'data' => $this->data,
            'totalCount' => $this->totalCount,
        ]);
    }

    private function countTotalVouchers()
    {   
        $getData = Http::get('http://test-horus.test:8080/api/vouchers');
        
        if ($getData->successful()) {
            $data = $getData->json(); 
        } 

        $allVoucher = count($data['data']);
        $voucherFood = 0;
        $voucherHotel = 0;

        foreach ($data['data'] as $voucher) {
            if ($voucher['kategori'] == 'food') {
                $voucherFood++;
            }
            if ($voucher['kategori'] == 'hotel') {
                $voucherHotel++;
            }
        }

        return [
            'total' => $allVoucher,
            'food' => $voucherFood,
            'hotel' => $voucherHotel,
        ];
    }

    public function fetchVouchers()
    {
        $url = 'http://test-horus.test:8080/api/vouchers';

        // Tambahkan parameter kategori jika dipilih
        if ($this->selectedCategory) {
            $url .= '?kategori=' . $this->selectedCategory;
        }
        
        $response = Http::get($url);

        if ($response->successful()) {
            $this->data = $response->json();
        } else {
            $this->data = []; 
        }
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->fetchVouchers(); 
    }


    public function claim($id){
        $response = Http::post('http://test-horus.test:8080/api/vouchersClaim?id_voucher=' . $id);
        if ($response->successful()) {
            $this->fetchVouchers();
            $this->totalCount = $this->countTotalVouchers();
        }
    }
    

}
