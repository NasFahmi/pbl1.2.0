<?php

namespace App\Livewire\Admin\Product;

use App\Models\Foto;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

#[Layout('components/layouts/admin')]
class ProductEdit extends Component
{
    use WithFileUploads;

    public $productId;

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

    public $existingImages = [];

    public function mount($id)
    {
        $this->productId = $id;
        // dd($this->spesifikasi);
        $this->loadProduct();
        $this->loadExistingImages();
    }

    public function loadProduct()
    {
        $product = Product::with(['fotos'])->findOrFail($this->productId);
        // dd($product);
        $this->nama_product = $product->nama_product;
        $this->harga = $product->harga;
        $this->deskripsi = $product->deskripsi;
        $this->link_shopee = $product->link_shopee;
        $this->stok = $product->stok;
        $this->spesifikasi = $product->spesifikasi_product;
    }
    public function loadExistingImages()
    {
        $productFoto = Foto::where('product_id', $this->productId)->get();
        // dd($productFoto);
        $this->existingImages = $productFoto->map(function ($foto) {
            $path = $foto->foto;
            $fileName = basename($path);
            $publicPath = str_replace('/storage/', '/public/', $path);
            return [
                'id' => $foto->id,
                'name' => $fileName,
                'size' => Storage::size($publicPath),
                'temporaryUrl' => asset($path),
                'extension' => pathinfo($publicPath, PATHINFO_EXTENSION),
            ];
        })->toArray();
        // dd($this->existingImages);
    }
    public function render()
    {
        return view('livewire.admin.product.product-edit')->title($this->nama_product);
    }
}
