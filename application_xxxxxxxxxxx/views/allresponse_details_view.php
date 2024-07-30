<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response Details</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.11.5/css/jquery.dataTables.min.css">
    <style>
        .question-label {
            display: inline;
            margin-bottom: 11px;
            padding: 0;
            border: none;
            background: none;
        }
        .form-section {
            border: 2px solid #ddd; /* Thicker border */
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Box shadow */
            padding: 15px;
            background: #fff;
            margin-bottom: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .form-section:hover {
            transform: scale(1.02); /* Pop-out effect */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Enhanced box shadow on hover */
        }
        #scroll-up-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            z-index: 9999; /* Ensure it's above other content */
            background-color: #007bff; /* Button color */
            color: #fff; /* Text color */
            border: none;
            border-radius: 50%; /* Rounded button */
            width: 50px;
            height: 50px;
            text-align: center;
            line-height: 50px; /* Center text vertically */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Box shadow */
            font-size: 20px; /* Font size */
        }
        #scroll-up-btn:hover {
            background-color: #0056b3; /* Darker color on hover */
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 5px 10px;
            margin: 0 2px;
            border: 2px solid #007bff; /* Thicker border for pagination */
            border-radius: 3px;
            background-color: #f8f9fa;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #007bff;
            color: #fff;
        }
        table.dataTable thead th {
            border-bottom: 2px solid #007bff; /* Thicker border for table header */
        }
        table.dataTable tbody td, table.dataTable thead th {
            border: 2px solid #007bff; /* Thicker border for table cells */
        }
        .response-count {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <?php foreach ($responses as $form_title => $form_responses): ?>
        <div class="form-section">
            <h2><?php echo $form_title; ?></h2>
            <p class="response-count">Number of responses: <span><?php echo count($form_responses); ?></span></p> <!-- Display response count -->
            <table class="table table-bordered" id="responses-table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answers</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $all_questions = [];
                    foreach ($form_responses as $response) {
                        foreach ($response['questions_and_answers'] as $qa) {
                            if (!isset($all_questions[$qa->text])) {
                                $all_questions[$qa->text] = [];
                            }
                            $all_questions[$qa->text][] = $qa->answered_text;
                        }
                    }
                    ?>
                    <?php foreach ($all_questions as $question => $answers): ?>
                        <tr>
                            <td><?php echo $question; ?></td>
                            <td><?php echo implode(", ", $answers); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>

<button id="scroll-up-btn" class="btn">↑</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#responses-table').DataTable();

        var scrollUpBtn = document.getElementById('scroll-up-btn');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 200) {
                scrollUpBtn.style.display = 'block';
            } else {
                scrollUpBtn.style.display = 'none';
            }
        });

        scrollUpBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>
</body>
</html>
