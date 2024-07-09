<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vouchers')->delete();
        $data = [
            array('id' => 1,'nama' => 'Diskon 10%' ,'foto' => 'images/item1.png', 'kategori' => "food"),
		    array('id' => 2,'nama' => 'Diskon 20%' ,'foto' => 'images/item2.png', 'kategori' => "hotel"),
            array('id' => 3,'nama' => 'Diskon 30%' ,'foto' => 'images/item3.png', 'kategori' => "food"),
		    array('id' => 4,'nama' => 'Diskon 40%' ,'foto' => 'images/item4.png', 'kategori' => "hotel"),
            array('id' => 5,'nama' => 'Diskon 50%' ,'foto' => 'images/item5.png', 'kategori' => "food"),
		    array('id' => 6,'nama' => 'Diskon 60%' ,'foto' => 'images/item6.png', 'kategori' => "hotel"),
            array('id' => 7,'nama' => 'Diskon 70%' ,'foto' => 'images/item7.png', 'kategori' => "food"),
    ];

    // Memasukkan data ke dalam tabel 'states'
    DB::table('vouchers')->insert($data);
    }
}
