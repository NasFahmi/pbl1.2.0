<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Product as ProductData;
#[Layout('components/layouts/admin')]
#[Title('Product')]
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
