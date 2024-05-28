<?php

namespace App\Livewire\Admin\BebanKewajiban;

use Livewire\Component;
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
        $data = BebanKewajibanData::where('jenis', 'like', "%{$this->searchTerm}%")
            ->orWhere('nama', 'like', "%{$this->searchTerm}%")
            ->paginate(10);
        return view('livewire.admin.beban-kewajiban.beban-kewajiban', compact('data'));
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
