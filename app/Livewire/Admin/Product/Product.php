<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product as ProductData;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
#[Layout('components/layouts/admin')]
class Product extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $data = ProductData::with(['fotos', 'varians'])
            ->search($this->search)
            ->where('tersedia', 1)
            ->paginate(12);

        $totalProduct = ProductData::where('tersedia', 1)->sum('tersedia');

        return view('livewire.admin.product.product', compact('data', 'totalProduct'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
