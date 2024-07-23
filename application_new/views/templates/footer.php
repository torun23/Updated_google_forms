<!-- <script>
$(document).ready(function(){
    $('#basetable1').DataTable({
        // "pagingType": "full_numbers"
    });
});
</script> -->

<script>
    $('#basetable1').DataTable({
            "pagingType": "full_numbers", // Full pagination controls
            "lengthMenu": [10, 25, 50], // Options for number of rows per page
            "language": {
                "search": "Filter records:", // Custom search label
                "lengthMenu": "Show _MENU_ entries" // Custom length menu label
            },
            "columnDefs": [
                { "orderable": false, "targets": 2 } // Disable sorting for the "View" column (index 2)
            ],
            "order": [[1, "desc"]] // Default sort by "Filled At" column (index 1) in descending order
        });
</script>
