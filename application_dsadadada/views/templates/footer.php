
<script>
            $(document).ready(function() {
                $('#basetable1').DataTable({
                    "pagingType": "full_numbers", // Full pagination controls
                    "lengthMenu": [10, 25, 50], // Options for number of rows per page
                    "language": {
                        "search": "Filter records:", // Custom search label
                        "lengthMenu": "Show _MENU_ entries" // Custom length menu label
                    },
                    "columnDefs": [
                        { "orderable": false, "targets": 5 } // Disable sorting for the "View" column (index 5)
                    ],
                    "order": [[3, "desc"]] // Default sort by "Created On" column (index 3) in descending order
                });

                updateCardColors();
            });
           
            document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-switch').forEach(function(switchElement) {
            switchElement.addEventListener('change', function() {
                var formId = this.getAttribute('data-form-id');
                var isResponsive = this.checked ? 1 : 0;

                fetch(`<?php echo base_url('Publish_controller/toggle_responsive/'); ?>${formId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: `is_responsive=${isResponsive}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Optionally, handle success
                    } else {
                        // Optionally, handle failure
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
        function updateCardColors() {
            const totalForms = document.getElementById('total-forms');
            const publishedForms = document.getElementById('published-forms');
            const totalResponses = document.getElementById('total-responses');

            const totalFormsValue = parseInt(totalForms.textContent);
            const publishedFormsValue = parseInt(publishedForms.textContent);
            const totalResponsesValue = parseInt(totalResponses.textContent);

            // Update colors based on values
            if (totalFormsValue) {
                totalForms.classList.add('blue');
            } else {
                totalForms.classList.add('red');
            }

            if (publishedFormsValue) {
                publishedForms.classList.add('green');
            } else {
                publishedForms.classList.add('red');
            }

            if (totalResponsesValue) {
                totalResponses.classList.add('red');
            } else {
                totalResponses.classList.add('red');
            }
        }
        $(document).ready(function() {
    // Fade out flash messages after 2 seconds
    setTimeout(function() {
        $('.flash-message').fadeOut(1000);
    }, 600);
});
$(document).ready(function() {
    // Fade out flash messages after 2 seconds
    setTimeout(function() {
        $('#flash-messages .flash-message').fadeOut(1000);
    }, 2000);

    // Example function to show validation messages
    function showError(fieldId, message) {
        $(`#${fieldId}-error`).text(message).show();
    }

    // Example function to hide validation messages
    function clearError(fieldId) {
        $(`#${fieldId}-error`).text('').hide();
    }

    // Registration form validation
    $('#register-form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Clear all previous errors
        clearError('username');
        clearError('email');
        clearError('password');
        clearError('password2');

        // Validate fields
        let isValid = true;

        // Example validation logic
        if ($('input[name="username"]').val().trim() === '') {
            showError('username', 'Username is required.');
            isValid = false;
        }

        if ($('input[name="email"]').val().trim() === '') {
            showError('email', 'Email is required.');
            isValid = false;
        }

        if ($('input[name="password"]').val().trim() === '') {
            showError('password', 'Password is required.');
            isValid = false;
        }

        if ($('input[name="password2"]').val().trim() === '') {
            showError('password2', 'Confirm Password is required.');
            isValid = false;
        } else if ($('input[name="password"]').val() !== $('input[name="password2"]').val()) {
            showError('password2', 'Passwords do not match.');
            isValid = false;
        }

        if (isValid) {
            // Proceed with form submission
            this.submit();
        }
    });

    // Login form validation
$('#login-form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Clear all previous errors
        clearError('username');
        clearError('password');

        // Validate fields
        let isValid = true;

        // Example validation logic
        if ($('input[name="username"]').val().trim() === '') {
            showError('username', 'Username is required.');
            isValid = false;
        }

        if ($('input[name="password"]').val().trim() === '') {
            showError('password', 'Password is required.');
            isValid = false;
        }

        if (isValid) {
            // Proceed with form submission
            this.submit();
        }
    });
});
</script>
</body>
</html>