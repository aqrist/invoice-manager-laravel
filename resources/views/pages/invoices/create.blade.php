@extends('layouts.sb')

@section('heading')
    Invoices
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
                    Add new Invoice
                </div>

                <div class="card-body">
                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- Create row then inside there are 2 col md 6 -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billto">Bill To:</label>
                                    <input type="text" id="billto" name="billto"
                                        class="form-control @error('billto') is-invalid @enderror"
                                        value="{{ old('billto') }}" required>
                                    @error('billto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billfrom">Bill From:</label>
                                    <input type="text" id="billfrom" name="billfrom"
                                        class="form-control @error('billfrom') is-invalid @enderror"
                                        value="{{ old('billfrom') }}" required>
                                    @error('billfrom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="due_date">Due Date:</label>
                                    <input type="date" id="due_date" name="due_date"
                                        class="form-control @error('due_date') is-invalid @enderror"
                                        value="{{ old('due_date') }}" required>
                                    @error('due_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notes">Notes:</label>
                                    <input type="text" id="notes" name="notes"
                                        class="form-control @error('notes') is-invalid @enderror"
                                        value="{{ old('notes') }}" required>
                                    @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="terms">Terms:</label>
                                    <input type="text" id="terms" name="terms"
                                        class="form-control @error('terms') is-invalid @enderror"
                                        value="{{ old('terms') }}" required>
                                    @error('terms')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount">Discount *on rupiah:</label>
                                    <input type="number" id="discount" name="discount"
                                        class="form-control @error('discount') is-invalid @enderror"
                                        value="{{ old('discount') }}">
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="form-group">
                            <button type="submit" name="save_only" class="btn btn-primary">Save</button>
                            <button type="submit" name="save_and_back" class="btn btn-info">Save and Back</button>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
