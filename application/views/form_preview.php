<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Preview - Google Forms</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/form_preview_back.css">
    <style>
        body {
            background-color: rgb(240, 235, 248);
        }
        .container {
            margin-top: 30px;
        }
        .form-header {
            background-color: white;
            padding: 20px;
            margin-left: 240px;
            border-radius: 10px 10px 0 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border-top: 10px solid rgb(103, 58, 183);
            width: 56%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .form-header h2, .form-header h4 {
            margin: 0;
            text-align: left;
        }
        .form-header h4 {
            color: rgba(0, 0, 0, 0.5);
        }
        .form-section {
            background-color: white;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .question-section {
            margin-bottom: 10px;
        }
        .question-label {
            font-weight: bold;
        }
        .options-container {
            margin-top: 10px;
        }
        .option {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .option input[type="checkbox"] {
            margin-right: 10px;
            width: 16px; /* Adjust size of checkbox */
            height: 16px; /* Adjust size of checkbox */
        }
        .option input[type="radio"] {
            margin-right: 10px;
            width: 16px; /* Adjust size of radio button */
            height: 16px; /* Adjust size of radio button */
        }
        .option label {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-header">
        <h2><?php echo $form->title; ?></h2>
        <h4><?php echo $form->description; ?></h4>
    </div>

    <?php foreach ($questions as $question): ?>
        <div class="form-section">
            <div class="question-section">
                <input type="text" class="form-control question-label" value="<?php echo $question->text; ?>" disabled>
            </div>

            <?php if ($question->type == 'multiple-choice'): ?>
                <div class="options-container">
                    <?php foreach ($question->options as $option): ?>
                        <div class="option">
                            <input type="radio" name="option-<?php echo $question->id; ?>" disabled>
                            <label><?php echo $option->option_text; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php elseif ($question->type == 'checkboxes'): ?>
                <div class="options-container">
                    <?php foreach ($question->options as $option): ?>
                        <div class="option">
                            <input type="checkbox" name="option-<?php echo $question->id; ?>" disabled>
                            <label><?php echo $option->option_text; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php elseif ($question->type == 'short-answer'): ?>
                <div class="options-container">
                    <input type="text" class="form-control" placeholder="Short answer text" disabled>
                </div>
            <?php elseif ($question->type == 'paragraph'): ?>
                <div class="options-container">
                    <textarea class="form-control" placeholder="Paragraph text" disabled></textarea>
                </div>
            <?php elseif ($question->type == 'dropdown'): ?>
                <div class="options-container">
                    <select class="form-control" disabled>
                        <?php foreach ($question->options as $option): ?>
                            <option><?php echo $option->option_text; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <a href="<?php echo base_url('Publish_controller/publish_form/'.$form->id); ?>" class="btn btn-success" style="margin-top: 20px; position: relative; left: 240px;">Publish</a>
</div>
</body>
</html>
