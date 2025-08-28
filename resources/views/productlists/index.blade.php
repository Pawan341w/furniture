@extends('user.layout.app')

@php
    use Illuminate\Support\Str;
@endphp

<style>
    option{
    white-space: pre-line;
}
</style>
@section('title', 'Gift Card')

@section('content')
<div class="container py-4">

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Header and Manage Address Button --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gift Card</h2>
        <a href="{{ route('address.index') }}" class="btn btn-outline-primary d-none d-md-inline-block">Manage Addresses</a>
    </div>



    {{-- Filter Form --}}
<div class="row mb-4" id="filterContainer">
    <div class="col-md-3 mb-2">
        <input type="text" name="name" id="filter_name" class="form-control" placeholder="Filter by Name"
               value="{{ request('name') }}">
    </div>

    <div class="col-md-3 mb-2">
        <select name="category_id" id="filter_category" class="form-control">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2 mb-2">
        <input type="number" name="min_price" id="filter_min_price" class="form-control" placeholder="Min Price"
               value="{{ request('min_price') }}">
    </div>

    <div class="col-md-2 mb-2">
        <input type="number" name="max_price" id="filter_max_price" class="form-control" placeholder="Max Price"
               value="{{ request('max_price') }}">
    </div>
</div>



{{-- Product List & Pagination Container --}}
    <div id="productListContainer">
        <div class="row g-4">
            @forelse ($products as $productItem)
                <div class="col-md-4 col-sm-6">
                    <div class="card product-card h-100">
                        @if ($productItem->image)
                            <img src="{{ asset('storage/' . $productItem->image) }}" class="card-img-top product-img" alt="{{ $productItem->name }}">
                        @else
                            <img src="{{ asset('assets/images/placeholder.png') }}" class="card-img-top product-img" alt="No image">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate" title="{{ $productItem->name }}">{{ $productItem->name }}</h5>

                            <p class="card-text product-description">{{ Str::limit($productItem->description, 100) }}</p>

                            <div class="price-tag mb-2 flex-wrap">
                                <img src="{{ asset('assets/images/icons/coin.png') }}" alt="coin" width="18" height="18" style="margin-bottom: 3px;">
                                @php
                                    $discount = $productItem->discount_price ?? 0;
                                    $finalPrice = max(0, $productItem->price - $discount);
                                @endphp

                                @if ($discount > 0)
                                    <span class="fw-bold text-muted">{{ number_format($finalPrice, 0) }}</span>
                                    <span class="text-danger text-decoration-line-through ms-2">{{ number_format($productItem->price, 0) }}</span>
                                    <span class="badge bg-success ms-2">{{ number_format($discount, 0) }} OFF</span>
                                @else
                                    <span class="fw-bold text-dark">{{ number_format($productItem->price, 0) }}</span>
                                @endif
                            </div>

                            <button class="btn btn-success purchase-btn mt-auto"
                                data-bs-toggle="modal"
                                data-bs-target="#purchaseModal"
                                data-product-id="{{ $productItem->id }}"
                                data-product-name="{{ $productItem->name }}">
                                Purchase
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted fs-5">No products available.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>


<!-- Purchase Modal -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="purchaseForm">
      @csrf
      <input type="hidden" name="product_id" id="product_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="purchaseModalLabel">Purchase Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <p id="productName" class="fw-bold"></p>

          <div class="mb-3">
            <label for="address_id" class="form-label">Select Delivery Address</label>

            <select name="address_id" id="address_id" class="form-select" required>
              <option value="">-- Select Address --</option>
              @foreach ($addresses as $address)
<option value="{{ $address->id }}">
    {{ $address->address_line1 }}, {{ $address->city }}, {{ $address->state }}, {{ $address->country }}{{ $address->pincode }}

</option>
              @endforeach
            </select>
          </div>



          <div class="mb-3">
            <a href="{{ route('address.index') }}" target="_blank">Manage Addresses</a>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Confirm Purchase</button>
        </div>
      </div>
    </form>
  </div>
</div>


<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        border-radius: 0.75rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .product-img {
        height: 220px;
        object-fit: cover;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
    }
    .price-tag {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        color: #28a745; /* Bootstrap success green */
        font-size: 1.1rem;
    }
    .purchase-btn {
        border-radius: 0.5rem;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .purchase-btn:hover {
        background-color: #1e7e34;
    }
    .card-body {
        display: flex;
        flex-direction: column;
    }
    .product-description {
        flex-grow: 1;
        margin-bottom: 1rem;
        color: #6c757d; /* Bootstrap secondary text */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var purchaseModal = document.getElementById('purchaseModal');

    // Open modal and set product data
    purchaseModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var productId = button.getAttribute('data-product-id');
        var productName = button.getAttribute('data-product-name');

        purchaseModal.querySelector('#productName').textContent = productName;
        purchaseModal.querySelector('#product_id').value = productId;

        // Reset fields
        purchaseModal.querySelector('#address_id').value = '';
        // Commented out because payment_method field is not in use
        // purchaseModal.querySelector('#payment_method').value = '';
    });

    // Handle form submit with AJAX
    document.getElementById('purchaseForm').addEventListener('submit', function (e) {
        e.preventDefault();

        let form = e.target;
        let formData = new FormData(form);

        // 🔄 Show instant loading feedback
        Swal.fire({
            title: 'Processing your purchase...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("{{ route('user.products.purchase') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Purchase Successful',
                    text: data.message || 'Your order has been placed successfully!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Close modal and reload
                    bootstrap.Modal.getInstance(document.getElementById('purchaseModal')).hide();
window.location.href = 'show/orders';

                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message || 'Something went wrong!',
                    confirmButtonColor: '#d33'
                });
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred.',
                confirmButtonColor: '#d33'
            });
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const nameInput = document.getElementById('filter_name');
    const categorySelect = document.getElementById('filter_category');
    const minPriceInput = document.getElementById('filter_min_price');
    const maxPriceInput = document.getElementById('filter_max_price');
    const productListContainer = document.getElementById('productListContainer');

    function fetchFilteredProducts(page = 1) {
        const params = new URLSearchParams();

        if (nameInput.value.trim() !== '') {
            params.append('name', nameInput.value.trim());
        }

        if (categorySelect.value !== '') {
            params.append('category_id', categorySelect.value);
        }

        if (minPriceInput.value.trim() !== '') {
            params.append('min_price', minPriceInput.value.trim());
        }

        if (maxPriceInput.value.trim() !== '') {
            params.append('max_price', maxPriceInput.value.trim());
        }

        if (page > 1) {
            params.append('page', page);
        }

        fetch("{{ route('user.products.index') }}?" + params.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            productListContainer.innerHTML = data.html;
            attachPaginationHandlers();
        })
        .catch(err => {
            console.error('AJAX Filter error:', err);
        });
    }

    let typingTimer;
    const delay = 500;

    nameInput.addEventListener('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => fetchFilteredProducts(), delay);
    });

    nameInput.addEventListener('keydown', function () {
        clearTimeout(typingTimer);
    });

    categorySelect.addEventListener('change', () => fetchFilteredProducts());
    minPriceInput.addEventListener('change', () => fetchFilteredProducts());
    maxPriceInput.addEventListener('change', () => fetchFilteredProducts());

    function attachPaginationHandlers() {
        const paginationLinks = productListContainer.querySelectorAll('.pagination a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const url = new URL(this.href);
                const page = url.searchParams.get('page') || 1;
                fetchFilteredProducts(page);
            });
        });
    }

    attachPaginationHandlers();
});

</script>


@endsection
