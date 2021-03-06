@extends('layouts.app')

@section('title')
    User Cart
@endsection

@section('content')
@if(Session::has('cart'))
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header bg-white">
                <h3 class="font-weight-bold">Your cart: {{ $cart->totalQty}} items</h3>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card-body w-100 ml-3" style="padding:0;">
                <div class="row" style="margin-right:0px">
                    @foreach($products as $product)
                    <div class="card border-bottom border-left" style="border-radius:0px">
                        <div class="card-images d-inline-flex" style="width:745px">
                            <div class="card mr-4" style="width:200px; padding:15px;">
                                <img class="card-img-top img-fluid" style="padding:10px" src="{{ $product['item']->imageUrl }}" alt="Card image cap"></a>
                            </div>
                            <div class="card-body mt-4">
                                <div class="product-id" data-productid="{{ $product['item']->id }}">
                                    <a href="{{ route('welcome.show', ['product' => $product['item']->id] ) }}" class="text-dark"><h5>{{ $product['item']->title }}</h5></a>
                                    <h5 class="mt-2">Qty:</h5>
                                    <p>
                                        <select class="quantity" data-id="{{ $product['item']->id }}" data-productQuantity="">
                                            @for ($i = 1; $i < 12 + 1 ; $i++)
                                                <option {{ $product['qty'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </p>
                                </div>
                                <div class="form-buttons d-inline-flex">
                                    <a class="text-dark mr-2" style="cursor:pointer"  href="{{ route('user.removeItem', ['id' => $product['item']->id]) }}"><u>Remove</u></a>
                                    |
                                    <form method="POST" action="{{ route('user.saveLater') }}" id="save-later">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product_qty" value="{{ $product['qty'] }}">
                                        <input type="hidden" name="product_id" value="{{ $product['item']->id }}">
                                        <a style="cursor:pointer" class="text-dark ml-2" onclick="document.getElementById('save-later').submit();"><u>Save for later</u></a>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body mt-4 mr-4">
                                <h5><strong>${{ $product['item']->price * $product['qty'] }}</strong></h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 border-left">
            <div class="card-body w-100 ml-3 mt-3" style="padding:0;">
                <div class="row" style="margin-right:0px">
                    <div class="card-checkout d-inline-flex w-100 border-bottom">
                        <div class="card mt-4 mr-4">
                            <h6>Subtotal ({{ $cart->totalQty}} items)</h6>
                            <h6>Shipping</h6>
                            <h5 class="mt-3">Est. total</h5>
                        </div>
                        <div class="card mt-4 ml-4">
                            <h6>${{ $cart->totalPrice}}</h6>
                            <h6>Free</h6>
                            <h5 class="font-weight-bold mt-3">${{ $cart->totalPrice}}</h5>
                        </div>
                    </div>
                </div>
                <div class="button-checkout mt-3 pr-4">
                    <button class="btn btn-primary w-100 text-center" id="checkout-button" style="border-radius:20px">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header bg-white">
                <h3 class="font-weight-bold">Your cart: 0 items</h3>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card-body w-100 ml-3 mt-3" style="padding:0;">
                <div class="row" style="margin-right:0px">
                    <div class="card-header bg-white" style="border:none;">
                        <h5 class="text-muted">Your cart is empty!</h5>
                        <h5 class="text-muted">Add new things to your cart. <a href="{{ route('welcome.index') }}">Go on shopping now!</a></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 border-left">
            <div class="card-body w-100 ml-3 mt-3" style="padding:0;">
                <div class="row" style="margin-right:0px">
                    <div class="card-checkout d-inline-flex w-100 ">
                        <div class="card mt-4 mr-4">
                            <h6>Subtotal (0 items)</h6>
                            <h6>Shipping</h6>
                            <h5 class="mt-3">Est. total</h5>
                        </div>
                        <div class="card mt-4 ml-4">
                            <h6>$0.00</h6>
                            <h6>Free</h6>
                            <h5 class="font-weight-bold mt-3">$0.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(Session::has('saveLater'))
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header mt-3 bg-white">
                <h3 class="font-weight-bold">Saved for later</h3>
            </div>
        </div>
        <div class="col-md-8">
            @foreach($articles as $article)
            <div class="card-body w-100 ml-3" style="padding:0;">
                <div class="row" style="margin-right:0px">
                    <div class="card border-bottom border-right border-left" style="border-radius:0px">
                        <div class="card-images d-inline-flex" style="width:745px">
                            <div class="card mr-4" style="width:200px">
                                <img class="card-img-top img-fluid" style="padding:10px" src="{{ $article['item']->imageUrl }}" alt="Card image cap"></a>
                            </div>
                            <div class="card-body mt-4">
                                <div class="item-title">
                                    <a href="{{ route('welcome.show', ['product' => $article['item']->id ]) }}" class="text-dark"><h5>{{ $article['item']->title }}</h5></a>
                                </div>
                                <div class="product-quantity">
                                    <h5 class="mt-3">Qty: {{ $article['qty'] }}</h5>
                                </div>
                                <div class="form-buttons d-inline-flex mt-2">
                                    <a class="text-dark mr-2" style="cursor:pointer"  href="{{ route('user.removeSaveLater', ['id' => $article['item']->id]) }}"><u>Remove</u></a>
                                    |
                                    <form action="{{ route('user.moveCart') }}" id="moveCart">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="qty" value="{{ $article['qty'] }}">
                                        <input type="hidden" name="product_id" value="{{ $article['item']->id }}">
                                        <a style="cursor:pointer" class="text-dark ml-2" onclick="document.getElementById('moveCart').submit();"><u>Move to cart</u></a>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body mt-4 mr-4">
                                <h5><strong>${{ $article['item']->price * $article['qty']}}</strong></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header mt-3 bg-white">
                <h3 class="font-weight-bold">Saved for later</h3>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card-body w-100 ml-3 mt-3" style="padding:0;">
                <div class="row" style="margin-right:0px">
                    <div class="card-header bg-white" style="border:none">
                        <h5 class="text-muted">You have no items saved for later!</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script src="{{ asset('js/mean.js') }}"></script>
<script>
(function () {
    const classname = document.querySelectorAll('.quantity')

    Array.from(classname).forEach(function(element) {
        element.addEventListener('change', function() {
            const id = element.getAttribute('data-id');
            axios.patch( `/product/cart/${id}`, {
                quantity: this.value
            })
            .then(function (response) {
                //console.log(response);
                window.location.href = '{{ route('user.cart') }}'
            })
            .catch(function (error) {
                console.log(error.response);
            });
        })
    })
})();
</script>
@endsection