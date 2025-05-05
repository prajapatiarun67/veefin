@extends('layouts.app')

@section('content')
<form id="user-frm" class="" method="POST" action="{{ route('product.store') }}">
    <img class="mb-8" src="https://www.veefin.com/assets/imgs/logo.png" style="margin-bottom:12px" alt="" height="72">
    @csrf
    <div class="form-group row">
        <div class="col-md-6">
            <input type="text" id="productName" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Product Name" autofocus>
            @error('name')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <input type="text" id="productCode" name="product_code" class="form-control" value="{{ old('product_code') }}" placeholder="Enter Product Code">
            @error('product_code')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label for="price" class="sr-only">Price</label>
            <input type="text" id="price" name="price" class="form-control" value="{{ old('price') }}" placeholder="Enter Price">
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="discountPrice" class="sr-only">Discount Price</label>
            <input type="text" id="discountPrice" name="discount_price" class="form-control" value="{{ old('discount_price') }}" placeholder="Enter Discount Price">
            @error('discount_price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label for="stock" class="sr-only">Stock</label>
            <input type="text" id="stock" name="stock" class="form-control" value="{{ old('stock') }}" placeholder="Enter Stock" autocomplete="off">
            @error('stock')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="image" class="sr-only">Stock</label>
            <input type="file" id="image" name="image" class="form-control" value="{{ old('image') }}" placeholder="Select Image">
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <label for="description" class="sr-only">Description</label>
            <textarea rows="5" cols="3" id="description" name="description" class="form-control" placeholder="Enter Description">{{ old('description') }}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    
    <div class="form-group row">
        <div class="col-md-6">
            <a href="{{ route('product.list') }}"><button class="btn btn-lg btn-danger btn-block" type="button">Cancle</button></a>
        </div>
        <div class="col-md-6">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Add Product</button>
        </div>
    </div>
</form>

@endsection