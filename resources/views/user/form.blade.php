@extends('layouts.app')

@section('content')
    @php($user = $user ?? null)
    @php($editing = (bool)$user)
    @php($heading = $heading ?? ( $editing ? __('Edit User') : __('Add New User') ))

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $heading }}</div>

                    <div class="card-body">
                        <form action="{{ $route }}" method="POST">
                            @csrf
                            @method($method ?? 'POST')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input
                                    type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user?->name) }}"
                                >
                                <x-error field="name"/>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user?->email) }}"
                                >
                                <x-error field="email"/>
                            </div>

                            @if(!$editing)
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input
                                        type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                    >
                                </div>
                            @endif

                            <button type="submit" class="btn btn-success btn-sm">
                                {{ $user ? __('Update') : __('Create') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
