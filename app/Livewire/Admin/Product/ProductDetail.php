<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components/layouts/admin')]
class ProductDetail extends Component
{
    public function render()
    {
        return view('livewire.admin.product.product-detail');
    }
}
