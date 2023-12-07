<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'sportshub_db';
$username = 'root';
$password = '';

try {
    // Connect to the database
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Query to fetch data
    $query = "SELECT `Date`, `Sales` FROM `sales_data`";
    $statement = $db->query($query);

    // Fetch data from the database
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Separate dates and sales values
    $dates = [];
    $sales = [];

    foreach ($data as $row) {
        $dates[] = strtotime($row['Date']); // Convert date to timestamp
        $sales[] = floatval($row['Sales']);  // Convert sales to float
    }

   // Implement linear regression
function linearRegression($x, $y)
{
    $n = count($x);
    $sumX = array_sum($x);
    $sumY = array_sum($y);
    $sumXX = 0;
    $sumXY = 0;

    for ($i = 0; $i < $n; $i++) {
        $sumXX += ($x[$i] * $x[$i]);
        $sumXY += ($x[$i] * $y[$i]);
    }

    $slope = ($n * $sumXY - $sumX * $sumY) / ($n * $sumXX - $sumX * $sumX);
    $intercept = ($sumY - $slope * $sumX) / $n;

    return [$slope, $intercept];
}


    list($slope, $intercept) = linearRegression($dates, $sales);

    // Predict sales for an upcoming date
    $upcomingDate = strtotime(2023-10-29);
    $predictedSales = $intercept + $slope * $upcomingDate;

    echo "Predicted sales for 2023-10-29   is ::". round($predictedSales, 2);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
