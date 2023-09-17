@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <x-alert type="success">{{ session()->get('success') }}</x-alert>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if(!$user->hasActivePurchase())
                            {{ __('You have not purchased anything yet') }}
                        @else
                            <h4>{{ $user->activePurchase->product->category }} Purchase Details</h4>
                            <p>Last 4 digits of card: {{ $user->activePurchase->last_4_digits }}</p>
                            <form action="{{ route('purchases.cancel', $user->activePurchase) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Cancel Purchase</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
