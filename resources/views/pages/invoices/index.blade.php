@extends('layouts.sb')

@section('heading')
    Invoices
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
        <div class="col-md-12 mb-3">
            <div class="card shadow">
                <div class="card-header">
                    Filter by Status:
                </div>
                <div class="card-body">
                    <form id="filter-form">
                        <select name="status" id="status" class="form-control mb-3">
                            <option value="">All</option>
                            <option value="0">Not Confirmed</option>
                            <option value="1">Confirmed</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow">

                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Invoices</h6>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="{{ route('invoices.create') }}" class="btn btn-primary">Add new</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover scroll-horizontal-vertical" id="crudTable"
                            width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="d-none">Id</th>
                                    <th>Invoice Number</th>
                                    <th>Desc</th>
                                    <th>Balance Due</th>
                                    <th>Amount Paid</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            ajax: {
                url: '{{ route('invoices.index') }}',
                data: function(d) {
                    d.status = $('#status').val(); // Pass the selected status as a filter parameter
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    visible: false
                },
                {
                    data: 'invoice_number',
                    name: 'invoice_number'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'balance_due',
                    name: 'balance_due',
                    render: function(data, type, row) {
                        // Format the amount as currency
                        return 'Rp. ' + number_format(data, 2, ',', '.');
                    }
                },
                {
                    data: 'amount_paid',
                    name: 'amount_paid',
                    render: function(data, type, row) {
                        // Format the amount as currency
                        return 'Rp. ' + number_format(data, 2, ',', '.');
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '25%'
                },
            ]
        });

        // Handle filter form submission
        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            datatable.ajax.reload(); // Reload the DataTable with the selected filter
        });
    </script>
@endpush
