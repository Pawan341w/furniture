@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">QR Code Generator: {{ $product->name }}</h2>

    <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">← Back to Products</a>
    </div>

    {{-- QR Code Generation Form --}}
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form id="qrForm">
    @csrf
    <input type="hidden" id="product_id" value="{{ $product->id }}">
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="count" class="form-label">QR Count (max 20)</label>
            <input type="number" name="count" id="count" class="form-control" min="1" max="20" required placeholder="e.g. 5">
        </div>
        <div class="col-md-6 mb-3">
            <label for="coin_rewards" class="form-label">Coin Rewards (comma-separated)</label>
            <input type="text" name="coin_rewards" id="coin_rewards" class="form-control" placeholder="e.g. 10,20,30">
            <small class="text-muted">Match rewards with QR count. Default = 0 if empty.</small>
        </div>
        <div class="col-md-3 d-flex align-items-end mb-3">
            <button type="submit" class="btn btn-primary w-100">Generate QR Codes</button>
        </div>
    </div>
</form>

        </div>
    </div>

    {{-- QR Code Table --}}
    @if($qrCodes->count())
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4">Generated QR Codes</h5>
            <div class="table-responsive">
                <table id="qrTable" class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>QR Code</th>
                            <th>Code</th>
                            <th>Coins</th>
                            <th>Used</th>
                            <th>Used By</th>
                            <th>Used At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($qrCodes as $index => $qr)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($qr->path && file_exists(public_path($qr->path)))
<img src="{{ asset($qr->path) }}" alt="QR" style="height: 80px;     border-radius: 0;">
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $qr->code }}</td>
                            <td>{{ $qr->coin_reward }}</td>
                            <td>
                                <span class="badge {{ $qr->is_used ? 'bg-danger' : 'bg-success' }}">
                                    {{ $qr->is_used ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td>{{ $qr->used_by ?? '-' }}</td>
                            <td>{{ $qr->used_at ? \Carbon\Carbon::parse($qr->used_at)->format('d M Y H:i') : '-' }}</td>
                            <td>
                                <button onclick="printQRCode('{{ $qr->code }}')" class="btn btn-sm btn-outline-primary">
                                    🖨 Print
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-warning text-center">No QR codes generated yet.</div>
    @endif
</div>
@endsection


    <script>

        function printQRCode(code) {
            const imageUrl = `/qr_codes/${code}.png`;
            const w = window.open('', '', 'width=400,height=400');
            w.document.write(`
                <html>
                <head>
                    <title>Print QR Code</title>
                    <style>
                        body {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            margin: 0;
                            background: white;
                        }
                        img {
                            width: 300px;
                            height: 300px;
                            object-fit: contain;
                            box-shadow: 0 0 10px rgba(0,0,0,0.1);
                        }
                    </style>
                </head>
                <body>
                    <img src="${imageUrl}" alt="QR Code">
                </body>
                </html>
            `);
            w.document.close();
            w.focus();
            setTimeout(() => {
                w.print();
                w.close();
            }, 500);
        }
    </script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("qrForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const productId = document.getElementById("product_id").value;
        const count = document.getElementById("count").value;
        const coin_rewards = document.getElementById("coin_rewards").value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'Generating QR Codes...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        fetch(`/qr/generate`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                "Accept": "application/json"
            },
            body: JSON.stringify({
                product_id: productId,
                count: count,
                coin_rewards: coin_rewards
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Something went wrong!',
                    });
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An unexpected error occurred.',
                });
            });
    });
});
</script>
