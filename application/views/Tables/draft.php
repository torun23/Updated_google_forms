<style>/* CSS styles */
.title-column {
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
Drafts
                    </h3>
                </div>
                <div class="card-body">
                    <!-- here your table will occur -->
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
                <td class="title-column">
                                        <?php echo $row->title; ?>
                                    </td>
                                    
                                    <td><?php echo $row->created_at; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('edit/' . $row->id); ?>"
                                            class="btn btn-success btn-sm " style=" background-color: rgb(103, 58, 183); border-color: rgb(103, 58, 183); color: white;">Edit</a>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('forms/delete/' . $row->id); ?>"
                                            class="btn btn-danger btn-sm" style=" background-color: rgb(103, 58, 183); border-color: rgb(103, 58, 183); color: white;">Delete</a>
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