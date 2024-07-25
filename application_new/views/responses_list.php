<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses List</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
</head>
<body>
    <style>
        .username-column {
    color: darkblue; /* Dark blue color for title */
}
    </style>
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
                    <h3>
                        Responses for "<?php echo $form->title; ?>"
                    </h3>
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
</body>
</html>
