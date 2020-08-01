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
        <h2>Transactions</h2>
    </div>

    <div class="card white card-body p-0">
        <table class="table m-0">
            <thead>
                <tr>
                    <th class="border-top-0">User name</th>
                    <th class="border-top-0">Transaction amount</th>
                    <th class="border-top-0">Transaction type</th>
                    <th class="border-top-0">Transaction date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>
                            <a href="{{ route('admin.users.show', $transaction->user_id) }}">
                                {{ $transaction->user()->first()->name }}
                            </a>
                        </td>
                        <td>£{{ $transaction->formattedAmount }}</td>
                        <td>{{ $transaction->type === App\Transaction::TYPE_CREDIT ? 'Credit' : 'Debit' }}</td>
                        <td>{{ Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y')}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
