<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Preview - Google Forms</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/form_preview.css">
</head>
<body>
    <style>.form-header {
    margin-left: 251px; /* Adjust the value as needed */
}
</style>
<div class="container">
    <div class="form-header">
        <h2><?php echo $form->title; ?></h2>
        <br>
        <h4><?php echo $form->description; ?></h4>
    </div>

    <?php foreach ($questions as $question): ?>
        <div class="form-section">
            <div class="question-section">
                <p class="question-label"><?php echo $question->text; ?></p>
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
<a href="<?php echo base_url('Publish_controller/publish_form/'.$form->id); ?>" class="btn btn-success">Publish</a>
    <br>
</div>
</body>
</html>
