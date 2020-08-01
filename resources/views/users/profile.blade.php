@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('admin.profile') }}

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
                    <h2>{{ $user->name }}</h2>
                    <h4>{{ $user->email }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
