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
    public $showDeletedData;

    public function mount()
    {
        $this->showDeletedData = false; // Atau false, tergantung kebutuhan Anda
    }

    public function render()
    {
        if ($this->showDeletedData) {
            $data = ProductData::onlyTrashed()->with(['fotos'])->paginate(12);
        } else {
            $data = ProductData::with(['fotos'])
                ->search($this->search)
                ->paginate(12);
        }
        $totalProduct = ProductData::count();
        // dd($totalProduct);
        return view('livewire.admin.product.product', compact('data', 'totalProduct'));
    }
    #[On('deleteProduct')]
    public function deleteProduct($idProduct)
    {
        $product = ProductData::findOrFail($idProduct);
        $product->update([
            'tersedia' => '0'
        ]);
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
