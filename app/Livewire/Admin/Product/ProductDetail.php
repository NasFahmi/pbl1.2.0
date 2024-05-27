<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components/layouts/admin')]
class ProductDetail extends Component
{
    public $productId;
    public $product;

    public function mount($id)
    {
        $this->productId = $id;
        $this->loadProduct();
    }

    public function loadProduct()
    {
        $this->product = Product::with(['fotos'])->findOrFail($this->productId);
    }
    public function render()
    {
        return view('livewire.admin.product.product-detail', [
            'product' => $this->product,
        ])->title($this->product->nama_product);
    }
}
