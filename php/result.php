<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skin Condition Result</title>
</head>
<body>
<?php
// Get parameters from URL
$finalScore = $_GET['score'] ?? '';
$skinCondition = $_GET['condition'] ?? '';

// Display final score and skin condition
echo "<h2>Skin Condition Result</h2>";
echo "<p>Final Score: $finalScore</p>";
echo "<p>Skin Condition: $skinCondition</p>";
?>
</body>
</html>