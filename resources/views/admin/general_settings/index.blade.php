@extends('admin.layout.app')
@section('title','General Settings')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row grid-margin">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title d-flex justify-content-between">
          General Settings
          <button class="btn btn-primary btn-sm" id="openAddModal">+ Add Setting</button>
        </h4>

        <table class="table table-bordered" id="settingTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Key</th>
              <th>Type</th>
              <th>Value</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addSettingModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="addSettingForm" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Setting</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Key</label>
            <input type="text" class="form-control" name="key" required />
          </div>
          <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type" id="addTypeSelector" required>
              <option value="text">Text</option>
              <option value="image">Image</option>
              <option value="array">Array</option>
            </select>
          </div>
          <div class="form-group" id="addValueWrapper"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editSettingModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editSettingForm" enctype="multipart/form-data">
      <input type="hidden" name="id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Setting</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Key</label>
            <input type="text" class="form-control" name="key" required />
          </div>
          <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type" id="editTypeSelector" required>
              <option value="text">Text</option>
              <option value="image">Image</option>
              <option value="array">Array</option>
            </select>
          </div>
          <div class="form-group" id="editValueWrapper"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });

  function getInputField(type, name, value = '') {
    if (type === 'image') {
      return `<label>Value</label><input type="file" class="form-control" name="${name}" accept="image/*" required />`;
    } else if (type === 'array') {
      return `<label>Value (comma separated)</label><textarea class="form-control" name="${name}" required>${value}</textarea>`;
    } else {
      return `<label>Value</label><input type="text" class="form-control" name="${name}" value="${value}" required />`;
    }
  }

  function loadSettings() {
    $.get("/admin/general-settings", function (res) {
      let html = '';
      res.settings.forEach((item, index) => {
        html += `
          <tr>
            <td>${index + 1}</td>
            <td>${item.key}</td>
            <td>${item.type}</td>
            <td>${item.type === 'image' ? `<img src="${item.value}" width="50" />` : item.value}</td>
            <td>
              <button class="btn btn-warning btn-sm" onclick="editSetting(${item.id})">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="deleteSetting(${item.id})">Delete</button>
            </td>
          </tr>`;
      });
      $('#settingTable tbody').html(html);
    });
  }

  loadSettings();

  $('#openAddModal').on('click', () => {
    $('#addSettingForm')[0].reset();
    $('#addValueWrapper').html(getInputField('text', 'value'));
    $('#addSettingModal').modal('show');
  });

  $('#addTypeSelector').on('change', function () {
    const type = $(this).val();
    $('#addValueWrapper').html(getInputField(type, 'value'));
  });

  $('#editTypeSelector').on('change', function () {
    const type = $(this).val();
    $('#editValueWrapper').html(getInputField(type, 'value'));
  });

  $('#addSettingForm').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
      url: '/admin/general-settings',
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (res) {
        Swal.fire('Saved', res.message, 'success');
        $('#addSettingModal').modal('hide');
        loadSettings();
      },
      error: function (err) {
        Swal.fire('Error', err.responseJSON.message || 'Something went wrong.', 'error');
      }
    });
  });

  function editSetting(id) {
    $.get(`/general-settings/${id}`, function (res) {
      $('#editSettingForm input[name=id]').val(res.id);
      $('#editSettingForm input[name=key]').val(res.key);
      $('#editTypeSelector').val(res.type);
      $('#editValueWrapper').html(getInputField(res.type, 'value', res.value));
      $('#editSettingModal').modal('show');
    });
  }

  $('#editSettingForm').submit(function (e) {
    e.preventDefault();
    let id = $('#editSettingForm input[name=id]').val();
    let formData = new FormData(this);
    $.ajax({
      url: `/general-settings/${id}`,
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (res) {
        Swal.fire('Updated', res.message, 'success');
        $('#editSettingModal').modal('hide');
        loadSettings();
      },
      error: function (err) {
        Swal.fire('Error', err.responseJSON.message || 'Something went wrong.', 'error');
      }
    });
  });

  function deleteSetting(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "Delete this setting?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!'
    }).then(result => {
      if (result.isConfirmed) {
        $.ajax({
          url: `/general-settings/${id}`,
          type: 'DELETE',
          success: res => {
            Swal.fire('Deleted!', res.message, 'success');
            loadSettings();
          },
          error: () => {
            Swal.fire('Error', 'Delete failed.', 'error');
          }
        });
      }
    });
  }
</script>
@endsection
