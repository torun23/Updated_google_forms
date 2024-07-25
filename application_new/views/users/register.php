<?php echo validation_errors(); ?>
<?php echo form_open('users/register'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1 class="text-center"><?= $title; ?></h1>

        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username">
            <p id="username-error" class="error-message"></p> <!-- Placeholder for validation message -->
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" placeholder="Email">
            <p id="email-error" class="error-message"></p> <!-- Placeholder for validation message -->
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <p id="password-error" class="error-message"></p> <!-- Placeholder for validation message -->
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
            <p id="password2-error" class="error-message"></p> <!-- Placeholder for validation message -->
        </div>

        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
</div>
<?php echo form_close(); ?>
