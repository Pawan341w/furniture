@extends('admin.layout.app')
@section('title', 'Categories')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between align-items-center">
                        Category List
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add
                            Category</button>
                    </h4>

                    <table class="table table-bordered" id="category_table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTable">
                            @foreach ($categories as $index => $category)
                                <tr id="row-{{ $category->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" height="50">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info editBtn"
                                            data-id="{{ $category->id }}">Edit</button>
                                        <button class="btn btn-sm btn-danger deleteBtn"
                                            data-id="{{ $category->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addCategoryForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Category</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editCategoryForm" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId" autocomplete="off">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editName">Name</label>
                        <input type="text" name="name" id="editName" class="form-control" autocomplete="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="editImage">Image</label>
                        <input type="file" name="image" id="editImage" class="form-control" autocomplete="off">
                        <img id="previewImage" class="mt-2" height="50" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
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

        $('#addCategoryForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: '{{ route('categories.store') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: res => {
                    Swal.fire('Success', res.message, 'success').then(() => location.reload());
                },
                 error: function(err) {
        if (err.status === 422) {
            const errors = err.responseJSON.errors;
            let messages = '';

            for (let field in errors) {
                messages += errors[field].join('<br>') + '<br>';
            }

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: messages
            });
        } else {
            Swal.fire('Error', err.responseJSON?.message || 'Something went wrong.', 'error');
        }
        console.error(err);
    }
            });
        });

        $('.editBtn').click(function() {
            let id = $(this).data('id');
            $.get(`/categories/${id}`, res => {
                $('#editId').val(res.id);
                $('#editName').val(res.name);
                $('#previewImage').attr('src', `/storage/${res.image}`);
                $('#editCategoryModal').modal('show');
            });
        });

       $('#editCategoryForm').on('submit', function(e) {
    e.preventDefault();
    let id = $('#editId').val();
    let formData = new FormData(this);
    formData.append('_method', 'PUT'); // Laravel needs this for method spoofing

    $.ajax({
        url: `/categories/${id}`,
        type: 'POST', // ✅ must be POST, Laravel doesn't support PUT in your route
        data: formData,
        contentType: false,
        processData: false,
        success: res => {
            Swal.fire('Updated', res.message, 'success').then(() => location.reload());
        },
        error: err => {
            // show server-side validation error (optional)
            if (err.responseJSON?.errors?.name) {
                Swal.fire('Error', err.responseJSON.errors.name[0], 'error');
            } else {
                Swal.fire('Error', 'Update failed', 'error');
            }
        }
    });
});


        $('.deleteBtn').click(function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/categories/${id}`,
                        type: 'POST',
                        data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                        success: res => {
                            Swal.fire('Deleted!', res.message, 'success').then(() => location
                                .reload());
                        },
                        error: () => Swal.fire('Error', 'Delete failed', 'error')
                    });
                }
            });
        });
        
        
        $(document).ready(function () {
    $('#category_table').DataTable({
        pageLength: 10,

    });
});
    </script>
@endsection
