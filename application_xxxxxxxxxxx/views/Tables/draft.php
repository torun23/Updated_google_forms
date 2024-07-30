<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Other head elements -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/header_styles.css">

    <style>
        .title-column {
            color: darkblue; /* Dark blue color for title */
        }
    </style>
</head>
<body>
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
                        <h3>Drafts</h3>
                    </div>
                    <div class="card-body">
                        <table id="basetable1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Drafts</th>
                                    <th>Title</th>
                                    <th>Created On</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Preview</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $serialNumber = 1; // Initialize the counter variable
                                foreach ($forms as $row): ?>
                                    <tr>
                                        <td><?php echo $serialNumber++; ?></td>
                                        <td class="title-column"><?php echo $row->title; ?></td>
                                        <td><?php echo date('Y-m-d H:i:s', strtotime($row->created_at)); ?></td> <!-- Ensure date is in a sortable format -->
                                        <td>
                                            <a href="<?php echo base_url('edit/' . $row->id); ?>" class="btn btn-success btn-sm" style="background-color: rgb(103, 58, 183); border-color: rgb(103, 58, 183); color: white;">Edit</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('forms/delete/' . $row->id); ?>" class="btn btn-danger btn-sm" style="background-color: rgb(103, 58, 183); border-color: rgb(103, 58, 183); color: white;">Delete</a>
                                        </td>
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
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('basetable1');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort((rowA, rowB) => {
                const dateTextA = rowA.cells[2].textContent.trim();
                const dateTextB = rowB.cells[2].textContent.trim();

                const dateA = new Date(dateTextA);
                const dateB = new Date(dateTextB);

                if (isNaN(dateA.getTime())) {
                    return 1;
                }
                if (isNaN(dateB.getTime())) {
                    return -1;
                }

                return dateB - dateA;
            });

            rows.forEach(row => tbody.appendChild(row));
        });
    </script>

