<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Summary</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 50%;
            margin: 0 auto;
            margin-bottom: 50px; /* Add margin to avoid overlap */
        }
        .short-answer, .paragraph {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Summary for "<?php echo $form->title; ?>"</h3>
                        <a href="<?php echo base_url('forms/view/' . $form->id); ?>" class="btn btn-primary">Back to Responses</a>
                    </div>
                    <div class="card-body">
                        <div id="charts">
                            <?php foreach ($summary_data as $question_id => $answers): ?>
                                <?php if (is_array($answers)): ?>
                                    <div class="chart-container">
                                        <canvas id="chart-<?php echo $question_id; ?>"></canvas>
                                    </div>
                                <?php else: ?>
                                    <div class="short-answer">
                                        <h5>Question <?php echo $question_id; ?></h5>
                                        <ul>
                                            <?php foreach ($answers as $answer): ?>
                                                <li><?php echo $answer; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var summaryData = <?php echo json_encode($summary_data); ?>;
            console.log('Summary Data:', summaryData); // Debugging information

            Object.keys(summaryData).forEach(function(question_id) {
                var answers = summaryData[question_id];
                if (typeof answers === 'object' && !Array.isArray(answers)) {
                    var ctx = document.getElementById('chart-' + question_id).getContext('2d');
                    var labels = Object.keys(answers);
                    var data = Object.values(answers);
                    console.log('Question ID:', question_id, 'Labels:', labels, 'Data:', data); // Debugging information

                    new Chart(ctx, {
                        type: 'pie', // Use 'bar' for bar chart
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: [
                                    '#FF6384',
                                    '#36A2EB',
                                    '#FFCE56',
                                    '#4BC0C0',
                                    '#9966FF',
                                    '#FF9F40'
                                ]
                            }]
                        },
                        options: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Question ' + question_id
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
