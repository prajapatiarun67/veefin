<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\product\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $data = array();
    public function __construct() {}

    public function index(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        $product = ProductModel::find($productId);

        $product->decrement('stock', 1);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            if (!$product) {
                return response()->json(['status' => 'error', 'message' => 'Product not found']);
            }
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += 1;
            } else {
                $cart[$productId] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "discount_price" => $product->discount_price,
                    "image" => $product->image,
                ];
            }
        }

        session()->put('cart', $cart);
        return response()->json([
            'status' => 'success',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'message' => 'Product added to cart'
        ]);
    }

    public function cart_view()
    {
        $this->data['title'] = "Cart Detail";
        $this->data['cart'] = Session::get('cart');
        return view('cart.list', $this->data);
    }

    public function cart_update(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;
        $quantity = (int)$request->quantity;

        if (isset($cart[$id])) {
            if ($quantity < 1) {
                unset($cart[$id]); // Optionally remove item if quantity < 1
            } else {
                $cart[$id]['quantity'] = $quantity;
            }

            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function cart_remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function order()
    {
        /* 
            -- this function used for clear sessin data
        */
        session()->forget('cart');
        return response()->json([
            'status' => 'success',
            'message' => 'Order placed successfully!',
            'redirect' => route('product')
        ]);
    }
}
