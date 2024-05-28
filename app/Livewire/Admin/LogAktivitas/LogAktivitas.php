<?php

namespace App\Livewire\Admin\LogAktivitas;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Spatie\Activitylog\Models\Activity;

#[Layout('components/layouts/admin')]
#[Title('Log Aktivitas')]
class LogAktivitas extends Component
{
    use WithPagination;

    public $actor = [];


    public function render()
    {
        $data = Activity::latest()->paginate(10);

        foreach ($data as $item) {
            $subject = User::find($item->causer_id);
            $this->actor[] = $subject->nama;
        }
        return view('livewire.admin.log-aktivitas.log-aktivitas');
    }
}
