<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\User;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
Use App\Models\Venda;

class Graficos extends BaseChart
{
    
    public ?string $name = "grafico";

    #public ?array $middlewares = ['adm'];

    public function handler(Request $request): Chartisan
    {
        $sales = Venda::OrderBy('update_at')->pluck('total', 'update_at');
        $keys = collect($sales->keys())->map(function ($item, $key){
            return date('d/m/Y H:i:s', strtotime($item));
        })->all();

        $values = $sales->values();

        return Chartisan::build()
            ->labels($keys)
            ->dataset('Sample', $values->toArray());
            #->dataset('Sample 2', [3, 2, 1]);
    }
}