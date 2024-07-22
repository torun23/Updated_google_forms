<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
    <style>
        /* Include your styles here */
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <button id="preview-btn" class="btn btn-info"><i class="fas fa-eye"></i></button>
            <input type="text" id="form-title" class="form-control" value="<?php echo $form['title']; ?>">
            <input type="text" id="form-description" class="form-control" value="<?php echo $form['description']; ?>">

            <button id="add-section-btn" class="btn btn-primary">+</button>
        </div>
        <div id="form-container">
        <?php foreach ($questions as $question): ?>
    <div class="form-section" data-index="<?php echo $question['id']; ?>">
        <div class="header-row">
            <textarea class="form-control untitled-question" placeholder="Untitled Question" rows="1"><?php echo $question['text']; ?></textarea>
            <select class="custom-select">
                <option value="short-answer" <?php echo $question['type'] == 'short-answer' ? 'selected' : ''; ?>>Short Answer</option>
                <option value="paragraph" <?php echo $question['type'] == 'paragraph' ? 'selected' : ''; ?>>Paragraph</option>
                <option value="multiple-choice" <?php echo $question['type'] == 'multiple-choice' ? 'selected' : ''; ?>>Multiple Choice</option>
                <option value="checkboxes" <?php echo $question['type'] == 'checkboxes' ? 'selected' : ''; ?>>Checkboxes</option>
                <option value="dropdown" <?php echo $question['type'] == 'dropdown' ? 'selected' : ''; ?>>Dropdown</option>
            </select>
            <label class="toggle-switch">
                <input type="checkbox" class="required-toggle" <?php echo $question['required'] ? 'checked' : ''; ?>>
                <span class="slider"></span>
            </label>
            <span class="delete-section-icon"><i class="fas fa-trash-alt"></i></span>
        </div>
        <div class="options-container">
            <?php
            // Fetch options for this question only
            $this->db->where('question_id', $question['id']);
            $options = $this->db->get('options')->result_array();
            foreach ($options as $option):
            ?>
                <div class="option">
                    <input type="text" class="form-control option-label" value="<?php echo $option['option_text']; ?>">
                    <span class="delete-option-icon">&times;</span>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="btn btn-secondary add-option-btn">Add Option</button>
    </div>
<?php endforeach; ?>

        </div>

        <button id="submit-btn" class="btn btn-success" style="margin-left: 240px; margin-top: 20px">Submit</button>
    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
    <!-- <script src="<?php echo base_url('assets/js/edit.js'); ?>"></script> -->

    <script>
 $(document).ready(function() {
    var base_url = '<?php echo base_url(); ?>';

    // Add section button functionality
    $('#add-section-btn').on('click', function() {
        var sectionHtml = `
            <div class="form-section">
                <div class="header-row">
                    <textarea class="form-control untitled-question" placeholder="Untitled Question" rows="1"></textarea>
                    <select class="custom-select">
                        <option value="short-answer">Short Answer</option>
                        <option value="paragraph">Paragraph</option>
                        <option value="multiple-choice">Multiple Choice</option>
                        <option value="checkboxes">Checkboxes</option>
                        <option value="dropdown">Dropdown</option>
                    </select>
                    <label class="toggle-switch">
                        <input type="checkbox" class="required-toggle">
                        <span class="slider"></span>
                    </label>
                    <span class="delete-section-icon"><i class="fas fa-trash-alt"></i></span>
                </div>
                <div class="options-container">
                </div>
                <button class="btn btn-secondary add-option-btn">Add Option</button>
            </div>
        `;
        $('#form-container').append(sectionHtml);
    });

    // Add option button functionality
    $(document).on('click', '.add-option-btn', function() {
        var optionHtml = `
            <div class="option">
                <input type="text" class="form-control option-label" placeholder="Option">
                <span class="delete-option-icon">&times;</span>
            </div>
        `;
        $(this).siblings('.options-container').append(optionHtml);
    });

    // Delete option functionality
    $(document).on('click', '.delete-option-icon', function() {
        $(this).parent().remove();
    });

    // Delete section functionality
    $(document).on('click', '.delete-section-icon', function() {
        $(this).closest('.form-section').remove();
    });

    // Submit button functionality
    $('#submit-btn').on('click', function() {
        var formData = collectFormData();
        formData['form_id'] = <?php echo $form['id']; ?>;

        $.ajax({
            url: base_url + 'Form_controller/update_form',
            type: 'POST',
            data: { formData: formData },
            dataType: 'JSON',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Form updated successfully!');
                } else {
                    alert(response.message);
                }
            },
            error: function(error) {
                alert('Error updating form!');
                console.log(error);
            }
        });
    });

    // Collect form data function
    function collectFormData() {
        var formData = {
            title: $('#form-title').val(),
            description: $('#form-description').val(),
            questions: []
        };

        $('.form-section').each(function() {
            var questionData = {
                id: $(this).data('index'),
                text: $(this).find('.untitled-question').val(),
                type: $(this).find('.custom-select').val(),
                required: $(this).find('.required-toggle').is(':checked'),
                options: []
            };

            $(this).find('.option-label').each(function() {
                questionData.options.push($(this).val());
            });

            formData.questions.push(questionData);
        });

        return formData;
    }
});


    </script>
</body>
</html>
