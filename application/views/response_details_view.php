<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response Details</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <style>
        .form-header {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-description, .submitted-at, .user-email {
            color: rgba(0, 0, 0, 0.5); /* Transparent text */
            margin-bottom: 10px;
            text-align: left;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .question-section {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            text-align: left;
        }
    </style>
</head>
<body>
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
