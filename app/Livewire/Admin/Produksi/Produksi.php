<?php

namespace App\Livewire\Admin\Produksi;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\Produksi as ProduksiData;

#[Layout('components/layouts/admin')]
#[Title('Produksi')]
class Produksi extends Component
{

    use WithPagination;

    public $searchTerm = '';
    public function render()
    {
        $data = ProduksiData::where('produk', 'like', "%{$this->searchTerm}%")
            ->paginate(10);
        // dd($data);
        return view('livewire.admin.produksi.produksi', compact('data'));
    }
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    // nama livewire dispact dari js nya harus sama dengna fungsinya
    #[On('deleteProduksi')]
    public function deleteProduksi($idProduksi)
    {
        // dd($idProduksi);
        $produksi = ProduksiData::findOrFail($idProduksi);
        // Hapus produk
        $produksi->delete();

        // Opsional: Tambahkan logika tambahan setelah penghapusan, seperti notifikasi atau redirect
        session()->flash('message', 'Product deleted successfully.');
    }
}
