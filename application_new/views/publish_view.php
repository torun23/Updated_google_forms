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
                                <th>Form_Id</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Response Link</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($forms as $row): ?>
                                <tr>
                                    <td><a href="<?php echo base_url('Response_submit/view/' . $row->id); ?>"><?php echo $row->id; ?></a></td>
                                    <td>
                                        <a href="<?php echo base_url('form_preview/' . $row->id); ?>"><?php echo $row->title; ?></a>
                                    </td>
                                    <td><?php echo $row->description; ?></td>
                                    <td>
                                        <a href="<?php echo $row->response_link; ?>" target="_blank"><?php echo $row->response_link; ?></a>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('Publish_controller/unpublish_form/' . $row->id); ?>" class="btn btn-danger btn-sm" style=" background-color: rgb(103, 58, 183); border-color: rgb(103, 58, 183); color: white;">Unpublish</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
