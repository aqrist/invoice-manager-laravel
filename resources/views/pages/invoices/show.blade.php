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
                    Invoice Detail | {{ $invoice->description }}
                </div>

                <div class="card-body">

                    {{-- Header --}}
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h1>INVOICE</h1>
                            <p>{{ $invoice->invoice_number }}</p>
                        </div>
                    </div>

                    {{-- Tujuan --}}
                    <div class="row mb-3">
                        <div class="col-6 mb-3">
                            {{ $invoice->billfrom }}
                            <br class="mb-5">
                            Bill To :
                            {{ $invoice->billto }}
                        </div>
                        <div class="col-6 mb-3">
                            <div class="text-right">
                                Date : {{ date('d/m/Y', strtotime($invoice->start_date)) }}
                            </div>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="row">
                        <div class="col-12 mb-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>-</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ 'Rp. ' . number_format($item->price, 2, ',', '.') }}</td>
                                            <td>{{ 'Rp. ' . number_format($item->price * $item->qty, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Notes & Subtotal --}}
                    <div class="row mb-5">
                        <div class="col-6 text-left">
                            Notes :
                            <br>
                            {{ $invoice->notes }}
                            <br>
                            Terms :
                            <br>
                            {{ $invoice->terms }}
                        </div>

                        <div class="col-6 text-right">
                            <div class="row">
                                <div class="col-6">
                                    Subtotal
                                </div>
                                <div class="col-6">
                                    {{ 'Rp. ' . number_format($subtotal, 2, ',', '.') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    Discount
                                </div>
                                <div class="col-6">
                                    @if ($invoice->discount <= 0)
                                        -
                                    @else
                                        {{ 'Rp. ' . number_format($invoice->discount, 2, ',', '.') }}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    Total
                                </div>
                                <div class="col-6">
                                    {{ 'Rp. ' . number_format($subtotal - $invoice->discount, 2, ',', '.') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    Amount Paid
                                </div>
                                <div class="col-6">
                                    {{ 'Rp. ' . number_format($paid, 2, ',', '.') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <strong>Balance Due </strong>
                                </div>
                                <div class="col-6">
                                    <strong>
                                        {{ 'Rp. ' . number_format($subtotal - $invoice->discount - $paid, 2, ',', '.') }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Payment List --}}
                    <div class="row mb-3 mt-5">
                        @if ($invoice->status == 0)
                            <div class="col-12">
                                <a href="{{ route('invoices.markasdone', $invoice->id) }}" class="btn btn-success">Mark as
                                    Done</a>
                            </div>
                        @else
                        @endif
                        <div class="col-12 mb-3">
                            <a class="btn btn-info m-1" href="{{ route('payments.index', $invoice->id) }}">
                                Payment List
                            </a>
                        </div>
                        
                        <div class="col-12">
                            <div class="row">
                                <!-- Image List -->
                                <ul class="list-group">
                                    <div class="col-3">
                                        @foreach ($payments as $payment)
                                            <li class="list-group-item">
                                                <img src="{{ asset('storage/' . $payment->image) }}"
                                                    alt="{{ $payment->description }}" class="img-thumbnail"
                                                    style="cursor: pointer;" data-toggle="modal" data-target="#imageModal"
                                                    data-image="{{ asset('storage/' . $payment->image) }}">
                                            </li>
                                        @endforeach
                                    </div>

                                </ul>
                            </div>

                            <!-- Image Popup/Modal -->
                            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog"
                                aria-labelledby="imageModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img id="modalImage" src="" class="img-fluid" alt="Image">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        // Handle click events on list items
        $('.list-group-item img').on('click', function() {
            var imageUrl = $(this).data('image');
            $('#modalImage').attr('src', imageUrl);
            $('#imageModal').modal('show');
        });
    </script>
@endpush
