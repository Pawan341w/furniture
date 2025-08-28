@extends('admin.layout.app')
@section('title', 'User Management')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>User Management</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">+ Add User</button>
        </div>

        <table class="table table-bordered" id="user_table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                     <th>Used Qr</th>

                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>           <img src="{{ asset('assets/images/icons/coin.png') }}" style="
    height: 20px;
    width: 20px;
"> {{ num_format($user->wallet) }}</td>
<td>
    <span class="badge bg-info viewUsedQRCodes" style="cursor:pointer" data-id="{{ $user->id }}">
        {{ $user->usedQRCodes->count() }} used
    </span>
</td>

                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning editBtn" data-id="{{ $user->id }}">Edit</button>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $user->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Create Modal --}}
    <div class="modal fade" id="createUserModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="createUserForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editUserForm">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" id="edit_name" class="form-control mb-2" placeholder="Name"
                            required>
                        <input type="email" name="email" id="edit_email" class="form-control mb-2" placeholder="Email"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="usedQrModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Used QR Codes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr><th>#</th><th>Product</th><th>QR Code</th><th>Used At</th></tr>
            </thead>
            <tbody id="usedQrTableBody">
                <!-- Data will be loaded here -->
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // CREATE USER
        $('#createUserForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('users.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: res => {
                    Swal.fire('Success', 'User created successfully!', 'success')
                        .then(() => location.reload());
                },
                error: err => {
                    if (err.responseJSON?.errors) {
                        let messages = Object.values(err.responseJSON.errors).flat().join('<br>');
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: messages
                        });
                    } else if (err.responseJSON?.message) {
                        Swal.fire('Error', err.responseJSON.message, 'error');
                    } else {
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    }
                }

            });
        });

        // FETCH USER DATA
        $('.editBtn').click(function() {
            let id = $(this).data('id');

            $.get(`/users/${id}`, res => {
                $('#edit_id').val(res.id);
                $('#edit_name').val(res.name);
                $('#edit_email').val(res.email);
                $('#editUserModal').modal('show');
            });
        });

        // UPDATE USER
        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#edit_id').val();
            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: `/users/${id}`,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: res => {
                    Swal.fire('Updated', 'User updated successfully!', 'success')
                        .then(() => location.reload());
                },
                error: err => {
                    Swal.fire('Error', 'Failed to update user', 'error');
                }
            });
        });

        // DELETE USER
        $('.deleteBtn').click(function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this user!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/users/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: res => {
                            Swal.fire('Deleted!', 'User has been deleted.', 'success')
                                .then(() => location.reload());
                        },
                        error: () => {
                            Swal.fire('Error', 'Failed to delete user', 'error');
                        }
                    });
                }
            });
        });


        $(document).on('click', '.viewUsedQRCodes', function() {
    const userId = $(this).data('id');

    $.get(`/users/${userId}/used-qrcodes`, function(qrcodes) {
        let rows = '';
        if (qrcodes.length) {
            qrcodes.forEach((qr, i) => {
                rows += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${qr.product.name}</td>
                        <td><img src="/${qr.path}" width="60"></td>
<td>${qr.updated_at ? new Date(qr.updated_at).toLocaleString('en-GB', {
  day: '2-digit', month: 'short', year: 'numeric',
  hour: '2-digit', minute: '2-digit', hour12: true
}) : 'N/A'}</td>                    </tr>`;
            });
        } else {
            rows = '<tr><td colspan="3" class="text-center">No QR codes used.</td></tr>';
        }

        $('#usedQrTableBody').html(rows);
        $('#usedQrModal').modal('show');
    });
});

 $(document).ready(function () {
    $('#user_table').DataTable({
        pageLength: 10,

    });
});

    </script>

@endsection
