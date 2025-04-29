<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductComponent extends Component
{
    public $products = [];
    public $categories = [];
    public $activeCategory = 'all';
    
    protected $listeners = ['refreshProducts' => '$refresh'];
    
    public function mount()
    {
        $this->loadCategories();
        $this->loadProducts();
    }
    
    private function loadCategories()
    {
        // Fetch categories from database
        $this->categories = DB::table('categories')
            ->where('visibility', 'visible')
            ->orderBy('display_order')
            ->get(['id', 'name', 'slug'])
            ->toArray();
    }
    
    private function loadProducts()
    {
        // Query to fetch featured products for homepage
        $query = DB::table('products')
            ->select(
                'products.id', 
                'products.name', 
                'products.slug', 
                'products.price', 
                'products.discount_price', 
                'products.image', 
                'products.category', 
                'products.description', 
                'products.tags', 
                'products.is_featured'
            )
            ->where('products.is_active', 1)
            ->where('products.deleted_at', null)
            ->orderBy('products.is_featured', 'desc')
            ->orderBy('products.created_at', 'desc')
            ->limit(8);
        
        $this->products = $query->get()->toArray();
        
        // Process the products to get additional data
        foreach ($this->products as $key => $product) {
            // Convert string tags to array
            $this->products[$key]->tags_array = !empty($product->tags) ? explode(',', $product->tags) : [];
            
            // Calculate discount percentage if applicable
            if (!empty($product->discount_price) && $product->discount_price > $product->price) {
                $discountAmount = $product->discount_price - $product->price;
                $discountPercentage = round(($discountAmount / $product->discount_price) * 100);
                $this->products[$key]->discount_percentage = $discountPercentage;
            } else {
                $this->products[$key]->discount_percentage = 0;
            }
        }
    }
    
    public function setCategory($category)
    {
        $this->activeCategory = $category;
    }
    
    public function addToCart($productId)
    {
        // Get product details from database
        $product = DB::table('products')
            ->where('id', $productId)
            ->where('is_active', 1)
            ->first(['id', 'name', 'price', 'image', 'stock']);
        
        if (!$product) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => 'Product not found!'
            ]);
            return;
        }
        
        // Check if product is in stock
        if ($product->stock <= 0) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => 'Product is out of stock!'
            ]);
            return;
        }
        
        // Add to cart session
        $cart = session()->get('cart', []);
        
        // Check if product already exists in cart
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1
            ];
        }
        
        session()->put('cart', $cart);
        
        // Emit event to update cart count in header
        $this->emit('cartUpdated');
        
        // Show notification
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => 'Product added to cart!'
        ]);
    }

    public function render()
    {
        return view('livewire.frontend.product-component', [
            'products' => $this->products,
            'categories' => $this->categories
        ]);
    }
    // public function render()
    // {
    //     return view('livewire.frontend.product-component');
    // }
}
