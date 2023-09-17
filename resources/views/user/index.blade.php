@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('success'))
                <x-alert type="success">{{ session()->get('success') }}</x-alert>
            @endif
            <div class="mb-2 text-end">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Add New User</a>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Access</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-success">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $user->active ? 'Granted' : 'Cancelled' }}</td>
                                <td>
                                    <a class="btn btn-sm" href="{{ route('users.edit', $user) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form class="d-inline" action="{{ route('users.toggle-access', $user) }}" method="post">
                                        @csrf
                                        <button class="btn btn-sm" >
                                            <i class="fa fa-user-cog"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
