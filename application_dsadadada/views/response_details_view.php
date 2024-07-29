<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response Details</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/response_details_view.css"> -->
</head>
<body>
<style>
        .question-label {
            display: inline; /* Makes the <p> element behave like inline text */
            margin-bottom: 11px; /* Adds space below the text */
            padding: 0; /* Removes default padding */
            border: none; /* Removes any border */
            background: none; /* Removes any background color or box shadow */
        }
        .form-header {
    margin-bottom: 20px;
    text-align: left;
}
.form-description, .submitted-at, .user-email {
color: rgba(0, 0, 0, 0.5); /* Transparent text */
margin-bottom: 10px;
text-align: left; /* Align text left */
display: block; /* Ensure each element is a block element */
width: 100%; /* Ensure each element takes the full width of the container */
padding-left: 0; /* Ensure no padding is affecting alignment */
}
.form-section {
    border: 1px solid #ddd; /* Adds a light grey border around the section */
    border-radius: 5px; /* Optional: rounds the corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow effect */
    padding: 15px; /* Adds padding inside the section */
    background: #fff; /* Ensures background color is white for contrast */
    margin-bottom: 15px; /* Optional: adds space below the section */
}


    </style>
<div class="container">
    <div class="form-header">
        <h2><?php echo $form->title; ?></h2>
        <h4 class="form-description"><?php echo $form->description; ?></h4>
        <p class="submitted-at">Submitted At: <?php echo $response->submitted_at; ?></p>
        <p class="user-email">User Email: <?php echo $response->email; ?></p>  
    </div>
    <?php foreach ($questions_and_answers as $question): ?>
        <div class="form-section">
            <div class="question-section">
            <p class="form-control question-label"><?php echo $question->question_text; ?></p>
            <div class="form-control" disabled><?php echo $question->answered_text; ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
