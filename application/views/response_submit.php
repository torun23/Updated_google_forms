<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Preview - Google Forms</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/response_submit.css">
    <style>
        .required-field::after {
            content: '*';
            color: red;
            margin-left: 5px;
        }
        .form-section {
            background-color: white;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .question-container {
            margin-bottom: 20px;
        }
    </style>
    <script>
        function validateForm() {
            let isValid = true;
            document.querySelectorAll('.question-container').forEach(function(container) {
                let isRequired = container.dataset.required === '1';
                let inputs = container.querySelectorAll('input[type="text"], textarea, select, input[type="radio"]:checked, input[type="checkbox"]:checked');
                if (isRequired && inputs.length === 0) {
                    container.style.border = '2px solid red';
                    isValid = false;
                } else {
                    container.style.border = 'none';
                }
            });
            return isValid;
        }
    </script>
</head>
<body>
<div class="container">
    <div class="form-header">
        <h2><?php echo $form->title; ?></h2>
        <h4><?php echo $form->description; ?></h4>
    </div>
    <form action="<?php echo base_url('response_submit/submit_form'); ?>" method="post" onsubmit="return validateForm();">
        <input type="hidden" name="form_id" value="<?php echo $form->id; ?>">
        <div class="form-section">
            <?php foreach ($questions as $question): ?>
                <div class="question-container" data-required="<?php echo $question->is_required; ?>">
                    <input type="hidden" name="responses[<?php echo $question->id; ?>][question_id]" value="<?php echo $question->id; ?>">
                    <input type="hidden" name="responses[<?php echo $question->id; ?>][form_id]" value="<?php echo $form->id; ?>">
                    <label class="<?php echo $question->is_required ? 'required-field' : ''; ?>"><?php echo $question->text; ?></label>
                    <?php if ($question->type == 'multiple-choice'): ?>
                        <?php foreach ($question->options as $option): ?>
                            <div class="option">
                                <input type="radio" name="responses[<?php echo $question->id; ?>][options][]" value="<?php echo $option->option_text; ?>">
                                <label><?php echo $option->option_text; ?></label>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif ($question->type == 'checkboxes'): ?>
                        <?php foreach ($question->options as $option): ?>
                            <div class="option">
                                <input type="checkbox" name="responses[<?php echo $question->id; ?>][options][]" value="<?php echo $option->option_text; ?>">
                                <label><?php echo $option->option_text; ?></label>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif ($question->type == 'short-answer'): ?>
                        <input type="text" class="form-control" name="responses[<?php echo $question->id; ?>][answered_text]" placeholder="Short answer text">
                    <?php elseif ($question->type == 'paragraph'): ?>
                        <textarea class="form-control" name="responses[<?php echo $question->id; ?>][answered_text]" placeholder="Paragraph text"></textarea>
                    <?php elseif ($question->type == 'dropdown'): ?>
                        <select class="form-control" name="responses[<?php echo $question->id; ?>][answered_text]">
                            <?php foreach ($question->options as $option): ?>
                                <option value="<?php echo $option->option_text; ?>"><?php echo $option->option_text; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-success" style="display: block; margin: 20px auto 20px 240px;">Submit</button>
    </form>
</div>
</body>
</html>
