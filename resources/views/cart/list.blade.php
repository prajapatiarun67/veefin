@extends('layouts.app')

@section('content')
<div class="mt-60">
  <h3 class="mb-0 font-weight-semibold">Product List</h3>
</div>

<!-- Cart Listing -->


<div class="container my-5">
  <h2 class="mb-4">Your Shopping Cart</h2>
  @php
  $grandTotal = 0;
  @endphp
  <div class="table-responsive">
    <table class="table align-middle">
      <thead class="table-light">
        <tr>
          <th scope="col">Product</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Quantity</th>
          <th scope="col">Subtotal</th>
          <th scope="col">Remove</th>
        </tr>
      </thead>
      <tbody>
        @if(!empty($cart) && count($cart) > 0)

        @foreach($cart as $key => $value)
        @php
        $price = $value['discount_price'] ? $value['discount_price'] : $value['price'];
        $grandTotal += $value['quantity'] * $price;
        @endphp
        <tr class="cart-item" data-id="{{ $value['id'] }}">
          <td><img src="{{ asset($value['image']) }}" class="img-thumbnail" alt="Product" style="width:50px; height: 70px; object-fit: cover;"></td>
          <td>{{ $value['name'] }}</td>
          <td>₹ {{ $price }}</td>
          <td>
            <input type="number" class="form-control quantity" value="{{ $value['quantity'] }}" min="1" style="width: 80px;">
          </td>
          <td>
            ₹ {{ ($value['quantity'] * $price) }}
          </td>
          <td>
            <button class="btn btn-sm btn-danger remove-item">×</button>
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

  <div class="row justify-content-end">
    <div class="col-md-8">
      <a href="{{ route('product') }}">Continue Shopping</a>
    </div>
    <div class="col-md-4">
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between">
          <span>Total</span>
          <strong>₹ {{ $grandTotal }}</strong>
        </li>
      </ul>
      <!-- <a href="{{ route('cart.order') }}"> -->
        <button class="btn btn-primary w-100 place-order">Place Order</button>
      <!-- </a> -->
    </div>
  </div>
</div>

<script>
  $('.quantity').on('change', function() {
    let quantity = $(this).val();
    let itemId = $(this).closest('.cart-item').data('id');

    $.ajax({
      url: '{{ route("cart.update") }}',
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        id: itemId,
        quantity: quantity
      },
      success: function(response) {
        location.reload(); // Or update totals via JS
      },
      error: function() {
        alert('Could not update quantity');
      }
    });
  });

  $('.remove-item').on('click', function() {
    let itemId = $(this).closest('.cart-item').data('id');

    $.ajax({
      url: '{{ route("cart.remove") }}',
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        id: itemId
      },
      success: function(response) {
        location.reload();
      },
      error: function() {
        alert('Failed to remove item');
      }
    });
  });

  $('.place-order').on('click', function() {
    let itemId = $(this).closest('.cart-item').data('id');

    $.ajax({
      url: '{{ route("cart.order") }}',
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        id: itemId
      },
      success: function(response) {
        alert(response.message);
        window.location.href = response.redirect;
      },
      error: function() {
        alert('unable to process order');
      }
    });
  });
</script>


@endsection