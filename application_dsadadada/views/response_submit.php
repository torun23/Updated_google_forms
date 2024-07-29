<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Preview - Google Forms</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/response_submit.css">

    <script>
    function validateForm() {
        let isValid = true;
        document.querySelectorAll('.question-container').forEach(function(container) {
            let isRequired = container.dataset.required === '1';
            let questionType = container.dataset.type;
            let isAnswered = false;

            // Select inputs relevant to the question type
            let inputs = container.querySelectorAll('input[type="text"], textarea, select, input[type="radio"]:checked, input[type="checkbox"]:checked');
            if (inputs.length > 0) {
                inputs.forEach(function(input) {
                    if (input.type === 'text' || input.tagName.toLowerCase() === 'textarea') {
                        if (input.value.trim() !== '') {
                            isAnswered = true;
                        }
                    } else if (input.type === 'radio' || input.type === 'checkbox') {
                        isAnswered = true;
                    } else if (input.tagName.toLowerCase() === 'select') {
                        if (input.value.trim() !== '') {
                            isAnswered = true;
                        }
                    }
                });
            }

            if (isRequired && !isAnswered) {
                container.style.border = '2px solid red';
                isValid = false;
            } else {
                container.style.border = 'none';
            }
        });
        return isValid;
    }

    function closePopup() {
        document.getElementById('popup-message').style.display = 'none';
    }

    // Display the popup message when the page loads
    window.onload = function() {
        if (document.getElementById('popup-message')) {
            document.getElementById('popup-message').style.display = 'block';
        }
    };
    </script>
    
    <style>
        .popup-message {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
    </style>

</head>
<body>
<div class="container">
    <!-- <div class="form-header">
        <h2><?php echo $form->title; ?></h2>
        <h4><?php echo $form->description; ?></h4>
    </div> -->
    
    <?php if (isset($message)): ?>
        <div id="popup-message" class="popup-message">
            <p><?php echo $message; ?></p>
            <button onclick="closePopup()">Close</button>
        </div>
    <?php else: ?>
        <form action="<?php echo base_url('response_submit/submit_form'); ?>" method="post" onsubmit="return validateForm();">
            <input type="hidden" name="form_id" value="<?php echo $form->id; ?>">
            <div class="form-section">
                <?php foreach ($questions as $question): ?>
                    <div class="question-container" data-required="<?php echo $question->is_required; ?>" data-type="<?php echo $question->type; ?>">
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
            <button type="submit" class="btn btn-success" style="display: block; margin: 20px auto 20px 240px; background-color: rgb(103, 58, 183); border-color: rgb(103, 58, 183); color: white;">Submit</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
