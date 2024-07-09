<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class VoucherIndex extends Component
{
    public $selectedCategory = null;
    public $data = [];

    public function mount()
    {
        // Load data awal ketika komponen pertama kali di-render
        $this->fetchVouchers();
    }
    public function render()
    {
        return view('livewire.voucher-index', [
            'title' => "Voucher",
            'data' => $this->data
        ]);
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
            $this->data = []; // Jika request gagal, set data menjadi array kosong
        }
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->fetchVouchers(); // Panggil method untuk memuat ulang data berdasarkan kategori baru
    }


    public function claim($id){
        $response = Http::post('http://test-horus.test:8080/api/vouchersClaim?id_voucher=' . $id);
        if ($response->successful()) {
            $this->fetchVouchers();
        }
    }
    

}
