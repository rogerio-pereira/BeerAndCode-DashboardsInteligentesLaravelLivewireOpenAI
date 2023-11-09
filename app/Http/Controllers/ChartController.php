<?php

namespace App\Http\Controllers;

use App\Models\SalesCommission;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChartController extends Controller
{
    public function index()
    {
        $fields = implode(',', SalesCommission::getColumns());
        $question = 'Gere um grafico das vendas por empresa no eixo y ao longo dos ultimos 5 anos';
        
        $config = OpenAI::completions()
                    ->create([
                        'model' => 'text-davinci-003',
                        'prompt' => "Considerando a lista de campos ({$fields}), gere uma configuracao json do Vega-lite v5 (sem campos de dados e com descricao) que atenda o seguinte pedido {$question}. Resposta:",
                        'max_tokens' => 1500,
                    ])
                    ->choices[0]
                    ->text;
        
        dd($config);
    }
}
