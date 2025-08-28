@extends('admin.layout.app')
@section('title', 'Order Management')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4 mb-5">
    <h4>Order Management</h4>
    <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
        <button class="btn btn-outline-dark filter-btn active" data-status="">All</button>
        <button class="btn btn-outline-secondary filter-btn" data-status="pending">Pending</button>
        <button class="btn btn-outline-primary filter-btn" data-status="processing">Processing</button>
        <button class="btn btn-outline-info filter-btn" data-status="shipped">Shipped</button>
        <button class="btn btn-outline-success filter-btn" data-status="delivered">Delivered</button>
        <button class="btn btn-outline-danger filter-btn" data-status="cancelled">Cancelled</button>
        <button class="btn btn-outline-warning filter-btn" data-status="returned">Returned</button>
    </div>

    <!-- Top scrollbar -->
    <div class="wrapper1" style="overflow-x: auto; overflow-y: hidden; height: 20px;">
        <div style="width: max-content;"></div>
    </div>
 
    <!-- Table wrapper -->
    <div class="wrapper2" style="overflow-x: auto;">
        <table class="table table-bordered" id="order_table" style="min-width: 1200px; width:100%;">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Order Number</th>
                    <th>User</th>
                    <th>Product Name</th>
                    <th>Product Amount</th>
                    <th>Shipping Charge</th>
                    <th>Total Amount</th>
                    <th>Order Status</th>
                    <th>Address</th>
                    <th>Ordered At</th>
                    <th>Delivered At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                <tr data-id="{{ $order->id }}" 
                    @class([
                        'table-secondary' => $order->order_status === 'pending',
                        'table-info'      => $order->order_status === 'processing',
                        'table-primary'   => $order->order_status === 'shipped',
                        'table-success'   => $order->order_status === 'delivered',
                        'table-danger'    => $order->order_status === 'cancelled',
                        'table-warning'   => $order->order_status === 'returned',
                    ])>                    
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->product_name }}</td>

                    <td>{{ $order->product_amount }}</td>
                    <td>{{ $order->shipping_charge }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>
                        <select class="form-select form-select-sm update-status order-status">
                            <option value="pending"    {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped"    {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered"  {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled"  {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="returned"   {{ $order->order_status == 'returned' ? 'selected' : '' }}>Returned</option>
                        </select>
                    </td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->ordered_at }}</td>
                    <td>{{ $order->delivered_at }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary view-invoice" data-id="{{ $order->id }}">
                            <i class="mdi mdi-file-document"></i> Invoice
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Invoice Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Invoice</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="invoiceContent">
            <!-- Invoice data will load here -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="printInvoice">Print</button>
        </div>
    </div>
  </div>
</div>

<!-- Loader -->
<div id="loader" style="display:none; 
     position:fixed; top:0; left:0; width:100%; height:100%; 
     background:rgba(255,255,255,0.7); z-index:9999; 
     display:flex; align-items:center; justify-content:center;">
    <div class="spinner-border text-primary" role="status" style="width:3rem;height:3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

@endsection

@section('script')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function(){
    $("#loader").show();

    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex){
        var selectedFilter = $(".filter-btn.active").data("status");
        if(!selectedFilter) return true;

        var status = $(settings.aoData[dataIndex].anCells[7]).find("select").val();
        return status === selectedFilter;
    });

    var table = $('#order_table').DataTable({
        scrollX: true,
        pageLength: 10,
        autoWidth: false,
        columnDefs: [
            { orderable: false, targets: [7, 10] }
        ],
        initComplete: function () {
            $("#loader").hide();
        }
    });

    $(document).on("click", ".filter-btn", function(){
        $(".filter-btn").removeClass("active");
        $(this).addClass("active");
        table.draw(); 
    });

    $(document).on("change", ".update-status", function(){
        var row = $(this).closest("tr");
        var orderId = row.data("id");
        var status = $(this).val();

        $("#loader").show();

        $.ajax({
            url: `/orders/${orderId}/status`,
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                order_status: status
            },
            success: function(res){
                row.removeClass("table-secondary table-info table-primary table-success table-danger table-warning");
                switch(status){
                    case "pending":    row.addClass("table-secondary"); break;
                    case "processing": row.addClass("table-info"); break;
                    case "shipped":    row.addClass("table-primary"); break;
                    case "delivered":  row.addClass("table-success"); break;
                    case "cancelled":  row.addClass("table-danger"); break;
                    case "returned":   row.addClass("table-warning"); break;
                }

                table.row(row).invalidate().draw(false);
                table.draw(); // re-check filter

                Swal.fire({
                    icon: "success",
                    title: "Status Updated",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });
            },
            error: function(xhr, status, error){
                Swal.fire("Error", xhr.responseJSON?.message || error || "Something went wrong!", "error");
            },
            complete: function(){  
                $("#loader").hide();
            }
        });
    });

    $(document).on("click", ".view-invoice", function(){
        var orderId = $(this).data("id");
        $("#loader").show();
        $.ajax({
            url: `/orders/${orderId}/invoice`,
            type: "GET",
            success: function(res){
                $("#invoiceContent").html(res.html);
                $("#invoiceModal").modal("show");
            },
            error: function(){
                Swal.fire("Error", "Unable to load invoice", "error");
            },
            complete: function(){
                $("#loader").hide();
            }
        });
    });

    $("#printInvoice").on("click", function () {
        var printContents = document.getElementById("invoiceContent").innerHTML;
        var win = window.open('', '', 'height=700,width=900');
        win.document.write('<html><head><title>Invoice</title>');
        win.document.write(`
            <style>
                @page { margin: 0; }
                body { margin: 0; padding: 20px; font-family: Arial, sans-serif; }
            </style>
        `);
        win.document.write('</head><body>');
        win.document.write(printContents);
        win.document.write('</body></html>');
        win.document.close();
        win.print();
    });
});
</script>
@endsection
