<?php 
// // Function to perform linear regression and predict sales
// function linearRegression($input, $output, $inputForPrediction) {
//     // Check if input and output arrays are empty or have inconsistent sizes
//     if (empty($input) || empty($output) || count($input) !== count($output) || empty($inputForPrediction)) {
//         return [];
//     }

//     $numDaysPerWeek = count($input[0]);

//     // Check if input and output arrays have at least one day of sales
//     if ($numDaysPerWeek === 0) {
//         return [];
//     }

//     // Calculate means of input and output arrays
//     $inputMean = array_map(function () use ($input) {
//         return 0;
//     }, $input[0]);
//     $outputMean = array_map(function () use ($output) {
//         return 0;
//     }, $output[0]);

//     for ($i = 0; $i < count($input); $i++) {
//         if (count($input[$i]) !== $numDaysPerWeek || count($output[$i]) !== $numDaysPerWeek) {
//             return [];
//         }

//         for ($j = 0; $j < $numDaysPerWeek; $j++) {
//             $inputMean[$j] += $input[$i][$j];
//             $outputMean[$j] += $output[$i][$j];
//         }
//     }

//     for ($j = 0; $j < $numDaysPerWeek; $j++) {
//         $inputMean[$j] /= count($input);
//         $outputMean[$j] /= count($output);
//     }

//     // Calculate differences for numerator and denominator of slope equation
//     $numerator = 0;
//     $denominator = 0;

//     for ($i = 0; $i < count($input); $i++) {
//         for ($j = 0; $j < $numDaysPerWeek; $j++) {
//             $numerator += ($input[$i][$j] - $inputMean[$j]) * ($output[$i][$j] - $outputMean[$j]);
//             $denominator += pow(($input[$i][$j] - $inputMean[$j]), 2);
//         }
//     }

//     // Add a small constant value to denominator to avoid division by zero
//     $denominator += 0.000001;

//     // Calculate slope and intercept
//     $slope = $numerator / $denominator;
//     $intercept = $outputMean[0] - ($slope * $inputMean[0]);

//     // Predict sales for the coming week
//     $predictedSales = [];

//     foreach ($inputForPrediction[0] as $daySales) {
//         $predictedSales[] = ($slope * $daySales) + $intercept;
//     }

//     return $predictedSales;
// }

// // Input data (sales of this week)
// $input = [
//     [9, 15, 12, 8, 10, 11, 12], // Sales for each day of this week
// ];

// // Output data (sales of the next week)
// $output = [
//     [14, 15, 100, 9, 22, 15, 2], // Sales for each day of the next week
// ];

// // Input data for prediction (sales of next week)
// $inputForPrediction = [
//     [25, 18, 22, 15, 30, 30, 30], // Sales for each day of next week
// ];

// // Predict sales for the coming week
// $predictedSales = linearRegression($input, $output, $inputForPrediction);
// echo "<div class='bg-secondary'>";
// // Display the predicted sales for each day of the coming week
// echo "Predicted Sales for the Coming Week:\n";
// for ($day = 0; $day <1; $day++) {
//     echo "Day " . ($day + 1) . ": " . $predictedSales[$day] . "\n";
// }
// echo "</div>";
?>
<?php
// Sample training data
$X_train = [2000, 4000, 5000, 4000, 5000,4000,6000,8000,2000];  // Independent variable
$y_train = [2, 3, 7, 4, 4,4,9,8,2];  // Dependent variable

// Calculate the mean of an array
function mean($data) {
    return array_sum($data) / count($data);
}

// Calculate the variance of an array
function variance($data) {
    $mean = mean($data);
    $squared_deviations = array_map(function ($x) use ($mean) {
        return ($x - $mean) ** 2;
    }, $data);
    return mean($squared_deviations);
}

// Calculate the covariance between two arrays
function covariance($X, $y) {
    $n = count($X);
    $mean_X = mean($X);
    $mean_y = mean($y);
    $result = 0;
    for ($i = 0; $i < $n; $i++) {
        $result += ($X[$i] - $mean_X) * ($y[$i] - $mean_y);
    }
    return $result / ($n - 1);
}

// Calculate the coefficients (b0 and b1) of the linear regression model
function linear_regression($X, $y) {
    $b1 = covariance($X, $y) / variance($X);
    $b0 = mean($y) - $b1 * mean($X);
    return [$b0, $b1];
}

// Input value for prediction
$X_pred = 5400;  // New advertising spend

// Perform linear regression
[$b0, $b1] = linear_regression($X_train, $y_train);

// Make a prediction
$y_pred = $b0 + $b1 * $X_pred;

// Display the prediction
echo "Predicted Sales : $y_pred sales in this week\n";
?>
