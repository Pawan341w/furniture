@extends('user.layout.app')

@section('content')
<div class="container py-5" style="font-family: 'Open Sans', sans-serif; color: #333;">
    <h2 class="mb-5 text-center fw-bold" style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #1a202c;">
        Order Details
    </h2>
<div class="order-tracker">
  <div class="order-header">
    <div>
      <strong>Tracking Number</strong>
      #{{ $order->order_number }}
    </div>
    <div>
      <!--<strong>Expected Arrival</strong>-->
      <!--Aug 25, 2025-->
    </div>
  </div>

  <div class="progress-container">
    <!-- Normal progress bar -->
    <svg>
      <line x1="10%" y1="40" x2="90%" y2="40" stroke="#ddd" stroke-width="6" />
      <line class="progress-bar" x1="10%" y1="40" x2="90%" y2="40" />
    </svg>

    <!-- Steps -->
    <div class="step pending">
      <div class="step-circle">✔</div>
      <div class="step-label">Pending</div>
    </div>
    <div class="step processing">
      <div class="step-circle">✔</div>
      <div class="step-label">Processed</div>
    </div>
    <div class="step shipped">
      <div class="step-circle">✔</div>
      <div class="step-label">Shipped</div>
    </div>
    <div class="step delivered">
      <div class="step-circle">✔</div>
      <div class="step-label">Delivered</div>
    </div>
  </div>

    <!-- Cancel / Return Note -->
    <div class="order-note" style="display:none; text-align:center; margin-top:20px; color:red; font-weight:bold;">
      <!-- This text will show dynamically -->
      Order has been {{ucfirst($order->order_status)}}.
    </div>
</div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="order-details-card rounded shadow-sm p-4" style="background: #f9fafb; border: 1px solid #dee2e6;">
        <div class="mb-3"><strong>Order Number:</strong> {{ $order->order_number }}</div>
        <div class="mb-3"><strong>Product:</strong> {{ $order->product_name }}</div>
        <div class="mb-3"><strong>Amount:</strong> <img src="{{ asset('assets/images/icons/coin.png') }}" alt="coin" width="16" style="margin-bottom:2px;">{{ number_format($order->product_amount, 2) }}</div>
        <div class="mb-3"><strong>Shipping:</strong> <img src="{{ asset('assets/images/icons/coin.png') }}" alt="coin" width="16" style="margin-bottom:2px;">{{ number_format($order->shipping_charge, 2) }}</div>
        <div class="mb-3"><strong>Total:</strong> <img src="{{ asset('assets/images/icons/coin.png') }}" alt="coin" width="16" style="margin-bottom:2px;">{{ number_format($order->total_amount, 2) }}</div>
        <div class="mb-3"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</div>
        <!--<div class="mb-3"><strong>Payment Status:</strong> -->
        <!--    @if($order->payment_status == 'paid')-->
        <!--        <span style="color: #22c55e; font-weight: 600;">Paid</span>-->
        <!--    @else-->
        <!--        <span style="color: #facc15; font-weight: 600;">Unpaid</span>-->
        <!--    @endif-->
        <!--</div>-->
        <div class="mb-3"><strong>Address:</strong> {{ $order->address }}</div>
        <div class="mb-3"><strong>Transaction ID:</strong> {{ $order->txn_id ?? 'N/A' }}</div>
        <div class="mb-3"><strong>Order Status:</strong> {{ ucfirst($order->order_status) }}</div>
        <div class="mb-3"><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('orders.show') }}" class="btn btn-indigo btn-sm">Back to Orders</a>

        @if($order->order_status != 'cancelled' && $order->order_status != 'completed' && $order->order_status != 'returned')
            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this order?');">
                    Cancel Order
                </button>
            </form>
        @endif
    </div>
</div>

