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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
            background-color: rgb(103, 58, 183);
            border-color: rgb(103, 58, 183);
            color: white;
            "
 float: left;
            clear: both;
        }

        .container {
            margin-top: 10px;

        }
        .tooltip-container {
        position: relative;
        display: inline-block;
    }

    .tooltip-container .tooltip {
        visibility: hidden;
        width: 70px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%; /* Position above the button */
        /* left: 50%; */
        /* margin-left: 10px; */
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip-container:hover .tooltip {
        visibility: visible;
        opacity: 1;
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
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Google Forms</a>
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
            <div class="tooltip-container">
                <button id="preview-btn" class="btn btn-info">
                    <i class="fas fa-eye"></i>
                </button>
                <span class="tooltip">Preview</span>
            </div>

            <h2><?php echo htmlspecialchars($title); ?></h2>
            <!-- <h2>Untitled Form</h2> -->

            <button id="add-section-btn" class="btn btn-primary">+</button>
        </div>
        <div id="form-container"></div>

        <button id="submit-btn" class="btn btn-success" style="margin-left: 240px; margin-top: 20px">Submit</button>
        <a id="cancel-btn" class="btn btn-danger" href="<?php echo base_url(); ?>"
            style="margin-left: 8px; margin-top: 20px; display: inline-block;">Cancel</a>

    </div>


    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>

</body>

</html>

   
