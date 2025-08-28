@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">QR Management</h2>
<div class="row">
    <div class="col-md-6">
        <label for="category_id">Products</label>
        <select class="form-select" name="product_id" id="product_id" required>
            <option value="">Select</option>
            @foreach ($products as $pro)
                <option value="{{ $pro->id }}">{{ $pro->name }}</option>
            @endforeach
        </select>
    </div>
    </div>
    <br>
</div>

@endsection

@section('script')
<script>
    document.getElementById('product_id').addEventListener('change', function () {
        const productId = this.value;
        if (productId) {
            window.location.href = `/qr/${productId}`;
        }
    });
</script>
@endsection
