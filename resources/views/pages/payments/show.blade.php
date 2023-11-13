@extends('layouts.sb')

@section('heading')
    Payment Details
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

                <div class="card-body">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="">Description:</label>
                            <input type="text" class="form-control" value="{{ $payment->description }}" disabled>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="">Transaction date:</label>
                            <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($payment->transfer_date)) }}" disabled>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="">Amount:</label>
                            <input type="text" class="form-control" value="{{ 'Rp. ' . number_format($payment->amount_paid, 2, ',', '.') }}" disabled>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="">Evidence:</label>
                            <br>
                            <img src="{{ asset('storage/' . $payment->image) }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
