<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->order_number }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <style>
        body { margin-top:20px; background-color:#eee; }
        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
            border-radius: 1rem;
        }
       
        .company-logo {
    max-height: 70px;
    max-width: 120px;
    object-fit: contain;
}

.invoice-title h4 {
    font-weight: 600;
    color: #2c3e50;
}

h2 {
    font-size: 1.8rem;
    letter-spacing: 0.5px;
}

.text-muted small {
    font-size: 0.9rem;
    color: #6c757d !important;
}
.shipping-text{
/*text-align: left;*/
    
}
    </style>
</head>
<body>
<div class="container">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title" style="margin-top: 60px;">
                        <h4 class="float-end font-size-15">
                            Invoice #{{ $order->order_number }} 
                            <!--<span class="badge bg-success font-size-12 ms-2">{{ ucfirst($order->payment_status ?? 'Unpaid') }}</span>-->
                        </h4>
                      <div class="mb-4 d-flex align-items-center border-bottom pb-3">
   <div class="me-3">
       <img src="{{ asset(get_setting('logo')) }}" alt="Logo" class="company-logo">
   </div>
   <!--<div>-->
   <!--    <h2 class="mb-0 fw-bold text-dark">{{ get_setting('app_name') }}</h2>-->
   <!--    <small class="text-muted">Official Invoice</small>-->
   <!--</div>-->
</div>
                    </div>

                    <hr class="my-4">

<div class="row">
    <!-- Billed To -->
    <div class="col-sm-6">
        <div class="text-muted">
            <h5 class="font-size-16 mb-3">Billed To:</h5>
            <h5 class="font-size-15 mb-2">{{ $order->user->name }}</h5>
            <p class="mb-1">{{ $order->address }}</p>
            <p class="mb-1">{{ $order->user->email }}</p>
            <p>{{ $order->user->mobile ?? '' }}</p>
        </div>
    </div>

    <!-- Shipping To -->
   <div class="col-sm-6 text-sm-end">
    <div class="text-muted">
        <h5 class="font-size-16 mb-3">Shipping To:</h5>
        <!--<h5 class="font-size-15 mb-2 shipping-text">{{ $order->shipping_name ?? $order->user->name }}</h5>-->
        <p class="mb-1 shipping-text">{{ get_setting('Shipping Address')}}</p>
        <!--<p class="mb-1 shipping-text">{{ $order->shipping_email ?? $order->user->email }}</p>-->
        <!--<p class="shipping-text">{{ $order->shipping_phone ?? $order->user->phone ?? '' }}</p>-->
    </div>
</div>

</div>
            
                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Item</th>
                                        <th>Price (₹)</th>
                                        <th>Quantity</th>
                                        <th class="text-end">Total (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>
                                            <div>
@php
    $words = explode(' ', $order->product_name);
    $chunks = array_chunk($words, 3); // break into groups of 3 words
@endphp

<h5 class="font-size-14 mb-1">
    @foreach($chunks as $chunk)
        {{ implode(' ', $chunk) }}<br>
    @endforeach
</h5>                                            </div>
                                        </td>
                                        <td>₹{{ number_format($order->product_amount, 2) }}</td>
                                        <td>1</td>
                                        <td class="text-end">₹{{ number_format($order->product_amount * 1, 2) }}</td>
                                    </tr>
                                    <!--<tr>-->
                                    <!--    <th scope="row" colspan="4" class="text-end">Sub Total</th>-->
                                    <!--    <td class="text-end">₹{{ number_format($order->subtotal, 2) }}</td>-->
                                    <!--</tr>-->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">Shipping Charge</th>
                                        <td class="border-0 text-end">₹{{ number_format($order->shipping_charge, 2) }}</td>
                                    </tr>
                               
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">Grand Total</th>
                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold">₹{{ number_format($order->total_amount, 2) }}</h4></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</body>
</html>
