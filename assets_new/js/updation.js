$(document).ready(function() {
    let index = 1;
    let activeSection = null;

    function addOption(type, container) {
        let optionHtml;
        if (type === 'multiple-choice' || type === 'checkboxes') {
            optionHtml = `
                <div class="option">
                    <input type="${type === 'multiple-choice' ? 'radio' : 'checkbox'}" disabled>
                    <input type="text" class="form-control option-label">
                    <span class="delete-option-icon">&times;</span>
                </div>
            `;
        } else if (type === 'dropdown') {
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
   
});