@extends('layouts.app')

@section('content')


    {{ Breadcrumbs::render('admin.transactions.show', $transaction) }}

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
            {{ Session::get('message') }}
            @if(Session::has('name'))
                <strong>'{{ Session::get('name') }}'</strong>
            @endif
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="m-0">Transaction Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>
                                <span class="{{ $transaction->type === App\Transaction::TYPE_CREDIT ? 'text-success' : 'text-danger' }}">
                                    {{ $transaction->type === App\Transaction::TYPE_CREDIT ? '+' : '-' }}£{{ $transaction->formattedAmount }}
                                </span>
                            </h2>
                            <h4>
                                <a href="{{ route('admin.users.show', $transaction->user_id) }}">
                                    {{ $transaction->user()->first()->name }}
                                </a>
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <h4>
                                {{ $transaction->type === App\Transaction::TYPE_CREDIT ? 'Credit' : 'Debit' }}
                            </h4>
                            <h4>
                                {{ Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y')}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="m-0">Transaction notes</h3>
                    <a href="{{ route('admin.transactions.note.create', $transaction) }}" class="btn btn-primary">Add a new note</a>
                </div>
                <div class="card-body">
                    @foreach ($transaction->notes()->latest()->get() as $note)
                        <div class="card p-3 mb-3">
                            <h5>{{ $note->title }}</h5>
                            <p class="mb-0">{{ $note->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
