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
                    <h4 class="{{ $user->balance >= 0 ? 'text-success' : 'text-danger' }}">{{ $user->balance }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        @if ($user->transactions->first())
        <table class="table table-border">
            <thead>
                <tr>
                    <th class="border-top-0">Transaction amount</th>
                    <th class="border-top-0">Transaction type</th>
                    <th class="border-top-0">Transaction date</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($user->transactions as $transaction)
                        <tr>
                            <td>
                                <span class="{{ $transaction->type === App\Transaction::TYPE_CREDIT ? 'text-success' : 'text-danger' }}">
                                    {{ $transaction->type === App\Transaction::TYPE_CREDIT ? '+' : '-' }}£{{ $transaction->formattedAmount }}
                                </span>
                            </td>
                            <td>{{ $transaction->type === App\Transaction::TYPE_CREDIT ? 'Credit' : 'Debit' }}</td>
                            <td>{{ Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-danger">No transactions</div>
        @endif
    </div>
@endsection
