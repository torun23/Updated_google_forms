<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/header_new.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-custom">
        <div class="container">
            <?php if ($this->session->userdata('logged_in')): ?>
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">Google Forms</a>
                </div>
            <?php endif; ?>

            <div id="navbar">
                <ul class="nav navbar-nav left">
                    <?php if ($this->session->userdata('logged_in')): ?>
                        <li><a href="<?php echo base_url(); ?>published_forms">Published Forms</a></li>
                        <li><a href="<?php echo base_url(); ?>drafts">Drafts</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav right">
                    <?php if (!$this->session->userdata('logged_in')): ?>
                        <li><a href="<?php echo base_url(); ?>users/login">Login</a></li>
                        <li><a href="<?php echo base_url(); ?>users/register">Register</a></li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('logged_in')): ?>
                        <li><a href="<?php echo base_url(); ?>homepage/title">Create Form</a></li>
                        <li><a href="<?php echo base_url(); ?>users/logout">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    <div class="container">
        <?php if ($this->session->flashdata('user_registered')): ?>
            <p class="alert alert-success"><?php echo $this->session->flashdata('user_registered'); ?></p>
        <?php endif; ?>

        <?php if ($this->session->flashdata('login_failed')): ?>
            <p class="alert alert-danger"><?php echo $this->session->flashdata('login_failed'); ?></p>
        <?php endif; ?>

        <?php if ($this->session->flashdata('user_loggedin')): ?>
            <p class="alert alert-success"><?php echo $this->session->flashdata('user_loggedin'); ?></p>
        <?php endif; ?>

        <?php if ($this->session->flashdata('user_loggedout')): ?>
            <p class="alert alert-success"><?php echo $this->session->flashdata('user_loggedout'); ?></p>
        <?php endif; ?>
    </div>

    <!-- Form Editor -->
    <div class="container">
        <div class="form-header">
            <button id="preview-btn" class="btn btn-info"><i class="fas fa-eye"></i></button>
            <input type="text" id="form-title" class="form-control" value="<?php echo $form['title']; ?>">
            <input type="text" id="form-description" class="form-control" value="<?php echo $form['description']; ?>">
            <button id="add-section-btn" class="btn btn-primary">+</button>
        </div>
        <div id="form-container">
            <?php foreach ($questions as $question): ?>
                <div class="form-section" data-index="<?php echo $question['id']; ?>" data-type="<?php echo $question['type']; ?>">
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
                            <input type="checkbox" class="required-toggle" <?php echo $question['is_required'] ? 'checked' : ''; ?>>
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
                    <!-- Show or hide the "Add Option" button based on question type -->
                    <?php if ($question['type'] === 'multiple-choice' || $question['type'] === 'checkboxes' || $question['type'] === 'dropdown'): ?>
                        <button class="btn btn-secondary add-option-btn">Add Option</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <button id="submit-btn" class="btn btn-success btn-custom">Submit</button>
    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
    <!-- <script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script> -->

    <script>
$(document).ready(function() {
    var base_url = '<?php echo base_url(); ?>';
    var index = 1;
    var activeSection = null;

    function positionAddSectionButton() {
        if (activeSection) {
            var position = activeSection.position();
            var buttonWidth = $('#add-section-btn').outerWidth();
            var buttonHeight = $('#add-section-btn').outerHeight();

            $('#add-section-btn').css({
                position: 'absolute',
                left: position.left - buttonWidth - 47 + 'px',
                top: position.top + activeSection.height() / 2 - buttonHeight / 2 + 'px'
            });
        }
    }

    // Add section button functionality
    $('#add-section-btn').on('click', function() {
        createFormSection();
        $('.form-section').removeClass('active');
        activeSection = $('.form-section').last();
        activeSection.addClass('active');
        positionAddSectionButton();
    });

    function createFormSection() {
        var sectionHtml = `
            <div class="form-section" data-type="">
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
                <div class="options-container"></div>
                <button class="btn btn-secondary add-option-btn">Add Option</button>
            </div>
        `;
        $('#form-container').append(sectionHtml);
    }

    // Handle option button click
    $(document).on('click', '.add-option-btn', function() {
        var $section = $(this).closest('.form-section');
        var optionHtml = `
            <div class="option">
                <input type="text" class="form-control option-label" value="">
                <span class="delete-option-icon">&times;</span>
            </div>
        `;
        $section.find('.options-container').append(optionHtml);
    });

    // Handle delete section button click
    $(document).on('click', '.delete-section-icon', function() {
        $(this).closest('.form-section').remove();
    });

    // Handle delete option button click
    $(document).on('click', '.delete-option-icon', function() {
        $(this).closest('.option').remove();
    });

    // Handle preview button click
    $('#preview-btn').on('click', function() {
        alert('Preview functionality is not implemented.');
    });

    // Handle submit button click
    $('#submit-btn').on('click', function() {
        var formData = collectFormData();
        formData['form_id'] = <?php echo $form['id']; ?>;

        let validation = validateFormData(formData);
        if (!validation.isValid) {
            alert(validation.message);
            return;
        }

        $.ajax({
            url: base_url + 'Form_controller/update_form',
            type: 'POST',
            data: { formData: formData },
            dataType: 'JSON',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Form updated successfully!');
                    window.location.href = base_url + 'drafts';
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
                required: $(this).find('.required-toggle').is(':checked') ? 1 : 0, // Correctly capture the required value
                options: []
            };

            $(this).find('.option-label').each(function() {
                questionData.options.push($(this).val());
            });

            formData.questions.push(questionData);
        });

        return formData;
    }
    function validateFormData(formData) {
        for (let question of formData.questions) {
            if (!question.text.trim()) {
                return { isValid: false, message: 'All questions must have text.' };
            }
            if ((question.type === 'multiple-choice' || question.type === 'checkboxes' || question.type === 'dropdown') && question.options.length === 0) {
                return { isValid: false, message: 'All options-based questions must have at least one option.' };
            }
            for (let option of question.options) {
                if (!option.trim()) {
                    return { isValid: false, message: 'All options must have text.' };
                }
            }
        }
        return { isValid: true };
    }   

    // Initialize
    $('.form-section').each(function() {
        $(this).on('click', function() {
            $('.form-section').removeClass('active');
            $(this).addClass('active');
            activeSection = $(this);
            positionAddSectionButton();
        });
    });

    // Handle window resize to reposition button
    $(window).on('resize', function() {
        positionAddSectionButton();
    });
});
    </script>
</body>
</html>
