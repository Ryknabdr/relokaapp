<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Binafy\LaravelCart\Models\Cart;
use \Binafy\LaravelCart\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    private $cart;

    public function __construct(){
        $this->cart = Cart::query()->firstOrCreate(
            [
                'user_id' => auth()->guard('customer')->user()->id
            ]
        );
        \Log::info('CartController constructor: cart loaded', ['cart_id' => $this->cart->id, 'user_id' => auth()->guard('customer')->user()->id]);
    }

    public function add(Request $request)
    {
        // Validate the request
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', 'Invalid input data.')
                ->withErrors($validator)
                ->withInput();
        }

        // Find the product
        $product = Product::findOrFail($request->product_id);
        
        // Check if the product is available
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk produk ini.');
        }

        $cartItem = new CartItem([
            'itemable_id' => $product->id,
            'itemable_type' => $product::class,
            'quantity' => $request->quantity,
        ]);

        $this->cart->items()->save($cartItem);

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function remove($id)
    {
        $product = Product::findOrFail($id);

        \Log::info('Remove item from cart called', ['product_id' => $id, 'cart_id' => $this->cart->id]);

        // Solusi alternatif: hapus item keranjang secara manual
        $cartItem = $this->cart->items()->where('itemable_id', $product->id)->first();

        if ($cartItem) {
            \Log::info('Cart item found for deletion', ['cart_item_id' => $cartItem->id]);
            $cartItem->delete();
            \Log::info('Cart item deleted manually', ['cart_item_id' => $cartItem->id]);
        } else {
            \Log::warning('Cart item not found for deletion', ['product_id' => $product->id]);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function update($id, Request $request)
    {
        $cartItem = $this->cart->items()->where('itemable_id', $id)->first();

        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan di keranjang.');
        }

        $product = $cartItem->itemable;

        if($request->action == 'decrease')
        {
            $this->cart->decreaseQuantity(item: $cartItem);
        }else if($request->action == 'increase'){
            if($cartItem->quantity >= $product->stock){
                return redirect()->route('cart.index')->with('error', 'Jumlah produk melebihi stok yang tersedia.');
            }
            $this->cart->increaseQuantity(item: $cartItem);
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }
}
