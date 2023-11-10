<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public string $resource;
    public array $columns;
    public string $edit;
    public string $delete;

    public function render()
    {
        $items = app("App\Models\\". $this->resource)
                    ->paginate(10);

        return view('livewire.table', compact('items'));
    }
}
