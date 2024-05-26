<?php

namespace App\Livewire\Admin\Product;

use Illuminate\Contracts\Support\ValidatedData;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components/layouts/admin')]
#[Title('Create Product')]
class ProductCreate extends Component
{
    use WithFileUploads;

    #[Validate('required', message: "Nama Produk Tidak Boleh Kosong")]
    public $nama_product;

    #[Validate('required|numeric', message: "Harga Harus Berupa Angka")]
    public $harga;

    // #[Validate('required', message: "Deskripsi Produk Tidak Boleh Kosong")]
    public $deskripsi;

    #[Validate('required|url', message: "Link Shopee Harus Berupa URL yang Valid")]
    public $link_shopee;

    #[Validate('required|numeric', message: "Stok Harus Berupa Angka")]
    public $stok;

    // #[Validate('required', message: "Spesifikasi Produk Tidak Boleh Kosong")]
    public $spesifikasi;

    #[Validate('required', message: "Gambar Produk Tidak Boleh Kosong")]
    public $image;


    public function render()
    {
        return view('livewire.admin.product.product-create');
    }
    public function store()
    {
        // dd('test');
        $validatedData = $this->validate();
        dd($this->spesifikasi);
        try {
            $product = Product::create([
                'nama_product' => $validatedData['nama_product'],
                'harga' => $validatedData['harga'],
                'deskripsi' => $validatedData['deskripsi'],
                'link_shopee' => $validatedData['link_shopee'],
                'stok' => $validatedData['stok'],
                'spesifikasi_product' => $validatedData['spesifikasi'],
            ]);
    
            if ($this->image) {
                $imagePath = $this->image->store('product_images', 'public');
                $product->image()->create([
                    'path' => $imagePath,
                ]);
            }
    
            $this->resetInputFields();
            session()->flash('message', 'Produk berhasil disimpan.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan produk.');
        }
    }

    private function resetInputFields()
    {
        $this->nama_product = '';
        $this->harga = '';
        $this->deskripsi = '';
        $this->link_shopee = '';
        $this->stok = '';
        $this->spesifikasi = '';
        $this->image = [];
    }
}
