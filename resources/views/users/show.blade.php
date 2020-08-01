@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('admin.users.show', $user) }}

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
            {{ Session::get('message') }}
            @if(Session::has('name'))
                <strong>'{{ Session::get('name') }}'</strong>
            @endif
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{ $user->firstname }} {{ $user->surname }}</h2>
                    <h4>{{ $user->email }}</h4>
                    <h4>{{ $user->phone }}</h4>
                </div>
                <div class="col-md-4">
                    <h4>
                        @if (!empty($user->address_line_1))                          
                            {{ $user->address_line_1 }} <br>
                        @endif
                        @if (!empty($user->address_line_2 ))                           
                            {{ $user->address_line_2 }} <br>
                        @endif
                        @if (!empty($user->town ))                            
                            {{ $user->town }} <br>
                        @endif
                        @if (!empty($user->county ) )                           
                            {{ $user->county }} <br>
                        @endif
                        @if (!empty( $user->postcode ))                            
                            {{ $user->postcode }} <br>
                        @endif
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-xs">Edit</a>

            @if ($user != Auth::user())
                <a href="{{ route('admin.users.confirmdelete', $user) }}" class="btn btn-danger btn-xs">Delete</a>
            @endif
        </div>
    </div>
@endsection
