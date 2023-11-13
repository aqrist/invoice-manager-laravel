@extends('layouts.sb')

@section('heading')
    Item List | {{ $invoice->invoice_number }}
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

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">

                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Items</h6>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="{{ route('items.create', $invoice->id) }}" class="btn btn-primary">Add new</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover scroll-horizontal-vertical" id="crudTable"
                            width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="d-none">Id</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="d-none">{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ 'Rp. ' . number_format($item->price, 2, ',', '.') }} </td>
                                        <td width="15%">
                                            <div class="row">
                                                <div class="col-6 text-right">
                                                    <a href="{{ route('items.show', $item->id) }}"
                                                        class="btn btn-info m-1">Detail</a>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger m-1">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        // Initialize DataTable
        var datatable = $('#crudTable').DataTable({});
    </script>
@endpush
