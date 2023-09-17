@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="card col-4 mx-2">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $product->name }}</h4>
                                    <p class="card-text">$ {{ $product->price }}</p>

                                    @if(!auth()->user()->hasActivePurchase())
                                        <form action="{{ route('checkout.index', $product) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Buy</button>
                                        </form>
                                    @else
                                        <button class="btn btn-primary disabled">Buy</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
