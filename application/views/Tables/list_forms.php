<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Other head elements -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your stylesheet -->
</head>
<body>
    <style>/* CSS styles */
.title-column {
    color: darkblue; /* Dark blue color for title */
}

.draft-row {
    background-color: #f0f0f0; /* Light grey background for draft status */
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4 ">
            <div class="card">
                <div class="card-header">
                    <?php if ($this->session->flashdata('status')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('status'); ?>
                        </div>
                    <?php endif; ?>
                    <h3>
                        List of Forms
                    </h3>
                </div>
                <div class="card-body">
                    <!-- here your table will occur -->
                    <table id="basetable1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Forms</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created On</th>
                                <th>Status</th>
                                <th>Preview</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $serialNumber = 1; // Initialize the counter variable
                            foreach ($forms as $row): ?>
                                <tr class="<?php echo ($row->is_published ? '' : 'draft-row'); ?>">
                                    <td><?php echo $serialNumber++; ?></td> 
                                    <td class="title-column">
                                        <?php echo $row->title; ?>
                                    </td>
                                    <td><?php echo $row->description; ?></td>
                                    <td><?php echo $row->created_at; ?></td>
                                    <td><?php echo ($row->is_published ? 'Published' : 'Draft'); ?></td>
                                    <td>
                                        <a href="<?php echo base_url('publish/' . $row->id); ?>">
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
    function updateSerialNumbers() {
        const table = document.getElementById('basetable1');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            rows[i].getElementsByClassName('serial-number')[0].innerText = i + 1;
        }
    }

    document.addEventListener('DOMContentLoaded', updateSerialNumbers);
    // If you have sorting functionality, call updateSerialNumbers after sorting
</script>
</body>
</html>
