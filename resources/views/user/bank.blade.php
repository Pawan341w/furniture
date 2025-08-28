@extends('user.layout.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Bank Account</h2>

    @if($bank)
       <div class="card p-3 mb-4 shadow-sm">
    <div class="row text-center">
        <div class="col">
            <strong>Account Holder:</strong>
            <div>{{ $bank->account_holder_name }}</div>
        </div>
        <div class="col">
            <strong>Bank Name:</strong>
            <div>{{ $bank->bank_name }}</div>
        </div>
        <div class="col">
            <strong>Account Number:</strong>
            <div>{{ $bank->account_number }}</div>
        </div>
        <div class="col">
            <strong>IFSC Code:</strong>
            <div>{{ $bank->ifsc_code }}</div>
        </div>
        <div class="col">
            <strong>UPI Id:</strong>
            <div>{{ $bank->upi }}</div>
        </div>
    </div>

    <div class="mt-3 text-end">
        <button class="btn btn-warning btn-sm" id="edit-btn">Edit</button>
        <form method="POST" action="{{ route('bank.details.delete') }}" class="d-inline" onsubmit="return confirmDelete();">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>
</div>

    @else
        <div class="alert alert-info">No bank account added yet.</div>
    @endif

    <!-- Edit/Add Bank Form -->
    <div id="edit-form" class="card p-4 shadow-sm" style="display: {{ $bank ? 'none' : 'block' }};">
        <form id="bankEditForm">
            @csrf
            <div class="mb-3">
                <label class="form-label">Account Holder Name</label>
                <input type="text" name="account_holder_name" class="form-control" value="{{ $bank->account_holder_name ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Bank Name</label>
                <input type="text" name="bank_name" class="form-control" value="{{ $bank->bank_name ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Account Number</label>
                <input type="text" name="account_number" class="form-control" value="{{ $bank->account_number ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">IFSC Code</label>
                <input type="text" name="ifsc_code" class="form-control" value="{{ $bank->ifsc_code ?? '' }}" required>
            </div>
              <div class="mb-3">
                <label class="form-label">Upi Id</label>
                <input type="text" name="upi" class="form-control" value="{{ $bank->upi ?? '' }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Save Bank Details</button>
                <button type="button" class="btn btn-secondary" id="cancel-edit">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire('Success', '{{ session('success') }}', 'success');
</script>
@endif

<script>
    document.getElementById('edit-btn')?.addEventListener('click', () => {
        document.getElementById('edit-form').style.display = 'block';
    });

    document.getElementById('cancel-edit')?.addEventListener('click', () => {
        document.getElementById('edit-form').style.display = 'none';
    });

    document.getElementById('bankEditForm')?.addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch("{{ route('bank.details.update.ajax') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        }).then(res => res.json())
          .then(data => {
              if (data.success) {
                  Swal.fire('Success', data.message, 'success').then(() => {
                      location.reload();
                  });
              } else {
                  Swal.fire('Error', data.message, 'error');
              }
          }).catch(() => {
              Swal.fire('Error', 'Could not update bank details.', 'error');
          });
    });

    function confirmDelete() {
        return confirm('Are you sure you want to delete this account?');
    }
</script>
@endsection
