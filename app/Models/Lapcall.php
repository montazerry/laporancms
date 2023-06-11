<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapcall extends Model
{
    use HasFactory;

    protected $table = 'lapcalls';
    protected $fillable = ['user_id','debitur_id','debitur_rekening','code_id','tanggal','tanggal_janji','laporan'];
    public $timestamps = false;
    public function user(){
        return $this->BelongsTo(User::class);
    }

    public function debitur(){
        return $this->BelongsTo(Debitur::class);
    }

    public function code(){
        return $this->BelongsTo(Code::class);
    }
}
