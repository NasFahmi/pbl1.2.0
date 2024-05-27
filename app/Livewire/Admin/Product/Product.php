<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Product as ProductData;
use Livewire\Attributes\On;

#[Layout('components/layouts/admin')]
#[Title('Product')]
class Product extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $data = ProductData::with(['fotos'])
            ->search($this->search)
            ->where('tersedia', 1)
            ->paginate(12);

        $totalProduct = ProductData::where('tersedia', 1)->sum('tersedia');

        return view('livewire.admin.product.product', compact('data', 'totalProduct'));
    }
    #[On('deleteProduct')]
    public function deleteProduct($idProduct)
    {
        $product = Product::findOrFail($idProduct);

        // Hapus produk
        $product->delete();

        // Opsional: Tambahkan logika tambahan setelah penghapusan, seperti notifikasi atau redirect
        session()->flash('message', 'Product deleted successfully.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
