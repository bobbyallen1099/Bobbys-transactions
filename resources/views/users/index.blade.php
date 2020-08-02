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

    <div class="card white card-body p-3">
        <users-component></users-component>
        {{-- <table class="table m-0">
            <thead>
                <tr>
                    <th class="border-top-0">Email</th>
                    <th class="border-top-0">Admin</th>
                    <th class="border-top-0">User balance</th>
                    <th class="border-top-0">Last note title</th>
                    <th class="border-top-0">Created on</th>
                    <th class="border-top-0" width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->email }}</a></td>
                        <td>
                            @if ($user->is_admin)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                        <td>
                            <span class="{{ $user->balance >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $user->balance }}
                            </span>
                        </td>
                        <td>
                            @if ($user->notes->first())
                                {{ $user->notes()->latest()->first()->title }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-xs">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
    </div>
@endsection
