@extends('admin.layout.app')
@section('title', 'Product Catalog')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Product Catalog</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">+ Add Product</button>
    </div>

    {{-- Filters --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="filter_name" class="form-control" placeholder="Filter by Name">
        </div>
        <div class="col-md-4">
            <select id="filter_category" class="form-control">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select id="filter_status" class="form-control">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>

    <table class="table table-bordered" id="product_table">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- AJAX populated -->
        </tbody>
    </table>
</div>

{{-- Loader --}}
<div id="ajaxLoader" 
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(255,255,255,0.7); z-index:2000; 
            display:flex; justify-content:center; align-items:center;">
    <div class="spinner-border text-primary" role="status" style="width:3rem; height:3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

{{-- Create Product Modal --}}
<div class="modal fade" id="createProductModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="createProductForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5>Add Product</h5></div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                    <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
                    <input type="number" name="price" class="form-control mb-2" placeholder="Price" required>
                    <input type="number" name="discount_price" class="form-control mb-2" placeholder="Discount Price">
                    <input type="number" name="stock" class="form-control mb-2" placeholder="Stock">

                    <label>Category</label>
                    <select name="category_id" class="form-control mb-2" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <label>Main Image</label>
                    <input type="file" name="image" class="form-control mb-2" required>

                    <label>Gallery Images</label>
                    <div id="galleryWrapper">
                        <div class="input-group mb-2">
                            <input type="file" name="gallery[]" class="form-control">
                            <button type="button" class="btn btn-success addGalleryBtn">+</button>
                        </div>
                    </div>

                    <select name="status" class="form-control mb-2">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success createBtn">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Product Modal --}}
<div class="modal fade" id="editProductModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editProductForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="edit_id">
            <div class="modal-content">
                <div class="modal-header"><h5>Edit Product</h5></div>
                <div class="modal-body">
                    <input type="text" name="name" id="edit_name" class="form-control mb-2" placeholder="Name" required>
                    <textarea name="description" id="edit_description" class="form-control mb-2" placeholder="Description"></textarea>
                    <input type="number" name="price" id="edit_price" class="form-control mb-2" placeholder="Price" required>
                    <input type="number" name="discount_price" id="edit_discount_price" class="form-control mb-2" placeholder="Discount Price">
                    <input type="number" name="stock" id="edit_stock" class="form-control mb-2" placeholder="Stock">

                    <label>Category</label>
                    <select name="category_id" id="edit_category_id" class="form-control mb-2" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <label>Main Image</label>
                    <input type="file" name="image" class="form-control mb-2">

                    <label>Gallery Images</label>
                    <div id="editGalleryWrapper">
                        <div class="input-group mb-2">
                            <input type="file" name="gallery[]" class="form-control">
                            <button type="button" class="btn btn-success addGalleryBtn">+</button>
                        </div>
                    </div>

                    <select name="status" id="edit_status" class="form-control mb-2">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning updateBtn">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function showLoader(){
    $("#ajaxLoader").fadeIn(150).css("display","flex");
    $(".createBtn, .updateBtn").prop("disabled", true);
}
function hideLoader(){
    $("#ajaxLoader").fadeOut(150, function(){
        $(this).css("display","none");
    });
    $(".createBtn, .updateBtn").prop("disabled", false);
}

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

// Dynamic gallery fields
$(document).on('click', '.addGalleryBtn', function(){
    let wrapper = $(this).closest('#galleryWrapper, #editGalleryWrapper');
    wrapper.append(`<div class="input-group mb-2">
        <input type="file" name="gallery[]" class="form-control">
        <button type="button" class="btn btn-danger removeGalleryBtn">-</button>
    </div>`);
});
$(document).on('click', '.removeGalleryBtn', function(){
    $(this).closest('.input-group').remove();
});

// Load products
function loadProducts(){
    let name = $('#filter_name').val() || '';
    let category = $('#filter_category').val() || '';
    let status = $('#filter_status').val() || '';
    showLoader();
    $.get("{{ route('product-catalog.index') }}", { name, category, status }, function(products){
        let rows = '';
        products.forEach((p,i)=>{
            rows += `<tr>
                <td>${i+1}</td>
                <td>${p.image ? `<img src="/storage/${p.image}" width="50" height="50">` : '-'}</td>
                <td>${p.name}</td>
                <td>${p.price}</td>
                <td>${p.category?.name ?? '-'}</td>
                <td>
                    <select class="statusDropdown form-control" data-id="${p.id}">
                        <option value="1" ${p.status ? 'selected' : ''}>Active</option>
                        <option value="0" ${!p.status ? 'selected' : ''}>Inactive</option>
                    </select>
                </td>
                <td>${new Date(p.created_at).toLocaleDateString()}</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn" data-id="${p.id}">Edit</button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="${p.id}">Delete</button>
                </td>
            </tr>`;
        });
        $('#product_table tbody').html(rows);
    }).always(()=> hideLoader());
}

// Filters
$('#filter_name, #filter_category, #filter_status').on('change keyup', function(){ loadProducts(); });

$(document).ready(function () {
    loadProducts();

// CREATE
$('#createProductForm').on('submit', function(e){
    e.preventDefault();
    let form = this; // store form reference
    let fd = new FormData(form);

    showLoader();

    $.ajax({
        url: "{{ route('product-catalog.store') }}",
        method: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        success: function(res){ 
            Swal.fire('Success', res.message,'success'); 
            $('#createProductModal').modal('hide'); 
            
            // reset form safely
            form.reset(); 
            $('#galleryWrapper').html(`
                <div class="input-group mb-2">
                    <input type="file" name="gallery[]" class="form-control">
                    <button type="button" class="btn btn-danger removeGalleryBtn">-</button>
                </div>
            `);

            // reload table
            loadProducts();

            // fix stuck body
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        },
           error: function(xhr) {
       if (xhr.status === 422 || xhr.status===500) 
{ 
        let errors = xhr.responseJSON.errors;
        let msg = '';

        if (errors) {
            $.each(errors, function(key, val){
                msg += val[0] + '<br>';
            });
        }

        // fallback to message/error
        if (xhr.responseJSON.message) {
            msg += xhr.responseJSON.message + '<br>';
        }
        if (xhr.responseJSON.error) {
            msg += xhr.responseJSON.error + '<br>';
        }

        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: msg
        });

    } else {
        Swal.fire('Error', 'Failed to create product','error');
    }
},

        complete: function(){ 
            hideLoader();
        }
    });
});


    // EDIT
    $(document).on('click', '.editBtn', function(){
        let id = $(this).data('id');
        showLoader();
        $.get(`/product-catalog/${id}/edit`, function(res){
            $('#edit_id').val(res.id);
            $('#edit_name').val(res.name);
            $('#edit_description').val(res.description);
            $('#edit_price').val(res.price);
            $('#edit_discount_price').val(res.discount_price);
            $('#edit_stock').val(res.stock);
            $('#edit_category_id').val(res.category_id);
            $('#edit_status').val(res.status ? 1 : 0);
            $('#editProductModal').modal('show');
        }).always(()=> hideLoader());
    });

    // UPDATE
    $('#editProductForm').on('submit', function(e){
        e.preventDefault();
        let id = $('#edit_id').val();
        let fd = new FormData(this);
        fd.append('_method','PUT');
        showLoader();
        $.ajax({
            url: `/product-catalog/${id}`,
            method: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: res=>{ 
                Swal.fire('Updated', res.message, 'success'); 
                $('#editProductModal').modal('hide'); 
                loadProducts();
            },
    error: function(xhr) {
    if (xhr.status === 422 || xhr.status===500) { 
        let errors = xhr.responseJSON.errors;
        let msg = '';

        if (errors) {
            $.each(errors, function(key, val){
                msg += val[0] + '<br>';
            });
        }

        if (xhr.responseJSON.message) {
            msg += xhr.responseJSON.message + '<br>';
        }
        if (xhr.responseJSON.error) {
            msg += xhr.responseJSON.error + '<br>';
        }

        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: msg
        });

    } 
    
    else {
        Swal.fire('Error', 'Failed to create product','error');
    }
}
,   complete: ()=> hideLoader()
        });
    });

    // DELETE
    $(document).on('click', '.deleteBtn', function(){
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this product!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then(result=>{
            if(result.isConfirmed){
                showLoader();
                $.ajax({
                    url: `/product-catalog/${id}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: res=>{ Swal.fire('Deleted', res.message, 'success'); loadProducts(); },
    error: function(xhr){
            if(xhr.status === 422){ 
                let errors = xhr.responseJSON.errors;
                let msg = '';
                $.each(errors, function(key, val){
                    msg += val[0] + '<br>';
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: msg
                });
            } else {
                Swal.fire('Error', 'Failed to delete product','error');
            }
        },                    complete: ()=> hideLoader()
                });
            }
        });
    });

    // STATUS
    $(document).on('change', '.statusDropdown', function(){
        let id = $(this).data('id');
        let status = $(this).val();
        showLoader();
        $.ajax({
            url: `/product-catalog/${id}/status`,
            type: 'POST',
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

            data: { status },
            success: res=> Swal.fire('Updated', res.message, 'success'),
    error: function(xhr){
            if(xhr.status === 422){ 
                let errors = xhr.responseJSON.errors;
                let msg = '';
                $.each(errors, function(key, val){
                    msg += val[0] + '<br>';
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: msg
                });
            } else {
                Swal.fire('Error', 'Failed to update status','error');
            }
        },            complete: ()=> hideLoader()
        });
    });
});

$(document).ready(function () {
    $('#product_table').DataTable({
        pageLength: 10,

    });
});
</script>
@endsection
