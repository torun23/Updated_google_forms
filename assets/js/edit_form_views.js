$(document).ready(function() {
    var base_url = '<?php echo base_url(); ?>';

    // Add section button functionality
    $('#add-section-btn').on('click', function() {
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
                <button class="btn btn-secondary add-option-btn" style="display: none;">Add Option</button>
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

    // Show/Hide "Add Option" button based on question type
    $(document).on('change', '.custom-select', function() {
        var type = $(this).val();
        var $section = $(this).closest('.form-section');
        if (type === 'multiple-choice' || type === 'checkboxes' || type === 'dropdown') {
            $section.find('.add-option-btn').show();
        } else {
            $section.find('.add-option-btn').hide();
        }
    }).trigger('change'); // Trigger change to apply to existing sections

    // Submit button functionality
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
                    window.location.href = base_url + 'Form_controller/index_forms_draft';
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
});