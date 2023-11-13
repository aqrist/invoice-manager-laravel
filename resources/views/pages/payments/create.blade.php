@extends('layouts.sb')

@section('heading')
    Invoices | Add Payment
@endsection

@section('content')
    {{-- notification --}}
    @include('layouts/flash-message')
    {{-- end notification --}}

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow">

                <div class="card-header">
                    Add Invoice Payment
                </div>

                <div class="card-body">
                    <form action="{{ route('payments.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="invoice_id" value="{{ $invoice->id }}" class="form-control d-none">

                        <!-- Create row then inside there are 2 col md 6 -->
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <input type="text" id="description" name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        value="{{ old('description') }}" required>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transfer_date">Trx Date:</label>
                                    <input type="date" id="transfer_date" name="transfer_date"
                                        class="form-control @error('transfer_date') is-invalid @enderror"
                                        value="{{ old('transfer_date') }}" required>
                                    @error('transfer_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_paid">Amount:</label>
                                    <input type="number" id="amount_paid" name="amount_paid"
                                        class="form-control @error('amount_paid') is-invalid @enderror"
                                        value="{{ old('amount_paid') }}" required>
                                    @error('amount_paid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Evidence:</label>
                                    <input type="file" id="image" name="image"
                                        class="form-control @error('image') is-invalid @enderror"
                                        value="{{ old('image') }}" required>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
