<?php

namespace App\Livewire\Admin\Produksi;

use Livewire\Component;
use App\Models\Produksi as ProduksiData;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

class ProduksiEdit extends Component
{

    public $produksiId;

    #[Validate('required', message: "Nama Produk Tidak Boleh Kosong")]
    public $produk;

    #[Validate('required|numeric', message: "Jumlah Harus Berupa Angka")]
    public $jumlah;

    #[Validate('required|numeric', message: "volume Harus Berupa Angka")]
    public $volume;

    #[Validate('required', message: "Tanggal Harus Diisi")]
    public $tanggal;

    public function render()
    {
        return view('livewire.admin.produksi.produksi-edit');
    }
    public function mount($id)
    {
        $this->produksiId = $id;
        $this->loadProduksi();
    }
    public function loadProduksi()
    {
        $produksiData = ProduksiData::findOrFail($this->produksiId);
        $this->produk = $produksiData->produk;
        $this->jumlah = $produksiData->jumlah;
        $this->volume = $produksiData->volume;
        $this->tanggal = $produksiData->tanggal;
    }
    public function update()
    {
        $validatedData = $this->validate();
        // dd($validatedData);
        try {
            DB::beginTransaction();
            $produksiData = ProduksiData::findOrFail($this->produksiId);
            $produksiData->update([
                'produk' => $validatedData['produk'],
                'volume' => $validatedData['volume'],
                'jumlah' => $validatedData['jumlah'],
                'tanggal' => $validatedData['tanggal'],
            ]);

            activity()
                ->causedBy(auth()->user())
                ->performedOn($produksiData)
                ->event('update_produksi')
                ->withProperties(['id' => $produksiData->id])
                ->log('User ' . auth()->user()->nama . ' update a produksi');

            DB::commit();
            // dd('done');
            $this->resetInput();
            return redirect()->route('admin.produksi')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menyimpan produk.');
        }
    }
}
