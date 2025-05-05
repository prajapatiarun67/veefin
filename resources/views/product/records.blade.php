@extends('layouts.app')

@section('content')
<!-- product Listing -->
<div class="container my-6" style="margin-top:180px">
    <div class="row">
        <h2 class="mb-4">Product List</h2>
        <div class="col-2">
            <a href="{{ route('product.create') }}">
                <button class="btn btn-lg btn-primary btn-block" type="button">Add Product</button>
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">Sr. No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($products) && count($products) > 0)

                @foreach($products as $key => $arrList)

                <tr class="cart-item" data-id="{{ $arrList->id }}">

                    <td>{{ $key + 1 }}</td>
                    <td>{{ $arrList->name }}</td>
                    <td>₹ {{ $arrList->price }}</td>
                    <td>₹ {{ $arrList->discount_price }}</td>
                    <td><img src="{{ asset($arrList->image) }}" class="img-thumbnail" alt="Product" style="width:25px; height: 35px; object-fit: cover;"></td>
                    <td>
                        <a href="{{ route('product.edit', ['product' => $arrList->id]) }}">Edit</a> |
                        <a onclick="confirmDelete()" href="{{ route('product.delete', ['product' => $arrList->id]) }}">Delete</a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6">
                        <center><i>No product(s) Found!</i></center>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
<script>
    function confirmDelete() {
      const confirmed = confirm("Are you sure you want to delete this?");
      /* if (confirmed) {
        // Add your deletion logic here
        alert("Item deleted successfully.");
      } */
    }
</script>

@endsection