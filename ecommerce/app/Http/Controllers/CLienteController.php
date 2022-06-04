<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CLienteController extends Controller
{
    private $venda;

    public function existe_venda_aberta(){
        $this->venda = Venda::with('produtos')->where([
            'user_id' => Auth::id(),
            'status' => 'aberta'
        ])->first();
        return $this->venda != null;
    }

    public function existe_produto_na_venda(){
      
        return $this->venda->produtos->contains($this->produto);
    }

    public function incrementar_produto_venta(){
        $quantidade = ($this->venda->produtos->find($this->produto->id)->pivot->quantidade) + 1;
        $this->vendas->produtos->updateExistingPivot($this->produto->id, ['quantidade' => $quantidade]);

    }

    public function abrir_venda(){
        $this->venda = Venda::create([
            'user_id' => Auth::id(),
            'total' => $this->produto->valor,
            'status' => 'aberta'
        ]);

        $this->vendas->produtos()->attach($this->produto->id, [
            'quantidade' => 1,
            'total_unitario' => $this->produto->valor
        ]);
    }

    public function remover_carrinho($id){
        Gate::authorize('acesso-cliente');
        $this->produto = $this->venda->produtos()->find($id);
        Venda::where('id', $this->venda->id)->update([
            'total' => $this->venda->total - $this->produto->pivot->total_unitario
        ]);

        if($this->produto->pivot->quantidade == 1){
            $this->venda->produtos()->deatach($this->produto->id);
        }
        else{
            $quantidade = $this->venda->produtos()->updateExistingPivot($this->produto->id, ['quantidade' => $quantidade]);
        }
        return redirect('/areacliente');
    }

    public function encerrar_compra($id){
        Gate::authorize("acesso-cliente");
        Venda::whereId($id)->update([
            'status' => 'fechada'
        ]);

        return redirect('/');
    }

    
}
