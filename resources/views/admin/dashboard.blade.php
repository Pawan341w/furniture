@extends('admin.layout.app')
@section('title','Dashboard')

@section('content')
 <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-new/themes/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Users <i class="mdi mdi-account-multiple mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ num_format($totalUsers) }}</h2>
                    {{-- <h6 class="card-text">Increased by 60%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-new/themes/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Product <i class="mdi mdi-view-grid mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ num_format($totalProducts) }}</h2>
                    {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-new/themes/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total QR Codes <i class="mdi mdi-qrcode mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ num_format($totalQRCodes) }}</h2>
                    <h6 class="card-text">Increased by 5%</h6>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recent Tickets</h4>
                    <div class="table-responsive">
                     <table class="table">
  <thead>
    <tr>
      <th>Assignee</th>
      <th>Product</th>
      <th>QR Code</th>
      <th>Coin Reward</th>
      <th>Used At</th>
      <th>Last Updated</th>
    </tr>
  </thead>
  <tbody>
    @foreach($usedQRCodes as $qr)
      @php
        $user = $qr->usedUser;
        $userImage = $user && $user->profile_image ? asset('storage/' . $user->profile_image) : asset('demo-user.jpg');
      @endphp
      <tr>
        <td>
          <img src="{{ $userImage }}" class="me-2 rounded-circle" width="30" height="30" alt="User Image">
          {{ $user->name ?? 'Unknown User' }}
        </td>
        <td>{{ $qr->product->name ?? 'N/A' }}</td>
        <td>{{ $qr->code }}</td>
        <td>{{ $qr->coin_reward ?? 0 }}</td>
        <td>{{ $qr->used_at ? \Carbon\Carbon::parse($qr->used_at)->format('d M, Y h:i A') : '-' }}</td>
        <td>{{ $qr->updated_at ? $qr->updated_at->diffForHumans() : '-' }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
          @endsection
