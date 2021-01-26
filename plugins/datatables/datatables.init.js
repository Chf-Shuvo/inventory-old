$(document).ready(function() {
    $(".dtable").DataTable({
        lengthChange: true,
        buttons: ["copy", "excel", "pdf", "csv","print","colvis"],
        "columnDefs": [
            { "orderable": true, "targets":  "_all" }
          ],
          "ordering": false
         //"order":[[ 0, "desc" ]]
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
});