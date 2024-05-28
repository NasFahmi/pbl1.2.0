<?php

namespace App\Livewire\Admin\BebanKewajiban;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use App\Models\JenisBebanKewajiban;
use App\Models\BebanKewajiban as BebanKewajibanData;

#[Layout('components/layouts/admin')]
#[Title('Beban Kewajiban')]
class BebanKewajibanCreate extends Component
{

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
        return view('livewire.admin.beban-kewajiban.beban-kewajiban-create');
    }
    public function store()
    {

        $validatedData = $this->validate();

        try {
            DB::beginTransaction();

            $bebankewajiban = BebanKewajibanData::create([
                'nama' => $validatedData['nama'],
                'nominal' => $validatedData['nominal'],
                'tanggal' => $validatedData['tanggal'],
                'jenis_beban_kewajiban_id' => $validatedData['jenisBebanKewajibanId']
            ]);

            activity()
                ->causedBy(auth()->user())
                ->performedOn($bebankewajiban)
                ->event('tambah_bebankewajiban')
                ->withProperties(['id' => $bebankewajiban->id])
                ->log('User ' . auth()->user()->nama . ' tambah data beban kewajiban');

            DB::commit();
            // dd('done');
            $this->resetInput();
            return redirect()->route('admin.beban-kewajiban')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menyimpan produk.');
        }
    }
    public function addBebanKewajiban()
    {
        JenisBebanKewajiban::create([
            'jenis_beban_kewajiban' => $this->addJenisBebanKewajian
        ]);

        $this->addJenisBebanKewajian = '';

        $this->dispatch('close-modal');

        session()->flash('success', 'Berhasil Membuat Jenis Beban Kewajiban');
    }
    public function resetInput()
    {
        $this->nama = '';
        $this->nominal = '';
        $this->tanggal = '';
        $this->jenisBebanKewajibanId = '';
    }
}
