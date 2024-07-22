<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Form Clone</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
    <style>
        .navbar-custom {
            background-color: rgb(103, 58, 183);
            color: white;
            border-radius: 0;
        }

        .navbar-custom .navbar-brand {
            color: white;
            font-size: 18px;
        }

        .navbar-custom .navbar-nav>li>a {
            color: white;
            font-size: 16px;
        }

        #submit-btn {
            margin-top: 20px;
            float: left;
            clear: both;
        }
        .container{
            margin-top: 10px;

        }
    </style>
</head>

<body>
<script>
                        var base_url = '<?php echo base_url(); ?>';
    </script>
    <nav class="navbar navbar-inverse navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>Form_controller/index_forms">Google Forms</a>
            </div>
            <div id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>users/logout">Logout</a>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-header">
            <button id="preview-btn" class="btn btn-info"><i class="fas fa-eye"></i></button>
            <h2>Untitled Form</h2>
            <button id="add-section-btn" class="btn btn-primary">+</button>
        </div>
        <div id="form-container"></div>

        <button id="submit-btn" class="btn btn-success" style="margin-left: 240px; margin-top: 20px">Submit</button>

    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
    
</body>

</html>
