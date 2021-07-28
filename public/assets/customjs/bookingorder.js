$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // fetch data
    $('#dataList').DataTable({
        processing: true,
        serverSide: true,
        ajax: "bookingorder",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'merchant_business', name: 'merchant_infos.business_name' },
            { data: 'merchant_mobile', name: 'merchant_infos.mobile' },
            { data: 'pickup_address', name: 'merchant_infos.pickup_address' },
            { data: 'recipient_name', name: 'recipient_name' },
            { data: 'recipient_number', name: 'recipient_number' },
            { data: 'recipient_area_area_name', name: 'recipient_area_area_name' },
            { data: 'address', name: 'address' },
            { data: 'product_price', name: 'product_price' },
            { data: 'created_at', name: 'deliver_date' },

            { data: 'shipping_cost', name: 'shipping_cost' },
            { data: 'pickup_address', name: 'pickup_address' },
            { data: 'action', name: 'action' },
        ],
        order: [[0, 'desc']],
        responsive: false,
        sorting: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lfBrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Location List',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'csv',
                title: 'Location List',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                title: 'Location List',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'print',
                title: 'Location List',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'copy',
                title: 'Location List',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            }
        ],
        columnDefs: [
            {
                targets: [-2, -3, -6, -7],
                visible: false
            }

        ]
    });
});

$("#exportExcel").on("click", function() {
    $('.buttons-excel').click()
});
$("#exportPrint").on("click", function() {
    $('.buttons-print').click()
});
$("#exportCsv").on("click", function() {
    $('.buttons-csv').click()
});
$("#exportPdf").on("click", function() {
    $('.buttons-pdf').click()
});
$("#exportCopy").on("click", function() {
    $('.buttons-copy').click()
});

// add data
function addData(){
    $('#dataForm').trigger("reset");
    $('#dataModalTitle').html("Add Location");
    $('#dataModal').modal('show');
    $('#id').val('');
}

// edit data
function editData(id){
    $.ajax({
        type:"POST",
        url: "/inventory/edit-location",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#dataModalTitle').html("Edit Location");
            $('#dataModal').modal('show');
            $('#id').val(res.id);
            $('#location').val(res.location);
        }
    });
}
// update data
$('#dataForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "/inventory/update-location",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            if(data.created == 1){
                toastr.success("Location Created Successfully");
            }
            else {
                toastr.success("Location Updated Successfully");
            }
            $("#dataModal").modal('hide');
            var oTable = $('#dataList').dataTable();
            oTable.fnDraw(false);
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
        },
        error: function(data){
            toastr.error("Operation Failed");
        }
    });
});

// delete data
function deleteData(id){
    if (confirm("Delete Record?") == true) {
        var id = id;
        $.ajax({
            type:"POST",
            url: "/inventory/delete-location",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                toastr.success("Location Deleted Successfully");
                var oTable = $('#dataList').dataTable();
                oTable.fnDraw(false);
            },
            error: function (){
                toastr.error("Operation Failed");
            }
        });
    }
}

