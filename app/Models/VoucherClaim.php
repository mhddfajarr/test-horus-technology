<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherClaim extends Model
{
    use HasFactory;
    protected $table = 'voucher_claims';
    protected $guarded = ['id'];

    public function Voucher(){
        return $this->belongsTo(Voucher::class);
    }

}
