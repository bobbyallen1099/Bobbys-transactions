@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('admin.users.transactions', $user) }}

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
            {{ Session::get('message') }}
            @if(Session::has('name'))
                <strong>'{{ Session::get('name') }}'</strong>
            @endif
        </div>
    @endif
    <div class="card">
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
                                   £{{ $transaction->formattedAmount }}
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
