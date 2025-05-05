@extends('layouts.app')

@section('content')
<div class="mt-60">
<h3 class="mb-0 font-weight-semibold">Product List</h3></div>
<!-- product Listing -->
<div class="container justify-content-center mt-5 mb-50">
  
  <div class="row">
    @if(!empty($products) && $products->count())
    @foreach($products as $index => $arrList)
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="card-img-actions">
            <img src="{{ asset($arrList->image) }}" class="card-img img-fluid product-image" alt="{{ $arrList->name }}">
          </div>
        </div>

        <div class="card-body bg-light text-center">
          <div class="mb-2">
            <h6 class="font-weight-semibold mb-2">
              <a href="#" class="text-default mb-2" data-abc="true">{{ $arrList->name }}</a>
            </h6>
             
          </div>

          <!-- <h3 class="mb-0 font-weight-semibold">₹ {{ $arrList->price }}</h3> -->
          <span class="original-price font-weight-semibold">₹{{ number_format($arrList->price, 2) }}</span>
            <span class="discount-price font-weight-semibold">₹{{ $arrList->discount_price ? number_format($arrList->discount_price, 2) : number_format($arrList->price, 2) }}</span>
          <div class="text-muted mb-3"></div>
          <button type="button" class=" add-to-cart-btn btn bg-cart" data-id="{{ $arrList->id }}"><i class="fa fa-cart-plus mr-2"></i> Add to cart</button>
        </div>
      </div>
    </div>
    @endforeach
    @endif

  </div>
</div>
<script>
$(document).ready(function() {
    $('.add-to-cart-btn').click(function(e) {
        e.preventDefault();

        let productId = $(this).data('id');

        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: 1
            },
            success: function(response) { 
                $('#cart-count').text(response.cart_count);
                productDiv.find('.stock-count').text(response.new_stock);
            },
            error: function(xhr) {
                alert('Something went wrong!');
            }
        });
    });
});
</script>
@endsection