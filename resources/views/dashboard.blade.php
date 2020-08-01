@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        @if (Auth::user()->is_admin)
            <div class="col-md-6">
                <a href="{{ route('admin.users.index') }}" class="card card-body">
                    <h3 class="mb-0">Users</h3>
                </a>
            </div>
            <div class="col-md-6">
                <a href="" class="card card-body">
                    <h3 class="mb-0">Transactions</h3>
                </a>
            </div>
        @else
            <div class="col-md-6">
                <a href="{{ route('profile') }}" class="card card-body">
                    <h3 class="mb-0">Profile</h3>
                </a>
            </div>
            <div class="col-md-6">
                <a href="" class="card card-body">
                    <h3 class="mb-0">My Transactions</h3>
                </a>
            </div>
        @endif
    </div>
@endsection