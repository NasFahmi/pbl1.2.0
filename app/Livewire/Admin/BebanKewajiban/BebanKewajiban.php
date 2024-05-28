<?php

namespace App\Livewire\Admin\BebanKewajiban;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\BebanKewajiban as BebanKewajibanData;

#[Layout('components/layouts/admin')]
#[Title('Beban Kewajiban')]
class BebanKewajiban extends Component
{
    use WithPagination;

    public $searchTerm = '';

    public function render()
    {
        $data = BebanKewajibanData::with(['jenis_beban_kewajiban'])->where('nama', 'like', "%{$this->searchTerm}%")
            ->orWhere('nama', 'like', "%{$this->searchTerm}%")
            ->paginate(10);
        // dd($data->jenis_beban_kewajiban);
        return view('livewire.admin.beban-kewajiban.beban-kewajiban', compact('data'));
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    // nama livewire dispact dari js nya harus sama dengna fungsinya
    #[On('deleteBebanKewajiban')]
    public function deleteBebanKewajiban($idBebanKewajiban)
    {

        $dataBebanKewajiban = BebanKewajibanData::findOrFail($idBebanKewajiban);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($dataBebanKewajiban)
            ->event('delete_beban_kewajiban')
            ->withProperties(['id' => $dataBebanKewajiban->id])
            ->log('User ' . auth()->user()->nama . ' delete data beban kewajiban');

        // Hapus beban kwajiban
        $dataBebanKewajiban->delete();

        // Opsional: Tambahkan logika tambahan setelah penghapusan, seperti notifikasi atau redirect
        session()->flash('message', 'Product deleted successfully.');
    }
}
