@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Product Management</h2>

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#productModal" onclick="openProductModal()">Add Product</button>

    <!-- Table -->
    <table class="table table-bordered" id="productTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>QR</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $i => $product)
            <tr id="productRow{{ $product->id }}">
                <td>{{ $i + 1 }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>{{ $product->name }}</td>
                <td>₹{{ $product->price }}</td>
                <td>{{ $product->stock_quantity }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="60">
                    @endif
                </td>
                <td>
                   <a href="{{ url('qr/' . $product->id) }}" class="btn btn-sm btn-primary mt-1">
        <i class="bi bi-qr-code-scan"></i> QR
    </a>
                </td>
                <td>
                    <button class="btn btn-sm btn-info" onclick="editProduct({{ $product->id }})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteProduct({{ $product->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="productForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="id" id="product_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalTitle">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Category</label>
                        <select class="form-select" name="category_id" id="category_id" required>
                            <option value="">Select</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" required>
                    </div>

                    <div class="col-md-4">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock_quantity" id="stock_quantity">
                    </div>

                    <div class="col-md-4">
                        <label>Weight (KG)</label>
                        <input type="number" step="0.01" class="form-control" name="weight" id="weight">
                    </div>

                    <div class="col-md-6">
                        <label>Dimensions</label>
                        <input type="text" class="form-control" name="dimensions" id="dimensions">
                    </div>

                    <div class="col-md-6">
                        <label>Main Image</label>
                        <input type="file" class="form-control" name="main_image" id="main_image">
                        <img id="mainImagePreview" src="#" style="display: none; width: 100px; margin-top: 5px;">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Product</button>
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
function openProductModal() {
    $('#productForm')[0].reset();
    $('#product_id').val('');
    $('#formMethod').val('POST');
    $('#productModalTitle').text('Add Product');
    $('#mainImagePreview').hide();
}

$('#main_image').change(function(){
    previewImage(this, '#mainImagePreview');
});

function previewImage(input, previewSelector){
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $(previewSelector).attr('src', e.target.result).show();
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$('#productForm').submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);
    let id = $('#product_id').val();

    let url = (id === '')
        ? "{{ route('products.store') }}"
        : "{{ route('products.update', ':id') }}".replace(':id', id);

    formData.append('_method', (id === '') ? 'POST' : 'PUT');

    $.ajax({
        type: 'POST', // always POST with _method override
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            $('#productModal').modal('hide');
            Swal.fire('Success!', res.message || 'Product saved!', 'success').then(() => location.reload());
        },
        error: function(xhr) {
            if (xhr.status === 422) {
            const errors = xhr.responseJSON.errors;
            let errorMessages = '';
            for (let field in errors) {
                errorMessages += errors[field].join('<br>') + '<br>';
            }
            Swal.fire('Validation Error!', errorMessages, 'error');
        } else {
            Swal.fire('Error!', 'Something went wrong.', 'error');
        }
        console.error(xhr);
        }
    });
});


function editProduct(id){
    $.get("{{ url('products') }}/" + id, function(product){
        $('#product_id').val(product.id);
        $('#formMethod').val('POST');
        $('#productModalTitle').text('Edit Product');

        $('#category_id').val(product.category_id);
        $('#name').val(product.name);
        $('#description').val(product.description);
        $('#price').val(product.price);
        $('#stock_quantity').val(product.stock_quantity);
        $('#weight').val(product.weight);
        $('#dimensions').val(product.dimensions);

        if(product.image){
            $('#mainImagePreview').attr('src', '{{ asset("storage") }}/' + product.image).show();
        }

        $('#productModal').modal('show');
    });
}

function deleteProduct(id){
    Swal.fire({
        title: 'Are you sure?',
        text: 'This product will be permanently deleted!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ url('products') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(){
                    $('#productRow' + id).remove();
                    Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                },
                error: function() {
                    Swal.fire('Error!', 'Could not delete product.', 'error');
                }
            });
        }
    });
}

$(document).ready(function () {
    $('#productTable').DataTable({
        pageLength: 10,

    });
});
</script>
@endsection
