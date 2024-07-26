
<script>
    $('#basetable1').DataTable({
            "pagingType": "full_numbers", // Full pagination controls
            "lengthMenu": [10, 25, 50], // Options for number of rows per page
            "language": {
                "search": "Filter records:", // Custom search label
                "lengthMenu": "Show _MENU_ entries" // Custom length menu label
            },
            "columnDefs": [
                { "orderable": false, "targets": 2 } // Disable sorting for the "View" column (index 2)
            ],
            "order": [[1, "desc"]] // Default sort by "Filled At" column (index 1) in descending order
        });
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
