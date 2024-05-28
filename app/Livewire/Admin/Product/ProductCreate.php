<?php

namespace App\Livewire\Admin\Product;

use App\Models\Foto;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\ValidatedData;

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

        $validatedData = $this->validate();

        $slug = Str::of($validatedData['nama_product'])->slug('-')->__toString();
        try {
            DB::beginTransaction();
            $product = Product::create([
                'nama_product' => $validatedData['nama_product'],
                'harga' => $validatedData['harga'],
                'slug' => $slug,
                'deskripsi' => $this->deskripsi,
                'link_shopee' => $validatedData['link_shopee'],
                'stok' => $validatedData['stok'],
                'spesifikasi_product' => $this->spesifikasi,
                'tersedia' => '1',
            ]);

            $productId = $product->id;

            foreach ($validatedData['image'] as $image) {

                $slugFolderPath = 'public/images/product/' . $slug;
                if (!Storage::exists($slugFolderPath)) {
                    Storage::makeDirectory($slugFolderPath);
                    // Mengatur izin folder
                    $folderPermissions = 0755; // Atur izin sesuai kebutuhan Anda
                    chmod(storage_path('app/' . $slugFolderPath), $folderPermissions);
                }

                $sourcesPath = 'livewire-tmp/' . $image['tmpFilename'];

                $destinationPath = 'public/images/product/' . $slug . '/' . $image['tmpFilename'];
                Storage::copy($sourcesPath, $destinationPath);

                Foto::Create([ //! hanya bekerja di store, namun tidak bekerja di update
                    'foto' => '/storage/images/product/' . $slug . '/' . $image['tmpFilename'],
                    'product_id' => $productId,
                ]);
            }
            $this->resetInputFields();
            activity()
                ->causedBy(auth()->user())
                ->performedOn($product)
                ->event('create_product')
                ->withProperties(['data' => $product])
                ->log('User ' . auth()->user()->nama . ' create a product ');
            DB::commit();
            return redirect()->route('admin.product')->with('success', 'Data Berhasil Disimpan');
            // session()->flash('message', 'Produk berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
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
