<?php

namespace App\Livewire\Admin\Product;

use App\Models\Foto;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
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

    public $tersedia;

    public $existingImages = [];



    public function mount($id)
    {
        $this->productId = $id;

        $this->loadProduct();
        $this->loadExistingImages();
    }
    public function update()
    {
        $validatedData = $this->validate();
        $newSlug = Str::of($validatedData['nama_product'])->slug('-')->__toString();
        $oldSlug = Product::findOrFail($this->productId)->slug; // Mendapatkan slug lama

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($this->productId);
            $product->update([
                'nama_product' => $validatedData['nama_product'],
                'harga' => $validatedData['harga'],
                'slug' => $newSlug,
                'deskripsi' => $this->deskripsi,
                'link_shopee' => $validatedData['link_shopee'],
                'stok' => $validatedData['stok'],
                'spesifikasi_product' => $this->spesifikasi,
                'tersedia' => $this->tersedia,
            ]);

            // Membuat folder baru jika belum ada
            $newSlugFolderPath = 'public/images/product/' . $newSlug;
            if (!Storage::exists($newSlugFolderPath)) {
                Storage::makeDirectory($newSlugFolderPath);
                chmod(storage_path('app/' . $newSlugFolderPath), 0755);
            }

            // Memindahkan file gambar dari folder slug lama ke folder slug baru
            $oldSlugFolderPath = 'public/images/product/' . $oldSlug;
            if (Storage::exists($oldSlugFolderPath)) {
                $files = Storage::files($oldSlugFolderPath);
                foreach ($files as $file) {
                    $filename = pathinfo($file, PATHINFO_BASENAME);
                    Storage::move($file, $newSlugFolderPath . '/' . $filename);

                    // Perbarui path file gambar pada tabel Foto
                    Foto::where('foto', 'like', '%' . $oldSlug . '/%')
                        ->where('product_id', $this->productId)
                        ->update(['foto' => '/storage/images/product/' . $newSlug . '/' . $filename]);
                }
                Storage::deleteDirectory($oldSlugFolderPath); // Hapus folder slug lama
            }

            $this->resetInputFields();
            activity()
                ->causedBy(auth()->user())
                ->performedOn($product)
                ->event('update_product')
                ->withProperties(['data' => $product])
                ->log('User ' . auth()->user()->nama . ' update a product ');
            DB::commit();
            return redirect()->route('admin.product')->with('success', 'Data Berhasil Diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat memperbarui produk.');
        }
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
        $this->tersedia = $product->tersedia; // Inisialisasi nilai tersedia
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

    #[On('deleteImage')]
    public function deleteImage($idGambar)
    {
        // dd($idGambar);
        // Find the image by ID
        $image = Foto::findOrFail($idGambar);

        // Delete the image file from storage
        $path = $image->foto;
        $publicPath = str_replace('/storage/', '/public/', $path);
        Storage::delete($publicPath);

        // Delete the image record from the database
        $image->delete();

        // Refresh the $existingImages array
        $this->loadExistingImages();
    }
    public function render()
    {
        return view('livewire.admin.product.product-edit', [
            'images' => $this->existingImages,
        ])->title($this->nama_product);
    }
}
