@extends('admin.layout.app')

@section('title', 'General Settings')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>General Settings</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSettingModal">+ Add Setting</button>
    </div>

    <table class="table table-bordered" id="general_settings_table">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Key</th>
                <th>Type</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($settings as $index => $setting)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $setting->key }}</td>
                    <td>{{ $setting->type }}</td>
                    <td>
                        @if($setting->type === 'image')
                            <img src="{{ $setting->value }}" width="60">
                        @elseif($setting->type === 'array')
                            {{ implode(', ', json_decode($setting->value, true) ?? []) }}
                        @else
                            {{ $setting->value }}
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info editBtn" data-id="{{ $setting->id }}">Edit</button>
                        <!--<button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $setting->id }}">Delete</button>-->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="createSettingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5>Add Setting</h5></div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Key</label>
                        <input type="text" name="key" class="form-control"  required>
                    </div>
                    <div class="mb-2">
                        <label>Type</label>
                        <select name="type" id="typeSelector" class="form-control" required>
                            <option value="text">Text</option>
                            <option value="image">Image</option>
                            <option value="array">Array</option>
                        </select>
                    </div>
                    <div class="mb-2" id="valueField"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSettingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header"><h5>Edit Setting</h5></div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Key</label>
<input type="text" name="key" class="form-control-plaintext" readonly value="{{ $setting->key ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label>Type</label>
                        <select name="type" class="form-control typeSelectorEdit" required>
                            <option value="text">Text</option>
                            <option value="image">Image</option>
                            <option value="array">Array</option>
                        </select>
                    </div>
                    <div class="mb-2" id="editValueField"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function renderField(form, type, value = '') {
        let html = '';
        let note = '';

        if (type === 'text') {
            html = `<input type="text" name="value" class="form-control" value="${value || ''}" required>`;
            note = `<small class="text-muted">Enter plain text value.</small>`;
        } else if (type === 'image') {
            html = `<input type="file" name="value" class="form-control" ${form.id === 'addForm' ? 'required' : ''}>`;
            note = `<small class="text-muted">Upload an image (e.g., logo or banner).</small>`;
        } else if (type === 'array') {
            const arrVal = Array.isArray(value) ? value.join(', ') : (value || '');
            html = `<input type="text" name="value" class="form-control" value="${arrVal}" required>`;
            note = `<small class="text-muted">Enter comma-separated values (e.g., item1, item2).</small>`;
        }

        const finalHTML = html + '<br>' + note;

        if (form.id === 'addForm') {
            $('#valueField').html(finalHTML);
        } else {
            $('#editValueField').html(finalHTML);
        }
    }

    $('#typeSelector').on('change', function () {
        renderField(document.getElementById('addForm'), this.value);
    });

    $(document).on('change', '.typeSelectorEdit', function () {
        renderField(document.getElementById('editForm'), this.value);
    });

    $('#addForm').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            url: '/general-settings',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: res => {
                Swal.fire('Success', res.message, 'success').then(() => location.reload());
            }
        });
    });

    $(document).on('click', '.editBtn', function () {
        const id = $(this).data('id');
        $.get(`/general-settings/${id}`, function (data) {
            const form = document.getElementById('editForm');
            $(form).find('[name="id"]').val(data.id);
            $(form).find('[name="key"]').val(data.key);

            const $type = $(form).find('[name="type"]');
            $type.val(data.type).trigger('change');

            const parsedValue = data.type === 'array' ? JSON.parse(data.value) : data.value;
            renderField(form, data.type, parsedValue);

            $('#editSettingModal').modal('show');
        });
    });

    $('#editForm').on('submit', function (e) {
        e.preventDefault();
        const id = $(this).find('[name="id"]').val();
        const formData = new FormData(this);
        $.ajax({
            url: `/general-settings/${id}`,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: res => {
                Swal.fire('Updated', res.message, 'success').then(() => location.reload());
            }
        });
    });

    $(document).on('click', '.deleteBtn', function () {
        const id = $(this).data('id');
        const token = $('meta[name="csrf-token"]').attr('content');
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will delete the setting permanently!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/general-settings/${id}`,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': token },
                    success: res => {
                        Swal.fire('Deleted!', res.message, 'success').then(() => location.reload());
                    }
                });
            }
        });
    });

    $(document).ready(() => {
        renderField(document.getElementById('addForm'), $('#typeSelector').val());
    });
</script>
@endsection
