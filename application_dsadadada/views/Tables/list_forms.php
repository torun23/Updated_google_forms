<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Other head elements -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <link rel="stylesheet" href="styles.css">  -->
    <style>
        /* CSS styles */
        .title-column {
            color: darkblue;
            /* Dark blue color for title */
        }

        .draft-row {
            background-color: #f0f0f0;
            /* Light grey background for draft status */
        }

        .card-stats {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-stats:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            color: rgb(103, 58, 183); /* Match the color theme */
            margin-bottom: 10px;
            font-size: 20px; /* Increase the font size of the title */
            font-weight: bold; /* Make the title bold */
        }

        .card-text {
            font-size: 28px; /* Increase the font size */
            font-weight: bold; /* Make the text bold */
        }

        .card-text.green {
            color: #28a745;
        }

        .card-text.red {
            color: #dc3545;
        }

        .card-text.blue {
            color: #007bff;
        }

        .card-text.yellow {
            color: #ffc107;
        }

        .card-text.purple {
            color: #6f42c1;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <h5 class="card-title">Total Forms Created</h5>
                        <p class="card-text" id="total-forms"><?php echo $total_forms; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <h5 class="card-title">Published Forms</h5>
                        <p class="card-text" id="published-forms"><?php echo $published_forms; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <h5 class="card-title">Responses Submitted</h5>
                        <p class="card-text" id="total-responses"><?php echo $total_responses; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your existing table code here -->
        <div class="row">
            <div class="col-md-12 mt-4 ">
                <div class="card">
                    <div class="card-header">
                        <?php if ($this->session->flashdata('status')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('status'); ?>
                            </div>
                        <?php endif; ?>
                        <h3>List of Forms</h3>
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
                                    <th>Responses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $serialNumber = 1; // Initialize the counter variable
                                foreach ($forms as $row): ?>
                                    <tr class="<?php echo ($row->is_published ? '' : 'draft-row'); ?>">
                                        <td><?php echo $serialNumber++; ?></td>
                                        <td class="title-column">
                                            <a href="<?php echo base_url('publish/' . $row->id); ?>"><?php echo $row->title; ?></a>
                                        </td>
                                        <td><?php echo $row->description; ?></td>
                                        <td><?php echo $row->created_at; ?></td>
                                        <td style="color: <?php echo ($row->is_published ? '#006400' : 'red'); ?>;">
                                            <?php echo ($row->is_published ? 'Published' : 'Draft'); ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('responses/' . $row->id); ?>">
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
