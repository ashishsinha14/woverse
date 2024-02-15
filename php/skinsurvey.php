<?php
$servername = "pdb58.awardspace.net";
$database = "4202451_woverse";
$username = "4202451_woverse";
$password = "Advita@01";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

// Escape user inputs for security
$age = mysqli_real_escape_string($conn, $_REQUEST['age']);
$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
$skinType = $_POST['skinType'];
$menoPauseStage = $_POST['menoPauseStage'];
$sensitivity = mysqli_real_escape_string($conn, $_REQUEST['sensitivity']);
$hydration = mysqli_real_escape_string($conn, $_REQUEST['hydration']);
$sunscreen = mysqli_real_escape_string($conn, $_REQUEST['sunscreen']);
$diethabit = mysqli_real_escape_string($conn, $_REQUEST['diethabit']);
$water = mysqli_real_escape_string($conn, $_REQUEST['water']);
$sleep = mysqli_real_escape_string($conn, $_REQUEST['sleep']);
$stress = mysqli_real_escape_string($conn, $_REQUEST['stress']);
$sunexposure = mysqli_real_escape_string($conn, $_REQUEST['sunexposure']);
$surveyDate = date("Y/m/d");

// Function to calculate the final score
function calculateFinalScore($input)
{
    // Assign points based on the provided logic
    $points = [
        'SkinType' => [
            'Dry' => 1,
            'Oily' => 2,
            'Combination' => 3,
            'Normal' => 4
        ],
        'MenopausalStage' => [
            'Perimenopause' => 1,
            'Postmenopause' => 2,
            'NotSure' => 3
        ],
        'SkinSensitivity' => [
            'VerySensitive' => 1,
            'Sensitive' => 2,
            'Normal' => 3,
            'Resilient' => 4
        ],
        'HydrationLevels' => [
            'AlwaysHydrated' => 4,
            'OccasionallyDehydrated' => 2,
            'OftenDehydrated' => 1
        ],
        'SunscreenUse' => [
            'Daily' => 4,
            'Occasionally' => 2,
            'Rarely' => 1
        ],
        'DietaryHabits' => [
            'BalancedDiet' => 4,
            'OccasionalIntake' => 2,
            'LimitedIntake' => 1
        ],
        'Water' => [
            'GoodWaterIntake' => 4,
            'AverageWaterIntake' => 3,
        ],
        'StressLevels' => [
            'Low' => 4,
            'Moderate' => 3,
            'High' => 2
        ],
        'SleepQuality' => [
            'Good' => 4,
            'Average' => 2,
            'Poor' => 1
        ],
        'SmokingHabits' => [
            'NonSmoker' => 4,
            'FormerSmoker' => 3,
            'CurrentSmoker' => 2
        ],
        'AlcoholConsumption' => [
            'RarelyOrNever' => 4,
            'Occasionally' => 3,
            'Regularly' => 2
        ],
        'ExposureToEnvironmentalFactors' => [
            'MinimalSunExposure' => 4,
            'ModerateSunExposure' => 3,
            'HighSunExposure' => 2
        ],
        'ExistingSkincareProductUsage' => [
            'None' => 1,
            'BasicProducts' => 2,
            'SpecializedProducts' => 3
        ]
    ];

    $totalScore = 0;

    // Loop through the input and calculate the total score
    foreach ($input as $category => $value) {
        if (isset($points[$category][$value])) {
            $totalScore += $points[$category][$value];
        }
    }

    return $totalScore;
}

// Example input data
$inputData = [
    'SkinType' => $skinType,
    'MenopausalStage' => $menoPauseStage,
    'SkinSensitivity' => $sensitivity,
    'HydrationLevels' => $hydration,
    'SunscreenUse' => $sunscreen,
    'DietaryHabits' => $diethabit,
    'Water' => $water,
    'StressLevels' => $stress,
    'SleepQuality' => $sleep,
    'SmokingHabits' => 'NonSmoker',
    'AlcoholConsumption' => 'RarelyOrNever',
    'ExposureToEnvironmentalFactors' => $sunexposure,
    'ExistingSkincareProductUsage' => 'BasicProducts'
];

// Calculate the final score
$finalScore = calculateFinalScore($inputData);

// Determine skin condition based on the final score
if ($finalScore >= 52 && $finalScore <= 67) {
    $skinCondition = 'Excellent skin condition';
} elseif ($finalScore >= 47 && $finalScore <= 51) {
    $skinCondition = 'Good skin condition';
} elseif ($finalScore >= 22 && $finalScore <= 36) {
    $skinCondition = 'Moderate skin condition';
} else {
    $skinCondition = 'Needs attention; consider consulting a skincare professional or dermatologist for personalized advice.';
}

// Output the final score and skin condition
echo "Final Score: $finalScore\n";
echo "Skin Condition: $skinCondition\n";

$sql="INSERT INTO skinsurvey_input (age, email, skinType, menoPauseStage, sensitivity, hydration, sunscreen, diethabit, water, sleep , stress, sunexposure, surveyDate) 
VALUES ('$age', '$email', '$skinType', '$menoPauseStage','$sensitivity','$hydration','$sunscreen','$diethabit','$water', '$sleep' , '$stress', '$sunexposure', '$surveyDate')";
if (mysqli_query($conn, $sql)) {
	// echo "New record created successfully";
	// header('Location: surveythankyou.html');
	header("Content-Type: text/plain");
	header("Location: result.php?score=$finalScore&condition=".urlencode($skinCondition));
	echo "<script>
            function redirectToResult() {
                var finalScore = '$finalScore';
                var skinCondition = '" . urlencode($skinCondition) . "';
                window.location.href = 'result.html?score=' + finalScore + '&condition=' + skinCondition;
            }
            redirectToResult();
          </script>";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>


