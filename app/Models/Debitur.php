<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debitur extends Model
{
    use HasFactory;
    protected $fillable = ['rekening','spk','nama','flafond','outstanding','tunggakanbln','jkw','angsuran','total_angsuran','kecamatan','kelurahan'];
    public $timestamps = false;

    public function LapCall()
    {
    	return $this->hasMany(LapCall::class);
    }
}
