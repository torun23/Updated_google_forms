<?php echo form_open('new_form/create_form'); ?>
<div class="row">
<div class="col-md-4 col-md-offset-4">
<h1 class="text-center">
    <?php echo('Form Details'); ?>
</h1>
<div class="form-group">

<input type = "text" name ="title" class="form-control" placeholder = "Title" required autofocus>
</div>
<div class="form-group">
<input type = "text" name ="description" class="form-control" placeholder = "Form Description" required autofocus>

</div>
<button type = "submit" class = "btn btn-primary btn-block">Create</button>
</div>
</div>
        
<?php echo form_close(); ?>
