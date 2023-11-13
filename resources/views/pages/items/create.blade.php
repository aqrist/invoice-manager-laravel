@extends('layouts.sb')

@section('heading')
    Invoices | Add Item
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
                    Add Item
                </div>

                <div class="card-body">
                    <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="invoice_id" value="{{ $invoice->id }}" class="form-control d-none">

                        <!-- Create row then inside there are 2 col md 6 -->
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="number" id="price" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qty">Qty:</label>
                                    <input type="number" id="qty" name="qty"
                                        class="form-control @error('qty') is-invalid @enderror"
                                        value="{{ old('qty') }}" required>
                                    @error('qty')
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
