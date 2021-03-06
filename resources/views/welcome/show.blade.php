@extends('layouts.app')

@section('title')
Brand
@endsection

@section('content')
<div class="container" id="app">
    <div class="row">
        <div class="col-md-6 product-img mt-3">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block mx-auto" src="{{ $product->imageUrl }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block mx-auto" src="{{ $product->image1 }}" alt="Second slide">
                    </div>
                </div>
                <div class="text-center pt-2">
                    <img style="cursor: pointer" data-target="#carouselExampleIndicators" data-slide-to="0" class="active img-thumbnail product-image" src="{{ $product->imageUrl }}" alt="">
                    <img style="cursor: pointer" data-target="#carouselExampleIndicators" data-slide-to="1" class="img-thumbnail product-image" src="{{ $product->image1 }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-md-5 product-info product mt-5 mb-2">
            <h2 class="pt-2">{{ $product->title }}</h2>
            <div class="container">
                <div class="row star-rating">
                    <star-rating class="pr-3 " :star-size="20" :read-only="true" :show-rating="false" :rating="{{ $product->getStarRating() }}"></star-rating>
                    <h6 class="pr-2"><strong><a href="#user-reviews"><u>{{ $product->countReviews() }}</u></a></strong></h6>
                    <h6 class="pl-2"><strong>Microsoft</strong></h6>
                </div>
            </div>
            <h1 style="font-weight:bold; font-size:30px" class="pt-2">${{ $product->price }}</h1>
            <h6 style="font-weight:bold" class="pt-2">Free 2-day shipping </h6>
            <hr>
            <div class="product-sell product">
                <form method="POST" action="{{ route('user.addCart') }}">
                    {{ csrf_field() }}
                    <h5 class="mt-2">Qty:</h5>
                    <p>
                        @if(empty($article))
                            <select class="quantity" name="qty">
                                @for ($i = 1; $i < 12 + 1 ; $i++)
                                <option>{{ $i }}</option>
                                @endfor
                            </select>
                        @else
                            <select class="quantity" name="qty">
                                @for ($i = 1; $i < 12 + 1 ; $i++)
                                <option {{ $article['qty'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        @endif
                    </p>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary" style="border-radius: 20px;" role="button">Add to <i class="fas fa-shopping-cart"></i></button>        
                </form>
            </div>
            <hr>
            <div class="product-shipping">
                <h5 style="font-size:17px; font-weight:bold"><i class="fas fa-paper-plane mr-2"></i>Sale & shipping by Some-Brand</h5>
            </div>
            <hr>
            @if(Auth::guest())
            <div class="wish-list">
                <h6 style="font-weight:bold">Save it too...</h6>
                <button class="btn btn-primary" onclick="window.location='{{ route('login') }}'" style="border-radius: 20px;">Add to <i class="fas fa-heart"></i></button>
            </div>
            @else
            <div class="wish-list">
                <h6 style="font-weight:bold">Save it too...</h6>
                <form method="POST" action="{{ route('product.wishlist') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id"> 
                    <button class="btn btn-primary" style="border-radius: 20px;" type="submit" value="Submit">Add to <i class="fas fa-heart"></i></button>
                </form>
            </div>
            @endif
            <hr>
            <div class="form error-form">
                <h6 class="" style="font-weight:bold">Contact us</h6>
                <a class="text-dark" href=""><i class="fas fa-comment mr-2"></i><u>Let us know if something went wrong</u></a>
            </div>
        </div>
    </div>
    <hr class="mt-5">
    <div class="text-center pt-5">
        <div class="container">
            <h3 class="text-left">Other customers looked for</h3>
        </div>
        <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
            <div class="carousel-inner w-100" role="listbox">
                <div class="carousel-item row no-gutters active offset-md-1">
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                </div>
                <div class="carousel-item row no-gutters offset-md-1">
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <hr>
    <div class="pt-5">
        <div class="container">
            <h3>Product description</h3>
        </div>
        <div class="container">
            <h6 class="text-left" style="font-size:20px">{{ $product->description }}</h6>
        </div>
    </div>
    <hr class="mt-5">
    <div class="text-center pt-5">
        <div class="container">
            <h3 class="text-left">Other customers bought</h3>
        </div>
        <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
            <div class="carousel-inner w-100" role="listbox">
                <div class="carousel-item row no-gutters active offset-md-1">
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                    <div class="card col-3 float-left mr-5" style="width: 200px;"><a href="{{ route('welcome.show', ['product' => $product]) }}"><img class="card-img-top img-fluid" src="{{ $product->imageUrl }}" alt="Card image cap"></a><div class="card-body"><h5 class="card-title">{{ $product->title}}</h5><h2 class="card-text">${{ $product->price }}</h2></div></div>
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-5">
    <div class="container">
        <div class="comments pb-3">
            <h3>Reviews and comments</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <star-rating :read-only="true" :star-size="30" :show-rating="false" :rating="{{ $product->getStarRating() }}"></star-rating>
                <div class="stars pt-3">
                    <h5><strong>{{ $product->getStarRating() }} stars</strong>  out of 5 stars</h5>  
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="progress_title"><strong>5 stars</strong></h6>
                    </div>
                    <div class="col-md-9 self-align-center">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $product->ratingPercent(5) }}%" aria-valuemax="100"></div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="progress_title"><strong>4 stars</strong></h6>
                    </div>
                    <div class="col-md-9 self-align-center">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width:{{ $product->ratingPercent(4) }}%" aria-valuemax="100"></div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="progress_title"><strong>3 stars</strong></h6>
                    </div>
                    <div class="col-md-9 self-align-center">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $product->ratingPercent(3) }}%" aria-valuemax="100"></div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="progress_title"><strong>2 stars</strong></h6>
                    </div>
                    <div class="col-md-9 self-align-center">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $product->ratingPercent(2) }}%" aria-valuemax="100"></div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="progress_title"><strong>1 stars</strong></h6>
                    </div>
                    <div class="col-md-9 self-align-center">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $product->ratingPercent(1) }}%" aria-valuemax="100"></div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if(auth()->check())
                    <div class="create-review text-right">
                        <a href="{{ route('create.review', [$product] ) }}" class="btn btn-primary" role="button" style="border-radius:20px">Write a review</a>
                    </div>
                @else
                    <div class="write-review text-right">
                        <a href="/login" class="btn btn-primary" role="button" style="border-radius:20px">Write a review</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6" id="user-reviews">
            <h3>Recent comments</h3>
                @forelse($product->reviews as $review)
                <div class="mt-5 border border-dark pl-3 pt-3 pb-3 mb-3 rounded reviewid" data-reviewid="{{ $review->id }}">
                    <div class="title">
                        <h4>{{ $review->headline }}</h4>
                    </div>
                    <div class="user-rating">
                        <star-rating class="pr-3" :star-size="20" :read-only="true" :show-rating="false" :rating="{{ $review->rating }}"></star-rating>
                    </div>
                    <div class="body-text pt-3 pr-5">
                        <p style="text-align:justify"><strong>{{ $review->description }}</strong></p>
                    </div>
                    <div class="body-text pt-3">
                        @if(Auth()->check())
                            <a href="#" class="mr-2"><i class="far fa-thumbs-up"></i></a>{{ $review->getLikes() }}
                            <a href="#" class="mr-2 ml-4 dislike"><i class="far fa-thumbs-down"></i><a>{{ $review->getDislikes() }}
                        @else
                        <div class="container">
                            <div class="row">
                                <div class="alert alert-danger auth-message" style="display:none; height:30px;" role="alert">
                                    <p style="line-height:5px">You should be authenticated for completing this action<span class="ml-2 close-span" style="cursor:pointer"><strong>x</strong></span></p>
                                </div>
                            </div>
                        </div>
                            <a href="javascript:void(0)" class="guest-like mr-2"><i class="far fa-thumbs-up"></i></a>{{ $review->getLikes() }}
                            <a href="javascript:void(0)" class="guest-like mr-2 ml-4"><i class="far fa-thumbs-down"></i><a>{{ $review->getDislikes() }}
                        @endif
                    </div>
                    <div class="author pt-2">
                        <h6 class="text-muted">{{ $review->user_name }},  {{ date('d-m-Y', strtotime( $review->created_at )) }}</h6>
                    </div>
                </div>
                @empty
                <h6>There are not reviews for this product</h6>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/mean.js') }}"></script>
<script type="text/javascript">
    var token = '{{ Session::token() }}';
    var urlLike = '{{ route('like') }}';
</script>
@endsection



