<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classification of Clients Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Classification of Clients</h2>
        <canvas id="classificationChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Get data from PHP and prepare it for Chart.js
        const classificationLabels = [];
        const classificationData = [];

        // Assuming classification_data is an associative array like ['classification' => 'total']
        <?php if (!empty($classification_data)): ?>
            <?php foreach ($classification_data as $classification => $total): ?>
                classificationLabels.push('<?= html_entity_decode($classification) ?>');
                classificationData.push(<?= htmlspecialchars($total) ?>);
            <?php endforeach; ?>
        <?php endif; ?>

        // Render the chart using Chart.js
        const ctx = document.getElementById('classificationChart').getContext('2d');
        const classificationChart = new Chart(ctx, {
            type: 'bar', // Change this to 'pie' or 'doughnut' if you prefer another type
            data: {
                labels: classificationLabels,
                datasets: [{
                    label: 'Total Clients',
                    data: classificationData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <?php print_r($classification_data); ?> 
</body>
</html>
