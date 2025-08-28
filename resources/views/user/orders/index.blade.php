@extends('user.layout.app')

@section('content')
<div class="container py-5" style="font-family: 'Open Sans', sans-serif; color: #333;">
    <h2 class="mb-5 text-center fw-bold" style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #1a202c;">
        My Orders
    </h2>

    <!-- Responsive Filter Buttons and Dropdown -->
    <div class="mb-5">
        <!-- Filter Buttons (visible on md and larger) -->
        <div class="d-flex flex-wrap justify-content-center gap-2 d-none d-md-flex">
            <button class="btn btn-outline-dark filter-btn active" data-status="">All</button>
            <button class="btn btn-outline-secondary filter-btn" data-status="pending">Pending</button>
            <button class="btn btn-outline-primary filter-btn" data-status="processing">Processing</button>
            <button class="btn btn-outline-info filter-btn" data-status="shipped">Shipped</button>
            <button class="btn btn-outline-success filter-btn" data-status="delivered">Delivered</button>
            <button class="btn btn-outline-danger filter-btn" data-status="cancelled">Cancelled</button>
            <button class="btn btn-outline-warning filter-btn" data-status="returned">Returned</button>
        </div>

        <!-- Filter Dropdown (visible on small screens) -->
        <select id="filter-select" class="form-control d-md-none" aria-label="Filter orders by status">
            <option value="" selected>All</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
            <option value="cancelled">Cancelled</option>
            <option value="returned">Returned</option>
        </select>
    </div>

    <div class="orders-grid">
        @forelse($orders as $order)
        <div class="order-card rounded shadow-sm p-4 mb-4" data-status="{{ $order->order_status }}"
            style="background: #f9fafb;border: 1px solid #dee2e6;transition: box-shadow 0.3s ease;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div style="font-weight: 700; font-size: 1.1rem; color: #4f46e5;">
                    Order #: {{ $order->order_number }}
                </div>
                <div>
                    @switch($order->order_status)
                        @case('pending')
                            <span style="background-color: #9ca3af; color: #f9fafb; padding: 6px 14px; border-radius: 9999px; font-weight: 600; font-size: 0.85rem;">
                                Pending
                            </span>
                            @break
                        @case('processing')
                            <span style="background-color: #3b82f6; color: #f9fafb; padding: 6px 14px; border-radius: 9999px; font-weight: 600; font-size: 0.85rem;">
                                Processing
                            </span>
                            @break
                        @case('shipped')
                            <span style="background-color: #2563eb; color: #f9fafb; padding: 6px 14px; border-radius: 9999px; font-weight: 600; font-size: 0.85rem;">
                                Shipped
                            </span>
                            @break
                        @case('delivered')
                            <span style="background-color: #16a34a; color: #f9fafb; padding: 6px 14px; border-radius: 9999px; font-weight: 600; font-size: 0.85rem;">
                                Delivered
                            </span>
                            @break
                        @case('cancelled')
                            <span style="background-color: #dc2626; color: #f9fafb; padding: 6px 14px; border-radius: 9999px; font-weight: 600; font-size: 0.85rem;">
                                Cancelled
                            </span>
                            @break
                        @case('returned')
                            <span style="background-color: #fbbf24; color: #1f2937; padding: 6px 14px; border-radius: 9999px; font-weight: 600; font-size: 0.85rem;">
                                Returned
                            </span>
                            @break
                        @default
                            <span style="background-color: #e5e7eb; color: #374151; padding: 6px 14px; border-radius: 9999px; font-weight: 600; font-size: 0.85rem;">
                                {{ ucfirst($order->order_status) }}
                            </span>
                    @endswitch
                </div>
            </div>

            <div class="mb-3"><strong>Product:</strong> {{ $order->product_name }}</div>

            <a href="{{ route('orders.show.more', $order->id) }}" class="btn btn-indigo btn-sm mb-3">
                View More
            </a>
        </div>
        @empty
        <div class="text-center text-gray-500 py-4" style="font-style: italic;">No orders found.</div>
        @endforelse
    </div>
    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->withQueryString()->links() }}
    </div>
    
</div>

<style>
    .orders-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    @media (max-width: 768px) {
        .orders-grid {
            grid-template-columns: 1fr;
        }
    }

    .btn-indigo {
        background-color: #4f46e5;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 6px 12px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.85rem;
        transition: background-color 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-indigo:hover {
        background-color: #4338ca;
        text-decoration: none;
        color: white;
    }

    @media (max-width: 480px) {
        .filter-btn {
            flex: 1 1 100%;
        }
    }

    /* FORCE hiding filter buttons on small screens */
    @media (max-width: 767.98px) {
        .d-none.d-md-flex {
            display: none !important;
        }
    }
</style>
@endsection

@section('script')
<script>
    // Button filter functionality
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function () {
            const selectedStatus = this.getAttribute('data-status');

            // Toggle active button style
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Reset dropdown selection
            const select = document.getElementById('filter-select');
            if (select) {
                select.value = selectedStatus;
            }

            filterOrders(selectedStatus);
        });
    });

    // Dropdown filter functionality
    const filterSelect = document.getElementById('filter-select');
    if (filterSelect) {
        filterSelect.addEventListener('change', function () {
            const selectedStatus = this.value;

            // Reset active button style on buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-status') === selectedStatus);
            });

            filterOrders(selectedStatus);
        });
    }

    function filterOrders(status) {
        document.querySelectorAll('.order-card').forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            if (!status || cardStatus === status) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection
