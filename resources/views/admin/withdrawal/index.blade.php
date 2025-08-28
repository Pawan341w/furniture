@extends('admin.layout.app')

@section('title', 'Withdrawal Management')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Withdrawal Management</h2>

    <!-- Filter Buttons -->
    <div class="mb-3">
        <button class="btn btn-outline-primary status-filter" data-status="">All</button>
        <button class="btn btn-outline-warning status-filter" data-status="pending">Pending</button>
        <button class="btn btn-outline-success status-filter" data-status="completed">Completed</button>
        <button class="btn btn-outline-danger status-filter" data-status="failed">Failed</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="withdrawalsTable">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Message</th>
                    <th>UTR</th>
                    <th>Txn ID</th>
                    <th>Balance Before</th>
                    <th>Status</th>
                    <th>Bank Details</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historys->where('type', 'debit') as $history)
                <tr class="withdrawal-row 
                    {{ $history->status == 'pending' ? 'table-warning' : '' }}
                    {{ $history->status == 'completed' ? 'table-success' : '' }}
                    {{ $history->status == 'failed' ? 'table-danger text-white' : '' }}"
                    data-status="{{ $history->status }}">
                    <td>
                        @if($history->user)
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($history->user->profile_image!='' ?'storage/'.$history->user->profile_image : 'assets/images/faces/face1.jpg') }}"
                                 alt="User" class="rounded-circle me-2" width="32" height="32">
                            <div>
                                <div>{{ $history->user->name }}</div>
                                <small class="text-muted">ID: {{ $history->user->id }}</small>
                            </div>
                        </div>
                        @else
                        <span class="text-muted">Unknown User</span>
                        @endif
                    </td>
                    <td>{{ ucfirst($history->type) }}</td>
                    <td>
                        <img src="{{ asset('assets/images/icons/coin.png') }}" style="height: 20px; width: 20px;">
                        {{ num_format($history->amount) }}
                    </td>
                    <td>{{ $history->message }}</td>
                    <td>{{ $history->utr ?? '-' }}</td>
                    <td>{{ $history->transaction_id }}</td>
                    <td>
                        <img src="{{ asset('assets/images/icons/coin.png') }}" style="height: 20px; width: 20px;">
                        {{ num_format($history->balance_before) }}
                    </td>
                    <td>
                        <select class="form-select form-select-sm mt-1 status-select" data-id="{{ $history->id }}">
                            <option value="pending" {{ $history->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $history->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="failed" {{ $history->status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info view-bank-details"
                            data-details='@json($history->bank_details)'
                            data-user="{{ $history->user->name ?? 'N/A' }}">
                            View Bank Details
                        </button>
                    </td>
                    <td>{{ $history->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $history->updated_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bank Details Modal -->
<div class="modal fade" id="bankDetailsModal" tabindex="-1" aria-labelledby="bankDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="bankDetailsModalLabel">Bank Account Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-5 fw-semibold text-muted">Account Holder</div>
                    <div class="col-7" id="modal-account-holder">-</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5 fw-semibold text-muted">Bank Name</div>
                    <div class="col-7" id="modal-bank-name">-</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5 fw-semibold text-muted">Account Number</div>
                    <div class="col-7" id="modal-account-number">-</div>
                </div>
                <div class="row mb-1">
                    <div class="col-5 fw-semibold text-muted">IFSC Code</div>
                    <div class="col-7" id="modal-ifsc-code">-</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Bootstrap JS (Required for Modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function () {
    // Init DataTable
    const table = $('#withdrawalsTable').DataTable({
        pageLength: 10,
        lengthChange: false,
        ordering: false
    });

    // Filter by status
    $('.status-filter').click(function () {
        const status = $(this).data('status');
        $('.withdrawal-row').each(function () {
            const rowStatus = $(this).data('status');
            if (!status || rowStatus === status) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Status change via delegation (fixes pagination issue)
    $('#withdrawalsTable').on('change', '.status-select', function () {
        const id = $(this).data('id');
        const status = $(this).val();
        const row = $(this).closest('tr');

        $.ajax({
            url: '{{ route("admin.withdrawals.update-status") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                status: status
            },
            success: function (res) {
                if (res.success) {
                    row.attr('data-status', status);
                    Swal.fire('Success', res.message || 'Status updated successfully.', 'success');
                } else {
                    Swal.fire('Error', res.message || 'Failed to update status.', 'error');
                }
            },
            error: function (err) {
                let msg = err.responseJSON?.message || 'Something went wrong';
                Swal.fire('Error', msg, 'error');
            }
        });
    });

    // Bank details via delegation (fixes pagination issue)
    $('#withdrawalsTable').on('click', '.view-bank-details', function () {
        const details = $(this).data('details') || {};

        $('#modal-account-holder').text(details.account_holder_name || 'N/A');
        $('#modal-bank-name').text(details.bank_name || 'N/A');
        $('#modal-account-number').text(details.account_number || 'N/A');
        $('#modal-ifsc-code').text(details.ifsc_code || 'N/A');

        const modal = new bootstrap.Modal(document.getElementById('bankDetailsModal'));
        modal.show();
    });
});

</script>
@endsection
