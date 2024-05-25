<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components/layouts/admin')]
class ProductCreate extends Component
{
    public function render()
    {
        return view('livewire.admin.product.product-create');
    }
}
