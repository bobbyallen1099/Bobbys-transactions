@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('admin.users.index') }}

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
            {{ Session::get('message') }}
            @if(Session::has('name'))
                <strong>'{{ Session::get('name') }}'</strong>
            @endif
        </div>
    @endif
    <div class="d-flex justify-content-between mb-4">
        <h2>Users</h2>
        <div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add new user</a>
        </div>
    </div>

    <div class="card white card-body p-0">
        <table class="table m-0">
            <thead>
                <tr>
                    <th class="border-top-0">Email</th>
                    <th class="border-top-0">Created on</th>
                    <th class="border-top-0">Modified on</th>
                    <th class="border-top-0" width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->email }}</a></td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-xs">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
