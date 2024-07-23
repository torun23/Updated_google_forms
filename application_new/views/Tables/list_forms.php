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
                    <table id = "basetable1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Form_Id</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created On</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($forms as $row): ?>
                                <tr>
                                    <td><?php echo $row->id; ?></td>
                                    <td><a
                                            href="<?php echo base_url('publish/' . $row->id); ?>"><?php echo $row->title; ?></a>
                                    </td>
                                    <td><?php echo $row->description; ?></td>
                                    <td><?php echo $row->created_at; ?></td>
                                    <td>
                                        <?php echo ($row->is_published ? 'Published' : 'Draft'); ?>
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
