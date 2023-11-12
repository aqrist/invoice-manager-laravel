@extends('layouts.sb')

@section('heading')
    QR Tickets
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

    <div class="row mb-3">
        <div class="col-md-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#generateModal">
                Generate QR Tickets
            </button>

            <a href="{{ route('qrtickets.download') }}" class="btn btn-danger">Download QR as Zip</a>

            <!-- Modal -->
            <div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="generateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="generateModalLabel">Generate QR Ticket</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('qrtickets.generate') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="numberOfTickets">Number of Tickets:</label>
                                    <input type="number" class="form-control" name="numberOfTickets"
                                        placeholder="Enter number of tickets" required>
                                </div>
                                <button type="submit" class="btn btn-danger">Generate</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">

                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">QR Tickets</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover scroll-horizontal-vertical" id="crudTable"
                            width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>QR Code</th>
                                    <th>Claimed By</th>
                                    <th>Status</th>
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
                url: '{{ route('qrtickets.index') }}'
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'qrcode',
                    name: 'qrcode'
                },
                {
                    data: 'ticket.email',
                    name: 'ticket.email',
                    defaultContent: 'N/A'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ]
        });
    </script>
@endpush
