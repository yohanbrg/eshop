@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

  <div class="col-md-6 {{ !empty($cartItems) ? 'no-items-in-cart-message' : '' }}">
    <p>Aucun item dans le panier pour le moment</p>
    <a href="{{ route('products') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
      Ajouter vos premiers articles !
    </a>
  </div>

  @if (!empty($cartItems))
  <table class="table cart-list">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Produit</th>
        <th scope="col">Quantité</th>
        <th scope="col">Prix</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cartItems as $cartItem)
      <tr class="cart-selected-item" data-product-id="{{ $cartItem['product_id'] }}" data-product-stock="{{ $cartItem['stock'] }}">
        <th scope="row">
          <img src="{{ asset('images/' . $cartItem['image']) }}" class="img-thumbnail">
        </th>
        <td>{{ $cartItem['label'] }}</td>
        <td>
          <input type="number" class="form-control cart-item-quantity" value="{{ $cartItem['selected_quantity'] }}" min="1" max="{{ $cartItem['stock'] }}">
          <div class="invalid-feedback"></div>
        </td>
        <td>{{ $cartItem['price'] }} €</td>
        <td>
          <a href="#" class="remove-cart-item">
            <i class="fas fa-times"></i>
          </a>
        </td>
      </tr>
      @endforeach
      <tr>
        <th scope="row"></th>
        <td></td>
        <td></td>
        <td>Total</td>
        <td>
          <span id="cart-total-cost">{{ \App\Support\Cart::getItemsTotalCost() }}</span>
          €
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endif

@endsection