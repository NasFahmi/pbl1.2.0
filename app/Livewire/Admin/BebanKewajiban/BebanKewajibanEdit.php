<?php

namespace App\Livewire\Admin\BebanKewajiban;

use Livewire\Component;
use Illuminate\Support\Carbon;
use DateTime;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use App\Models\JenisBebanKewajiban;
use App\Models\BebanKewajiban as BebanKewajibanData;

#[Layout('components/layouts/admin')]
#[Title('Edit Beban Kewajiban')]
class BebanKewajibanEdit extends Component
{
    public $bebanKewajibanId;

    #[Validate('required', message: "Nama Harus Diisi")]
    public $nama;

    #[Validate('required|numeric', message: "Nominal Harus Berupa Angka")]
    public $nominal;

    #[Validate('required', message: "Tanggal Harus Diisi")]
    public $tanggal;

    public $jenisBebanKewajiban;
    public $addJenisBebanKewajian;

    #[Validate('required', message: "Jenis Harus Diisi")]
    public $jenisBebanKewajibanId;

    public function render()
    {
        $this->jenisBebanKewajiban = JenisBebanKewajiban::pluck('jenis_beban_kewajiban', 'id');
        return view('livewire.admin.beban-kewajiban.beban-kewajiban-edit');
    }
    public function mount($id)
    {
        $this->bebanKewajibanId = $id;
        $this->loadProduksi();
    }
    public function loadProduksi()
    {
        $bebanKewajibanData = BebanKewajibanData::findOrFail($this->bebanKewajibanId);
        // dd($bebanKewajibanData);
        $this->nama = $bebanKewajibanData->nama;
        $this->nominal = $bebanKewajibanData->nominal;
        $this->jenisBebanKewajibanId = $bebanKewajibanData->jenis_beban_kewajiban_id;
        // Menggunakan Carbon
        $this->tanggal = Carbon::parse($bebanKewajibanData->tanggal)->format('Y-m-d');

        // Atau menggunakan DateTime
        $datetime = new DateTime($bebanKewajibanData->tanggal);
        $this->tanggal = $datetime->format('Y-m-d');
    }
    public function update()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();
            $bebanKewajibanData = BebanKewajibanData::findOrFail($this->bebanKewajibanId);
            $bebanKewajibanData->update([
                'nama' => $validatedData['nama'],
                'nominal' => $validatedData['nominal'],
                'tanggal' => $validatedData['tanggal'],
                'jenis_beban_kewajiban_id' => $validatedData['jenisBebanKewajibanId']
            ]);

            activity()
                ->causedBy(auth()->user())
                ->performedOn($bebanKewajibanData)
                ->event('Edit_bebankewajiban')
                ->withProperties(['id' => $bebanKewajibanData->id])
                ->log('User ' . auth()->user()->nama . ' Edit data beban kewajiban');

            DB::commit();
            // dd('done');
            $this->resetInput();
            return redirect()->route('admin.beban-kewajiban')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menyimpan produk.');
        }
    }
    public function resetInput()
    {
        $this->nama = '';
        $this->nominal = '';
        $this->tanggal = '';
        $this->jenisBebanKewajibanId = '';
    }
}
