(function ($) {

//   const permissionMap = {
//     0: 'Dashboard',
//     1: "Admins",
//     2: "Users",
//     3: "Settings",
//     4: "Api"
//   };

//   const permissionOptions = Object.keys(permissionMap).map(key => ({
//     id: key,
//     name: permissionMap[key]
//   }));
let permissionOptions = [];
let permissionMap = {};
  function loadPermissions() {
  return fetch('/api/services')
    .then(response => response.json())
    .then(data => {
      permissionOptions = data;
      permissionMap = Object.fromEntries(data.map(p => [p.id, p.name]));
    });
}
  function createPermissionField() {
    return {
      name: "permissions",
      title: "Permissions",
      width: 200,

      itemTemplate(value) {
        let ids = Array.isArray(value) ? value : JSON.parse(value || "[]");
        return ids.map(id => permissionMap[id]).join(", ");
      },

      insertTemplate() {
        this._selectedPermissions = new Set();
        this._insertContainer = createTagUI(this._selectedPermissions);
        return this._insertContainer.wrapper;
      },

      editTemplate(value) {
        const initial = Array.isArray(value) ? value.map(String) : JSON.parse(value || "[]");
        this._selectedPermissions = new Set(initial);
        this._editContainer = createTagUI(this._selectedPermissions);
        return this._editContainer.wrapper;
      },

      insertValue() {
        return Array.from(this._selectedPermissions).map(Number);
      },

      editValue() {
        return Array.from(this._selectedPermissions).map(Number);
      }
    };
  }

  function createTagUI(setRef) {
    const wrapper = document.createElement("div");
    wrapper.style.minHeight = "40px";

    const select = document.createElement("select");
    select.className = "form-control";
    select.style.marginBottom = "8px";

    const defaultOption = document.createElement("option");
    defaultOption.text = "Select Permission";
    defaultOption.value = "";
    select.appendChild(defaultOption);

    permissionOptions.forEach(opt => {
      const option = document.createElement("option");
      option.value = opt.id;
      option.text = opt.name;
      select.appendChild(option);
    });

    const tagContainer = document.createElement("div");
    tagContainer.className = "tag-container";

    select.onchange = function () {
      const val = this.value;
      if (val && !setRef.has(val)) {
        setRef.add(val);
        renderTags(tagContainer, setRef);
      }
      this.selectedIndex = 0;
    };

    renderTags(tagContainer, setRef);
    wrapper.appendChild(select);
    wrapper.appendChild(tagContainer);

    return { wrapper };
  }

  function renderTags(container, setRef) {
    container.innerHTML = "";
    setRef.forEach(value => {
      const tag = document.createElement("span");
      tag.className = "badge badge-primary m-1";
      tag.style.padding = "6px 10px";

      const span = document.createElement("span");
      span.innerHTML = permissionMap[value];

      const close = document.createElement("span");
      close.innerHTML = "&times;";
      close.style.cursor = "pointer";
      close.style.marginLeft = "5px";

      close.onclick = () => {
        setRef.delete(value);
        renderTags(container, setRef);
      };

      tag.appendChild(span);
      tag.appendChild(close);
      container.appendChild(tag);
    });
  }

  const routes = {
    getClients: 'users/data',
    addClient: 'users/add-client',
    updateClient: 'users/update-client',
    deleteClient: 'users/delete-client'
  };

  const db = {
    clients: [],

    loadData(filter) {
      return $.grep(this.clients, client => {
        return (!filter.name || client.name.toLowerCase().includes(filter.name.toLowerCase())) &&
          (!filter.email || client.email.toLowerCase().includes(filter.email.toLowerCase())) &&
          (!filter.domain || client.domain.toLowerCase().includes(filter.domain.toLowerCase())) &&
          (!filter.role || client.role === filter.role) &&
          (filter.status === '' || client.status == filter.status);
      });
    },

    insertItem(item) {
      item.parent_id = 1;
      item.permissions = item.permissions || [1];

      const formData = new FormData();
      const planData={};
      for (const key in item) {
        if (key === "photo" && item.photo instanceof File) {
          formData.append("photo", item.photo);
        } else {
            planData[key]=item[key];
          //formData.append(key, item[key]);
        }
      }

      const encryptedPayload=encryptDataJS(JSON.stringify(planData));
      formData.append('payload',encryptedPayload);
      return $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: routes.addClient,
        data: formData,
        processData: false,
        contentType: false
      }).then((data) => {
        db.clients.push(decryptDataJS(data.data));
        Swal.fire("Success", "Client added successfully!", "success");
        return decryptDataJS(data.data);
      }).catch(xhr => {
        Swal.fire("Error", xhr.responseJSON?.message || "Insert failed", "error");
        return $.Deferred().reject();
      });
    },

    updateItem(item) {
      const formData = new FormData();
      const planData={};
      for (const key in item) {
        if (key === "photo" && item.photo instanceof File) {
          formData.append("photo", item.photo);
        } else {
            planData[key]=item[key];
          //formData.append(key, item[key]);
        }
      }
const encryptedPayload=encryptDataJS(JSON.stringify(planData));
formData.append('payload',encryptedPayload);

      formData.append('_method', 'PUT');

      return $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: routes.updateClient,
        data: formData,
        processData: false,
        contentType: false
      }).then((data) => {
        const index = db.clients.findIndex(c => c.id == data.data.id);
        if (index !== -1) db.clients[index] = data.data;
        Swal.fire("Updated", "Client updated successfully!", "success");
        return decryptDataJS(data.data);
      }).catch(xhr => {
        Swal.fire("Error", xhr.responseJSON?.message || "Update failed", "error");
        return $.Deferred().reject();
      });
    },

    deleteItem(item) {
        var id =encryptDataJS(JSON.stringify(item.id));
      return $.ajax({
        type: "DELETE",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            id:id
        },
        url: routes.deleteClient
      }).then(() => {
        Swal.fire("Deleted", "Client deleted successfully!", "success");
      }).catch(xhr => {
        Swal.fire("Error", xhr.responseJSON?.message || "Delete failed", "error");
        return $.Deferred().reject();
      });
    }
  };

  window.db = db;


  Promise.all([
    loadPermissions(),
    $.get(routes.getClients)
  ]).then(([_, data]) => {
    db.clients = decryptDataJS(data);

    $("#js-user").jsGrid({
      height: "auto",
      width: "100%",
      filtering: true,
      autosearch: true,
      editing: true,
      inserting: true,
      sorting: true,
      paging: true,
      autoload: true,
      pageSize: 15,
      pageButtonCount: 5,
      deleteConfirm: "Do you really want to delete this client?",
      controller: db,

      onItemDeleting: function (args) {
        args.cancel = true;
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            db.deleteItem(args.item).done(() => {
              const index = db.clients.indexOf(args.item);
              if (index > -1) db.clients.splice(index, 1);
              $("#js-user").jsGrid("loadData");
            });
          }
        });
      },

      fields: [
        {
          title: "S. No",
          width: 50,
          align: "center",
          sorting: false,
          filtering: false,
          editing: false,
          inserting: false,
          itemTemplate: function (_, item) {
            const grid = $("#js-user").data("JSGrid");
            const items = grid.data;
            const index = items.findIndex(i => i.id === item.id);
            return index + 1;
          }
        },
        { name: "name", type: "text", width: 200 },
        { name: "email", type: "text", width: 200 },
        {
          name: "photo",
          title: "Photo",
          width: 100,
          align: "center",
          itemTemplate: value => value ? $("<img>").attr("src", value).css({ width: "40px", height: "40px", objectFit: "cover", borderRadius: "4px" }) : "",
          insertTemplate: function () {
            this._insertFileInput = $("<input type='file' class='form-control-file'>");
            return this._insertFileInput;
          },
          editTemplate: function (value) {
            this._editFileInput = $("<input type='file' class='form-control-file'>");
            this._currentLogo = value;
            return $("<div>").append($("<img>").attr("src", value).css({ width: "40px", marginBottom: "5px" }), this._editFileInput);
          },
          insertValue: function () {
            return this._insertFileInput[0].files[0] || null;
          },
          editValue: function () {
            return this._editFileInput[0].files[0] || this._currentLogo;
          }
        },
        {
          name: "password",
          title: "Password",
          width: 200,
          insertTemplate: function () {
            const wrapper = $("<div>").css({ position: "relative" });
            this._insertInput = $("<input type='text' class='form-control'>").css({ paddingRight: "30px" });
            const icon = $("<i class='fa fa-magic'>").css({ position: "absolute", right: "10px", top: "50%", transform: "translateY(-50%)", cursor: "pointer", color: "#007bff" }).attr("title", "Generate Password").on("click", () => {
              const pwd = Math.random().toString(36).slice(-8);
              this._insertInput.val(pwd);
            });
            wrapper.append(this._insertInput, icon);
            return wrapper;
          },
          editTemplate: function (value) {
            const wrapper = $("<div>").css({ position: "relative" });
            this._editInput = $("<input type='text' class='form-control'>").val(value).css({ paddingRight: "30px" });
            const icon = $("<i class='fa fa-magic'>").css({ position: "absolute", right: "10px", top: "50%", transform: "translateY(-50%)", cursor: "pointer", color: "#007bff" }).attr("title", "Generate Password").on("click", () => {
              const pwd = Math.random().toString(36).slice(-8);
              this._editInput.val(pwd);
            });
            wrapper.append(this._editInput, icon);
            return wrapper;
          },
          insertValue: function () {
            return this._insertInput.val();
          },
          editValue: function () {
            return this._editInput.val();
          },
          itemTemplate: function () {
            return "••••••••";
          }
        },
        {
          name: "role",
          type: "select",
          title: "Role",
          items: [{ Name: "User", Id: "user" }],
          valueField: "Id",
          textField: "Name",
          width: 100
        },
        createPermissionField(),
        {
          name: "status",
          title: "Status",
          width: 60,
          align: "center",
          itemTemplate: function (value) {
            const color = value == 1 ? "green" : "red";
            return $("<span>").css({
              display: "inline-block",
              width: "10px",
              height: "10px",
              borderRadius: "50%",
              backgroundColor: color
            });
          },
          filterTemplate: function () {
            this._filterSelect = $("<select class='form-control'>")
              .append("<option value=''>All</option>")
              .append("<option value='1'>Active</option>")
              .append("<option value='0'>Inactive</option>");
            return this._filterSelect;
          },
          filterValue: function () {
            return this._filterSelect.val();
          },
          insertTemplate: function () {
            this._insertSelect = $("<select class='form-control'>")
              .append("<option value='1'>Active</option>")
              .append("<option value='0'>Inactive</option>");
            return this._insertSelect;
          },
          insertValue: function () {
            return parseInt(this._insertSelect.val());
          },
          editTemplate: function (value) {
            this._editSelect = $("<select class='form-control'>")
              .append("<option value='1'>Active</option>")
              .append("<option value='0'>Inactive</option>")
              .val(value);
            return this._editSelect;
          },
          editValue: function () {
            return parseInt(this._editSelect.val());
          }
        },
        { type: "control" }
      ]
    });

    // ✅ LIVE FILTERING FIX HERE:
    $("#js-user .jsgrid-filter-row input, #js-user .jsgrid-filter-row select").on("input change", function () {
      $("#js-user").jsGrid("loadData");
    });
  });
})(jQuery);
