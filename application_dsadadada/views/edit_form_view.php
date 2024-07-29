<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/header_new.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/editview.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Add SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <style>
  

        </style>
    <!-- Navbar -->
    <nav class="navbar navbar-custom">
    <div class="container">
        <?php if ($this->session->userdata('logged_in')): ?>
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Google Forms</a>
            </div>
        <?php endif; ?>

        <div id="navbar" class="navbar-collapse">
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
    <!-- Your flash messages and other content -->

    <!-- Form Editor -->
    <div class="container">
    <!-- Your flash messages and other content -->

    <!-- Form Editor -->
    <div class="container">
        <div class="form-header">
            <input type="text" id="form-title" class="form-control form-title" value="<?php echo $form['title']; ?>">
            <input type="text" id="form-description" class="form-control form-description" value="<?php echo $form['description']; ?>">
            <button id="add-section-btn" class="btn btn-primary">+</button>
        </div>
        <div id="form-container">
        <?php foreach ($questions as $question): ?>
    <div class="form-section" data-index="<?php echo $question['id']; ?>" data-type="<?php echo $question['type']; ?>">
        <div class="header-row">
            <input type="text" class="form-control untitled-question" placeholder="Untitled Question" rows="1" value="<?php echo $question['text']; ?>">
            <select class="custom-select question-type">
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
            $this->db->where('question_id', $question['id']);
            $options = $this->db->get('options')->result_array();
            foreach ($options as $option):
                $iconClass = ($question['type'] === 'multiple-choice' || $question['type'] === 'dropdown') ? 'fa-circle' : 'fa-square';
            ?>
                <div class="option">
                    <i class="fas <?php echo $iconClass; ?> icon-transparent"></i>
                    <input type="text" class="form-control option-label" value="<?php echo $option['option_text']; ?>">
                    <span class="delete-option-icon">&times;</span>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($question['type'] === 'multiple-choice' || $question['type'] === 'checkboxes' || $question['type'] === 'dropdown'): ?>
            <button class="btn btn-primary add-option-btn">Add Option</button>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

        </div>
        <button id="submit-btn" class="btn btn-success btn-custom">Submit</button>
    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>

    <script>
 $(document).ready(function () {
    var base_url = '<?php echo base_url(); ?>';
    var activeSection = null;
    $('#form-container').sortable({
        placeholder: 'ui-state-highlight',
        start: function (event, ui) {
            ui.placeholder.height(ui.item.height());
        },
        stop: function (event, ui) {
            positionAddSectionButton();
        }
    });
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

    function appendNewOption(section, questionType) {
    var iconClass = "";
    if (questionType === "multiple-choice") {
        iconClass = "fa-circle";
    } else if (questionType === "checkboxes") {
        iconClass = "fa-square";
    } else if (questionType === "dropdown") {
        iconClass = "fa-circle";
    }

    var optionHtml = `
        <div class="option">
            <i class="fas ${iconClass} icon-transparent"></i>
            <input type="text" class="form-control option-label" placeholder="Option">
            <span class="delete-option-icon">&times;</span>
        </div>
    `;
    section.find('.options-container').append(optionHtml);
}



    // Add section button functionality
    $('#add-section-btn').on('click', function () {
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
                <input type="text" class="form-control untitled-question" placeholder="Untitled Question" rows="1">
                <select class="custom-select question-type">
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
            <button class="btn btn-primary add-option-btn">Add Option</button>
        </div>
        `;
        $('#form-container').append(sectionHtml);

        var newSection = $('.form-section').last();

        newSection.find('.question-type').on('change', function() {
            var selectedType = $(this).val();
            var optionsContainer = newSection.find('.options-container');
            optionsContainer.empty(); // Clear previous options
            if (selectedType === 'multiple-choice' || selectedType === 'checkboxes' || selectedType === 'dropdown') {
                appendNewOption(newSection, selectedType);
                newSection.find('.add-option-btn').show();
            } else if (selectedType === 'short-answer') {
                optionsContainer.append('<input type="text" class="form-control" placeholder="Short answer text">');
                newSection.find('.add-option-btn').hide();
            } else if (selectedType === 'paragraph') {
                optionsContainer.append('<textarea class="form-control" placeholder="Paragraph text"></textarea>');
                newSection.find('.add-option-btn').hide();
            } else {
                newSection.find('.add-option-btn').hide();
            }
        });

        // Initially hide add option button
        newSection.find('.add-option-btn').hide();

        newSection.on('click', function () {
            $('.form-section').removeClass('active');
            $(this).addClass('active');
            activeSection = $(this);
            positionAddSectionButton();
        });

        positionAddSectionButton();
    }

    $('.question-type').on('change', function() {
        var section = $(this).closest('.form-section');
        var selectedType = $(this).val();
        var optionsContainer = section.find('.options-container');
        optionsContainer.empty(); // Clear previous options
        if (selectedType === 'multiple-choice' || selectedType === 'checkboxes' || selectedType === 'dropdown') {
            appendNewOption(section, selectedType);
            if (!section.find('.add-option-btn').length) {
                section.append('<button class="btn btn-primary add-option-btn">Add Option</button>');
            }
            section.find('.add-option-btn').show();
        } else if (selectedType === 'short-answer') {
            optionsContainer.append('<input type="text" class="form-control" placeholder="Short answer text">');
            section.find('.add-option-btn').hide();
        } else if (selectedType === 'paragraph') {
            optionsContainer.append('<textarea class="form-control" placeholder="Paragraph text"></textarea>');
            section.find('.add-option-btn').hide();
        } else {
            section.find('.add-option-btn').hide();
        }
    });

    $(document).on('click', '.add-option-btn', function () {
        var $section = $(this).closest('.form-section');
        var questionType = $section.find('.question-type').val();
        appendNewOption($section, questionType);
    });

    $(document).on('click', '.delete-section-icon', function () {
        $(this).closest('.form-section').remove();
        activeSection = null;
        positionAddSectionButton();
    });

    $(document).on('click', '.delete-option-icon', function () {
        $(this).closest('.option').remove();
    });

    $('.form-section').each(function () {
        $(this).on('click', function () {
            $('.form-section').removeClass('active');
            $(this).addClass('active');
            activeSection = $(this);
            positionAddSectionButton();
        });
    });

        $(window).on('resize', function () {
            positionAddSectionButton();
        });

        // positionAddSectionButton();
            $(document).ready(function () {
    var base_url = '<?php echo base_url(); ?>';

    $('#submit-btn').on('click', function () {
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
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Form updated successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = base_url + 'drafts';
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error updating form!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
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

        $('.form-section').each(function () {
            var questionData = {
                id: $(this).data('index'),
                text: $(this).find('.untitled-question').val(),
                type: $(this).find('.custom-select').val(),
                required: $(this).find('.required-toggle').is(':checked') ? 1 : 0,
                options: []
            };

            $(this).find('.option-label').each(function () {
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
});

            // Initialize

        });
    </script>
</body>

</html> 