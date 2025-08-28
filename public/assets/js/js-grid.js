(function($) {
  'use strict';
  $(function() {

    //basic config
    if ($("#js-grid").length) {
  $("#js-grid").jsGrid({
    height: "500px",
    width: "100%",
    filtering: true,
    editing: true,
    inserting: true,
    sorting: true,
    paging: true,
    autoload: true,
    pageSize: 15,
    pageButtonCount: 5,
    deleteConfirm: "Do you really want to delete the client?",
    data: db.clients,
    fields: [
      {
        name: "id",
        type: "number",
        width: 50,
        editing: false, // ID should usually not be editable
        inserting: false
      },
      {
        name: "name",
        type: "text",
        title: "Name",
        width: 150
      },
      {
        name: "email",
        type: "text",
        title: "Email",
        width: 200
      },
      {
        name: "domain",
        type: "text",
        title: "Domain",
        width: 150
      },
      {
        name: "role",
        type: "text",
        title: "Role",
        width: 100
      },
     {
  name: "permissions",
  title: "Permissions",
  itemTemplate: function(values) {
    return Array.isArray(values) ? values.join(", ") : values;
  },
  insertTemplate: function() {
    this.insertControl = $("<select multiple>")
      .addClass("form-control")
      .css("height", "70px")
      .append('<option value="1">Read</option>')
      .append('<option value="2">Write</option>')
      .append('<option value="3">Delete</option>');
    return this.insertControl;
  },
  editTemplate: function(value) {
    this.editControl = $("<select multiple>")
      .addClass("form-control")
      .css("height", "70px")
      .append('<option value="1">Read</option>')
      .append('<option value="2">Write</option>')
      .append('<option value="3">Delete</option>');

    if (Array.isArray(value)) {
      this.editControl.val(value.map(String));
    }

    return this.editControl;
  },
  insertValue: function() {
    return this.insertControl.val().map(Number);
  },
  editValue: function() {
    return this.editControl.val().map(Number);
  },
  width: 120
}
,
      {
        name: "status",
        type: "select",
        title: "Status",
        items: [
          { Name: "Inactive", Id: 0 },
          { Name: "Active", Id: 1 }
        ],
        valueField: "Id",
        textField: "Name",
        width: 80
      },
      {
        type: "control"
      }
    ]
  });
}



    //Static
    if ($("#js-grid-static").length) {
      $("#js-grid-static").jsGrid({
        height: "500px",
        width: "100%",

        sorting: true,
        paging: true,

        data: db.clients,

        fields: [{
            name: "Name",
            type: "text",
            width: 150
          },
          {
            name: "Age",
            type: "number",
            width: 50
          },
          {
            name: "Address",
            type: "text",
            width: 200
          },
          {
            name: "Country",
            type: "select",
            items: db.countries,
            valueField: "Id",
            textField: "Name"
          },
          {
            name: "Married",
            title: "Is Married",
            itemTemplate: function(value, item) {
              return $("<div>")
                .addClass("form-check mt-0")
                .append(
                  $("<label>").addClass("form-check-label")
                  .append(
                    $("<input>").attr("type", "checkbox")
                    .addClass("form-check-input")
                    .attr("checked", value || item.Checked)
                    .on("change", function() {
                      item.Checked = $(this).is(":checked");
                    })
                  )
                  .append('<i class="input-helper"></i>')
                );
            }
          }
        ]
      });
    }

    //sortable
    if ($("#js-grid-sortable").length) {
      $("#js-grid-sortable").jsGrid({
        height: "500px",
        width: "100%",

        autoload: true,
        selecting: false,

        controller: db,

        fields: [{
            name: "Name",
            type: "text",
            width: 150
          },
          {
            name: "Age",
            type: "number",
            width: 50
          },
          {
            name: "Address",
            type: "text",
            width: 200
          },
          {
            name: "Country",
            type: "select",
            items: db.countries,
            valueField: "Id",
            textField: "Name"
          },
          {
            name: "Married",
            title: "Is Married",
            itemTemplate: function(value, item) {
              return $("<div>")
                .addClass("form-check mt-0")
                .append(
                  $("<label>").addClass("form-check-label")
                  .append(
                    $("<input>").attr("type", "checkbox")
                    .addClass("form-check-input")
                    .attr("checked", value || item.Checked)
                    .on("change", function() {
                      item.Checked = $(this).is(":checked");
                    })
                  )
                  .append('<i class="input-helper"></i>')
                );
            }
          }
        ]
      });
    }

    if ($("#sort").length) {
      $("#sort").on("click", function() {
        var field = $("#sortingField").val();
        $("#js-grid-sortable").jsGrid("sort", field);
      });
    }

  });
})(jQuery);
