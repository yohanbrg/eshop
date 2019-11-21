@extends('layouts.app')

@section('content')
<div class="row">
    @foreach ($products as $key => $product)
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $product['label'] }}</h5>
                <h6>{{ $product['price'] }}€</h6>
                <a href="#" class="btn btn-primary add-to-cart" data-product-id="{{ $key }}">
                    Ajouter au panier
                    <i class="fas fa-cart-plus fa-lg"></i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal Successfully added item to cart-->
<div class="modal fade" id="modal-success-add-cart-items" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Le produit a bien été ajouté au panier !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Continuer mes achats</button>
                <a class="btn btn-primary" href="{{ route('cart') }}" role="button">Accéder au panier</a>
            </div>
        </div>
    </div>
</div>
@endsection