<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $fillable = ['total', 'user_id', 'status'];

    public function produtos(){
        return $this->belongsToMany(Produto::class, 'produto_vendas', 'venda_id', 'produto_id',)
        ->withPivot('total_unitario', 'quantidade')
        ->withTimestamps();
    }
}
