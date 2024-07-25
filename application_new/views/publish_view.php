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
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <?php if ($this->session->flashdata('status')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('status'); ?>
                        </div>
                    <?php endif; ?>
                    <h3>
                        Published Forms
                    </h3>
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
                            <?php $serialNumber = 1;foreach ($forms as $row): ?>
                                <tr>
                                <td><?php echo $serialNumber++; ?></td> 
                                <td class="title-column">
                                        <?php echo $row->title; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo $row->response_link; ?>" target="_blank"><?php echo $row->response_link; ?></a>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('Publish_controller/unpublish_form/' . $row->id); ?>" class="btn btn-danger btn-sm" style=" background-color: rgb(103, 58, 183); border-color: rgb(103, 58, 183); color: white;">Unpublish</a>
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
