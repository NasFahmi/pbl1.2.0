<?php

namespace App\Livewire\Admin\BebanKewajiban;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components/layouts/admin')]
#[Title('Beban Kewajiban')]
class BebanKewajibanCreate extends Component
{
    public function render()
    {
        return view('livewire.admin.beban-kewajiban.beban-kewajiban-create');
    }
}
