$(document).ready(function() {
    let index = 1;
    let activeSection = null;

function addOption(type, container) {
    // let optionIndex = container.children().length + 1;
    let optionHtml;
    if (type === 'multiple-choice' || type === 'checkboxes') {
        optionHtml = `
            <div class="option">
                <input type="${type === 'multiple-choice' ? 'radio' : 'checkbox'}" disabled>
                <input type="text" class="form-control option-label" >
                <span class="delete-option-icon">&times;</span>
            </div>
        `;
    } 
    else if (type === 'dropdown') {
        optionHtml = `
            <div class="option">
                <input type="text" class="form-control option-label">
                <span class="delete-option-icon">&times;</span>
            </div>
        `;
    }
    container.append(optionHtml);
}

    function createFormSection() {
        let newSection = `
            <div class="form-section" data-index="${index}">
                <div class="header-row">
                    ${index === 1 ? '<div class="violet-border"></div>' : ''}
                    <input type="text" class="form-control untitled-question" placeholder="Untitled Question" rows="1">
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
            </div>
        `;
        $('#form-container').append(newSection);
        index++;
        positionAddSectionButton();
    }

    function positionAddSectionButton() {
        if (activeSection) {
            let position = activeSection.position();
            let buttonWidth = $('#add-section-btn').outerWidth();
            let buttonHeight = $('#add-section-btn').outerHeight();

            $('#add-section-btn').css({
                position: 'absolute',
                left: position.left - buttonWidth - 47 + 'px',
                top: position.top + activeSection.height() / 2 - buttonHeight / 2 + 'px'
            });
        }
    }

    $('#add-section-btn').on('click', function() {
        createFormSection();
        $('.form-section').removeClass('active');
        activeSection = $('.form-section').last();
        activeSection.addClass('active');
        positionAddSectionButton();
    });

    $(document).on('change', '.custom-select', function() {
        let type = $(this).val();
        let container = $(this).closest('.form-section').find('.options-container');
        container.empty();
        $(this).closest('.form-section').find('.add-option-btn').remove();

        if (type === 'short-answer') {
            container.append('<input type="text" class="form-control" disabled placeholder="Short answer text">');
        } else if (type === 'paragraph') {
            container.append('<textarea class="form-control" disabled placeholder="Paragraph text"></textarea>');
        } else {
            addOption(type, container);
            $(this).closest('.form-section').append('<button class="btn btn-secondary add-option-btn">Add Option</button>');
        }
    });

    $(document).on('click', '.add-option-btn', function() {
        let type = $(this).closest('.form-section').find('.custom-select').val();
        let container = $(this).closest('.form-section').find('.options-container');
        addOption(type, container);
    });

    $(document).on('click', '.delete-section-icon', function() {
        let section = $(this).closest('.form-section');
        let prevSection = section.prev('.form-section');
        let nextSection = section.next('.form-section');
        section.remove();
        if (section.hasClass('active')) {
            activeSection = null;
        }
        if (prevSection.length > 0) {
            prevSection.find('.delete-section-icon').appendTo(prevSection.find('.form-section'));
            activeSection = prevSection;row
        } 
        else if (nextSection.length > 0) {
            nextSection.find('.delete-section-icon').appendTo(nextSection.find('.form-header'));
            activeSection = nextSection;
        }
        positionAddSectionButton();
    });

    $(document).on('click', '.delete-option-icon', function() {
        let option = $(this).closest('.option');
        let container = option.closest('.options-container');
        option.remove();

   });

    $(document).on('click', '.required-toggle', function() {
        $(this).closest('.form-section').toggleClass('required');
    });

    $('#preview-btn').on('click', function() {
        let previewContent = '';
        $('.form-section').each(function() {
            previewContent += '<div class="form-section">';
            previewContent += '<div class="question-section">';
            previewContent += '<div class="question-label">' + $(this).find('.untitled-question').val() + '</div>';
            previewContent += '</div>';
            let type = $(this).find('.custom-select').val();
            let optionsContainer = $(this).find('.options-container');
    
            if (type === 'multiple-choice') {
                optionsContainer.find('.option').each(function() {
                    previewContent += `
                        <div class="option">
                            <input type="radio" name="option-${index}">
                            <label>${$(this).find('.option-label').val()}</label>
                        </div>
                    `;
                });
            } else if (type === 'checkboxes') {
                optionsContainer.find('.option').each(function() {
                    previewContent += `
                        <div class="option">
                            <input type="checkbox">
                            <label>${$(this).find('.option-label').val()}</label>
                        </div>
                    `;
                });
            } else if (type === 'short-answer') {
                previewContent += '<input type="text" class="form-control" placeholder="Short answer text">';
            } else if (type === 'paragraph') {
                previewContent += '<textarea class="form-control" placeholder="Paragraph text"></textarea>';
            } else if (type === 'dropdown') {
                let dropdownHtml = '<select class="form-control">';
                optionsContainer.find('.option .option-label').each(function() {
                    dropdownHtml += `<option>${$(this).val()}</option>`;
                });
                dropdownHtml += '</select>';
                previewContent += dropdownHtml;
            }
            previewContent += '</div>';
        });
    
        $.ajax({
            url: base_url+'form/preview',
            type: 'POST',
            data: {
                form_content: previewContent,
                title: '<?php echo htmlspecialchars($title); ?>' // Assuming you have the title available in your JS
            },
            success: function() {
                window.location.href = base_url+'form/preview';
            }
        });
    });
    
    
    $(document).on('click', '.form-section', function() {
        $('.form-section').removeClass('active');
        $(this).addClass('active');
        activeSection = $(this);
        positionAddSectionButton();
    });

    $('#form-container').sortable({
        placeholder: 'ui-state-highlight',
        start: function (event, ui) {
            ui.placeholder.height(ui.item.height());
        },
        stop: function (event, ui) {
            positionAddSectionButton();
        }
    });

    function collectFormData() {
        var formData = {
            questions: []
        };
    
        $('.form-section').each(function() {
            var questionType = $(this).find('.custom-select').val();
            var questionData = {
                text: $(this).find('.untitled-question').val(),
                type: questionType,
                is_required: $(this).find('.required-toggle').is(':checked'),
                options: []
            };
    
            // Only add options if the question type supports them
            if (questionType === 'multiple-choice' || questionType === 'checkboxes' || questionType === 'dropdown') {
                $(this).find('.option-label').each(function() {
                    questionData.options.push($(this).val());
                });
            }
    
            formData.questions.push(questionData);
        });
    
        console.log(formData);
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
    $('#submit-btn').on('click', function() {
        let formData = collectFormData();
        console.log(formData);
    
        let validation = validateFormData(formData);
        if (!validation.isValid) {
            alert(validation.message);
            return;
        }
    
        $.ajax({
            url: base_url + 'New_form_controller/submit_form',
            type: 'POST',
            data: { formData: formData },
            dataType: 'JSON',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Form submitted successfully!');
                    // Redirect to Form_controller/index_forms
                    window.location.href = base_url + 'Form_controller/index_forms';
                } else {
                    alert(response.message);
                    // console.log(response);
                }
            },
            error: function(error) {
                alert('Error submitting form!');
                window.location.href = base_url + 'Form_controller/index_forms';
                console.log(error);
            }
        });
    });
    
    $('#form-container').disableSelection();
});
