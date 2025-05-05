<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\createProduct;
use App\Http\Requests\product\updateProduct;
use App\Models\product\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductListController extends Controller
{
    protected $data = array();

    public function __construct()
    {
        $this->data['cart'] = Session::has('cart') ? Session::get('cart') : 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = "Product";
        $this->data['css']      = array('product.css');
        $this->data['products'] = $products = ProductModel::select('id', 'name', 'product_code', 'description', 'price', 'discount_price', 'image', 'stock')
                                    ->where('is_active', 1)
                                    ->withoutTrashed()
                                    ->get(); 
        $this->data['cart'] = Session::has('cart') ? Session::get('cart') : 0;
        return view('product.list', $this->data);
    }

    public function list(Request $request)
    {
        $this->data['title'] = "Product";
        $this->data['products'] = $products = ProductModel::select('id', 'name', 'product_code', 'description', 'price', 'discount_price', 'image', 'stock')
                                    ->where('is_active', 1)
                                    ->withoutTrashed()
                                    ->get(); 
        $this->data['css'] = array('signin.css');
        return view('product.records', $this->data);
    }

    public function create()
    {
        $this->data['title'] = "Create Product";
        $this->data['css'] = array('signin.css');
        $this->data['cart'] = Session::has('cart') ? Session::get('cart') : 0;
        return view('product.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createProduct $createProduct)
    {
        $imageName = time() . '_' . $createProduct->file('image')->getClientOriginalName();
        $createProduct->file('image')->move(public_path('uploads/products'), $imageName);
       
        $product = ProductModel::create([
            'name' => $createProduct->name,
            'product_code' => $createProduct->product_code,
            'description' => $createProduct->description,
            'price' => $createProduct->price,
            'stock' => $createProduct->stock,
            'image' => 'uploads/products/' . $imageName,
            'discount_price' => $createProduct->discount_price,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Product added successfully",
            'redirect' => route('product.list'),
            'type' => "alert"
        ], 201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductModel $product)
    {
        $this->data['title'] = "Edit Product";
        $this->data['css'] = array('signin.css');
        $this->data['product'] = $product;
        return view('product.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateProduct $updateProduct, $id)
    {

        
        $update = array();
        $update['name'] = $updateProduct->name;
        $update['product_code'] = $updateProduct->product_code;
        $update['description'] = $updateProduct->description;
        $update['price'] = $updateProduct->price;
        $update['stock'] = $updateProduct->stock;
        $update['discount_price'] = $updateProduct->discount_price;

        if ($updateProduct->hasFile('image')) {
            $imageName = time() . '_' . $updateProduct->file('image')->getClientOriginalName();
            $updateProduct->file('image')->move(public_path('uploads/products'), $imageName);
            $update['image'] = 'uploads/products/' . $imageName;
        }

        ProductModel::where('id', $id)->update($update);
        return response()->json([
            'success' => true,
            'message' => "Product updated successfully",
            'redirect' => route('product.list'),
            'type' => "alert"
        ], 201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ProductModel::find($id);
        if ($product) {
            $product->delete();
        }
        return redirect('/product/list')->with('message', 'Product deleted successfully');
    }
}
