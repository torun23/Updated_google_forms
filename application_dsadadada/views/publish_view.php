<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <?php if ($this->session->flashdata('status')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('status'); ?>
                        </div>
                    <?php endif; ?>
                    <h3>Published Forms</h3>
                </div>
                <div class="card-body">
                    <!-- here your table will occur -->
                    <table id="basetable1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Responses</th>
                                <th>Title</th>
                                <th>Response Link</th>
                                <th>Status</th>
                                <th>Preview</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $serialNumber = 1;
                            foreach ($forms as $row): ?>
                                <tr>
                                    <td><?php echo $serialNumber++; ?></td>
                                    <td class="title-column"><?php echo $row->title; ?></td>
                                    <td>
                                        <a href="<?php echo $row->response_link; ?>" target="_blank"><?php echo $row->response_link; ?></a>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-switch" data-form-id="<?php echo $row->id; ?>" <?php echo $row->is_responsive ? 'checked' : ''; ?>>
                                            <span class="slider round"></span>
                                            <span class="tooltip"><?php echo $row->is_responsive ? 'Active' : 'Inactive'; ?></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('form_preview/' . $row->id); ?>">
                                            <i class="fas fa-eye"></i> <!-- Eye icon -->
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#basetable1').DataTable({
            "pagingType": "full_numbers", // Full pagination controls
            "lengthMenu": [10, 25, 50], // Options for number of rows per page
            "language": {
                "search": "Filter records:", // Custom search label
                "lengthMenu": "Show _MENU_ entries" // Custom length menu label
            },
            "columnDefs": [
                { "orderable": false, "targets": 4 } // Disable sorting for the "View" column (index 4)
            ],
            "order": [[0, "asc"]] // Default sort by "Title" column (index 1) in descending order
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-switch').forEach(function(switchElement) {
        switchElement.addEventListener('change', function() {
            var formId = this.getAttribute('data-form-id');
            var isResponsive = this.checked ? 1 : 0;

            fetch(`<?php echo base_url('Publish_controller/toggle_responsive/'); ?>${formId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `is_responsive=${isResponsive}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Optionally, handle success
                } else {
                    // Optionally, handle failure
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>