<style>
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
    }
    .btn-indigo:hover {
        background-color: #4338ca;
        text-decoration: none;
        color: white;
    }
    .btn-danger {
        background-color: #ef4444;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 6px 12px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.85rem;
        transition: background-color 0.3s ease;
    }
    .btn-danger:hover {
        background-color: #dc2626;
    }
    
    
     .order-tracker {
             margin-bottom: 13px;
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      width: 100%;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .order-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    .order-header div {
      font-size: 14px;
      color: #555;
      margin-bottom: 10px;
    }
    .order-header strong {
      display: block;
      font-size: 16px;
      color: #222;
    }

    /* Progress container */
    .progress-container {
      position: relative;
      margin: 40px 0;
    }
    svg {
      width: 100%;
      height: 80px;
    }
    .progress-bar {
      stroke: #3498db;
      stroke-width: 6;
      fill: none;
      stroke-dasharray: 600;
      stroke-dashoffset: 600;
      transition: stroke-dashoffset 1.5s ease-in-out;
    }

    /* Steps */
    .step {
      position: absolute;
      text-align: center;
      width: 100px;
      transform: translateX(-50%);
      opacity: 0;
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .step.active {
      opacity: 1;
      transform: translateX(-50%) scale(1.1);
    }
    .step-circle {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: #ddd;
      margin: 0 auto 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 14px;
      transition: background 0.5s ease;
    }
    .step.active .step-circle {
      background: #3498db;
    }
    .step-label {
      font-size: 12px;
      color: #666;
    }

    /* Desktop positions */
    .step.pending{ left: 10%; top: -10px; }
    .step.processing { left: 35%; top: -10px; }
    .step.shipped   { left: 65%; top: -10px; }
    /*.step.enroute   { left: 65%; top: -10px; }*/
    .step.delivered   { left: 90%; top: -10px; }
    
    
    


    /* Mobile view */
    @media (max-width: 600px) {
      svg { display: none; } /* hide line */
      .progress-container {
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .step {
        position: relative;
        transform: none !important;
        width: 100%;
        margin: 15px 0;
        opacity: 1; /* always visible */
      }
      .step-circle {
        margin-bottom: 4px;
      }
    }
    @media (max-width: 768px) {
  .progress-container {
    flex-direction: column;
    align-items: flex-start;
    padding-left: 40px;
  }

  .progress-container svg {
    display: none; /* hide horizontal line */
  }

  .step {
    flex: unset;
    text-align: left;
    margin-bottom: 20px;
    position: relative;
  }

  .step-circle {
    margin: 0;
    margin-right: 10px;
  }

  .step-label {
    display: inline-block;
    vertical-align: middle;
  }

  /* add vertical timeline line */
  .progress-container::before {
    content: "";
    position: absolute;
    top: 20px;
    left: 20px;
    width: 4px;
    height: 100%;
    background: #ddd;
  }

  .step::before {
    content: "";
    position: absolute;
    top: 17px;
    left: -20px;
    width: 20px;
    height: 2px;
    background: #ddd;
  }
  

    
      .step.pending{ left: 0%; top: -10px; }
    .step.processing { left: 0%; top: -10px; }
    .step.shipped   { left: 0%; top: -10px; }
    /*.step.enroute   { left: 65%; top: -10px; }*/
    .step.delivered   { left: 0%; top: -10px; }
}

</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
      // Change current status here
      let currentStatus = "{{$order->order_status }}"; 
      if(currentStatus=='cancelled'||currentStatus=='returned')
      {
          let orderNote = document.querySelector(".order-note");
          let progress_container=document.querySelector(".progress-container");
    if(orderNote) {
        orderNote.style.display = "block"; // Show the message
        progress_container.style.display="none";
    }
      }
      else
      {
      const steps = ['pending','processing','shipped','delivered',''];
      let activeIndex = steps.indexOf(currentStatus);

      let progressBar = document.querySelector(".progress-bar");
      let totalLength = 600;
      let progress = (activeIndex / (steps.length - 1)) * totalLength;

      // Animate steps one by one
      steps.forEach((step, i) => {
        setTimeout(() => {
          if (i <= activeIndex) {
            document.querySelector(".step." + step).classList.add("active");
            progressBar.style.strokeDashoffset = totalLength - ((i / (steps.length - 1)) * totalLength);
          }
        }, i * 800); // delay each step
      });
      }
    });
  </script>
@endsection
