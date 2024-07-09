<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(){

        $response = Http::get('http://test-horus.test:8080/api/vouchers');

        if ($response->successful()) {
            $data = $response->json(); 
        } else {
            $data = []; 
        }

        // dd($data);
        return view('voucher', [
            'title' => "Voucher",
            'data' => $data
        ]);
    }
}
