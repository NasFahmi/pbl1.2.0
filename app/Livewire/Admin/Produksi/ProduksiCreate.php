<?php

namespace App\Livewire\Admin\Produksi;

use Livewire\Component;
use App\models\Produksi as ProduksiData;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

#[Layout('components/layouts/admin')]
#[Title('Produksi')]
class ProduksiCreate extends Component
{
    #[Validate('required', message: "Nama Produk Tidak Boleh Kosong")]
    public $produk;

    #[Validate('required|numeric', message: "Jumlah Harus Berupa Angka")]
    public $jumlah;

    #[Validate('required|numeric', message: "volume Harus Berupa Angka")]
    public $volume;

    #[Validate('required', message: "Tanggal Harus Diisi")]
    public $tanggal;


    public function store()
    {
        $validatedData = $this->validate();
        // dd($validatedData);
        try {
            DB::beginTransaction();

            $produksi = ProduksiData::create([
                'produk' => $validatedData['produk'],
                'volume' => $validatedData['volume'],
                'jumlah' => $validatedData['jumlah'],
                'tanggal' => $validatedData['tanggal'],
            ]);

            activity()
                ->causedBy(auth()->user())
                ->performedOn($produksi)
                ->event('tambah_produksi')
                ->withProperties(['id' => $produksi->id])
                ->log('User ' . auth()->user()->nama . ' tambah a produksi');

            DB::commit();
            // dd('done');
            $this->resetInput();
            return redirect()->route('admin.produksi')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menyimpan produk.');
        }
    }

    public function resetInput()
    {
        $this->produk = null;
        $this->volume = null;
        $this->jumlah = null;
        $this->tanggal = null;
    }
    public function render()
    {
        return view('livewire.admin.produksi.produksi-create');
    }
}
