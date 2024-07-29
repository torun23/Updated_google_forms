<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Preview - Google Forms</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/header_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 
</head>
<body>
    <style> 
    .navbar-custom .navbar-brand,
.navbar-custom .navbar-nav .nav-link {
    color: white !important; /* Forces the text color to be white */
    text-decoration: none !important; /* Ensures no underline */
    background: none !important; /* Ensures no background color */
}

.navbar-custom .navbar-brand:hover,
.navbar-custom .navbar-nav .nav-link:hover {
    color: white !important; /* Keeps text color white on hover */
    text-decoration: none !important; /* Ensures no underline on hover */
    background: none !important; /* Ensures no background color on hover */
}
.title-column {
        color: darkblue;
    }

    .draft-row {
        background-color: #f0f0f0;
    }

.switch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 14px;
        width: 14px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #673AB7;
    }

    input:checked + .slider:before {
        transform: translateX(14px);
    }

    .slider.round {
        border-radius: 20px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .switch .tooltip {
        visibility: hidden;
        width: 70px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 290%;
        margin-left: -60px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .switch:hover .tooltip {
        visibility: visible;
        opacity: 1;
    }
    </style>

<nav class="navbar navbar-inverse" style="background-color: rgb(103, 58, 183);">
    <div class="container" style="background-color: rgb(103, 58, 183);">
        <?php if ($this->session->userdata('logged_in')): ?>
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Google Forms</a>
            </div>
        <?php endif; ?>

        <div id="navbar">
            <ul class="nav navbar-nav">
                <?php if ($this->session->userdata('logged_in')): ?>
                    <li><a href="<?php echo base_url(); ?>published_forms">Published Forms</a></li>
                    <li><a href="<?php echo base_url(); ?>drafts">Drafts</a></li>

                <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (!$this->session->userdata('logged_in')): ?>
                    <li><a href="<?php echo base_url(); ?>users/login">Login</a></li>
                    <li><a href="<?php echo base_url(); ?>users/register">Register</a></li>
                <?php endif; ?>
                <?php if ($this->session->userdata('logged_in')): ?>
                    <li><a href="<?php echo base_url(); ?>title">Create Form</a></li>
                    <li><a href="<?php echo base_url(); ?>users/logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <?php if ($this->session->flashdata('user_registered')): ?>
        <p class="alert alert-success flash-message" id="flash-user-registered"><?php echo $this->session->flashdata('user_registered'); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('login_failed')): ?>
        <p class="alert alert-danger flash-message" id="flash-login-failed"><?php echo $this->session->flashdata('login_failed'); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('user_loggedin')): ?>
        <p class="alert alert-success flash-message" id="flash-user-loggedin"><?php echo $this->session->flashdata('user_loggedin'); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('user_loggedout')): ?>
        <p class="alert alert-success flash-message" id="flash-user-loggedout"><?php echo $this->session->flashdata('user_loggedout'); ?></p>
    <?php endif; ?>
</div>
