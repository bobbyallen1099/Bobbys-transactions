@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.transactions.note.store', $transaction) }}">
        @csrf
        <div class="card card-body">
            <h2 class="mb-4">Add new note to <strong>{{ $transaction->formattedAmount }}</strong></h2>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">
                            Title
                        </label>
                        <input name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="description">
                            Description
                        </label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                    </div>
                </div>
            </div>
            
            <div>
                <button class="btn btn-primary">Store note</button>
                <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </form>
@endsection
