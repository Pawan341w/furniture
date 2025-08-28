@extends('user.layout.app')

@section('title', 'Edit Address')

@section('content')
<div class="container">
    <!--<div class="row justify-content-center">-->
        <!--<div class="col-md-8">-->
            <h2 class="mb-4">Edit Address</h2>

            {{-- Display validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Edit Address Form --}}
            <form action="{{ route('address.update', $address->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
<label>Street Address</label>
                    <input type="text" name="address_line1" id="address_line1" class="form-control" value="{{ old('address_line1', $address->address_line1) }}" required>
                </div>

                <div class="form-group mb-3">
            <label>Apartment, Suite, Unit, etc. (optional)</label>
                    <input type="text" name="address_line2" id="address_line2" class="form-control" value="{{ old('address_line2', $address->address_line2) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="landmark">Landmark</label>
                    <input type="text" name="landmark" id="landmark" class="form-control" value="{{ old('landmark', $address->landmark) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="city">City <span class="text-danger">*</span></label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $address->city) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="state">State <span class="text-danger">*</span></label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $address->state) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="country">Country <span class="text-danger">*</span></label>
                    <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $address->country) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="pincode">Pincode <span class="text-danger">*</span></label>
                    <input type="text" name="pincode" id="pincode" class="form-control" value="{{ old('pincode', $address->pincode) }}" required>
                </div>

                <div class="form-group mb-4">
                    <label for="address_type">Address Type <span class="text-danger">*</span></label>
                    <select name="address_type" id="address_type" class="form-control" required>
                        <option value="Home" {{ old('address_type', $address->address_type) == 'Home' ? 'selected' : '' }}>Home</option>
                        <option value="Work" {{ old('address_type', $address->address_type) == 'Work' ? 'selected' : '' }}>Work</option>
                        <option value="Other" {{ old('address_type', $address->address_type) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Address</button>
                <a href="{{ route('address.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
    <!--    </div>-->
    <!--</div>-->
</div>
@endsection
