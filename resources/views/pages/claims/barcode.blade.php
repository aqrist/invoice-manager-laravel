@extends('layouts.sb')

@section('heading')
    Claim Ticket
@endsection

{{-- debug {{ $items }} --}}

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

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">

                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Claim Ticket | {{ $qrcode }}</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('claim.injectbarcode') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="">QR Code</label>
                                <div class="visible-print text-center">
                                    {!! QrCode::size(100)->generate($qrcode) !!}
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="">E-Ticket Barcode</label>
                                    <input name="qrcode" type="text" name="" id="" class="d-none"
                                        value="{{ $qrcode }}">
                                    <input name="barcode" type="text" class="form-control" required autofocus>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script></script>
@endpush
