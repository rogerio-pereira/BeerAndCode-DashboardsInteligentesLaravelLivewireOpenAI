<?php

namespace App\Livewire;

use App\Models\SalesCommission;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class Dashboard extends Component
{
    public array $config;
    public string $question;
    public array $data;

    protected $rules = [
        'question' => 'required|min:10'
    ];

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function generateReport()
    {
        $this->validate();

        $fields = implode(',', SalesCommission::getColumns());
        $question = 'Gere um grafico das vendas por empresa no eixo y ao longo dos ultimos 5 anos';

        $this->config = OpenAI::completions()
                    ->create([
                        'model' => 'text-davinci-003',
                        'prompt' => "Considerando a lista de campos ({$fields}), gere uma configuracao json do Vega-lite v5 (sem campos de dados e com descricao) que atenda o seguinte pedido {$question}. Resposta:",
                        'max_tokens' => 1500,
                    ])
                    ->choices[0]
                    ->text;

        $this->config = str_replace("\n", '', $this->config);
        $this->config = json_decode($this->config, true);

        $data = SalesCommission::get()
                    ->toArray();

        $this->dataset = [
                'values' => $data
            ];

        return $this->config;
    }
}
