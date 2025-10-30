<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductSelection extends Component
{
    // Add a listener for the product selection event
    protected $listeners = ['USER_SELECT_PRODUCT_EVENT' => 'selectProduct'];
    
    public function selectProduct($productId)
    {
        // Handle the product selection event
        // This is just a placeholder that could be expanded to add items to a cart, etc.
        $product = Product::find($productId);
        if ($product) {
            session()->flash('message', $product->name . ' added to cart!');
        } else {
            session()->flash('message', 'Product added to cart!');
        }
    }
    
    public function render()
    {
        return view('livewire.product-selection');
    }
}
