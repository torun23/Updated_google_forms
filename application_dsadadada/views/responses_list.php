<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Other head elements -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses for "<?php echo $form->title; ?>"</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .username-column {
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
                        <h3>Responses for "<?php echo $form->title; ?>"</h3>
                        <a href="<?php echo base_url('Response_submit/summary/' . $form->id); ?>" class="btn btn-primary">View Summary</a>
                    </div>
                    <div class="card-body">
                        <table id="basetable1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Submitted At</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($responses as $response): ?>
                                    <tr>
                                        <td class="username-column"><?php echo $response->username; ?></td>
                                        <td><?php echo $response->submitted_at; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('responses/view/' . $response->response_id); ?>">
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
                "pagingType": "full_numbers",
                "lengthMenu": [10, 25, 50],
                "language": {
                    "search": "Filter records:",
                    "lengthMenu": "Show _MENU_ entries"
                },
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ],
                "order": [[1, "desc"]]
            });
        });
    </script>
</body>
</html>
