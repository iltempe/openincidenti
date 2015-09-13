<?
// Set headers to make the browser download the results as a csv file
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=incidenti.csv");
header("Pragma: no-cache");
header("Expires: 0");

// Connect to DB
$conn = new PDO('sqlite:leaflet.sqlite');

// Query
$query = $conn->query("SELECT * FROM users");

// Fetch the first row
$row = $query->fetch(PDO::FETCH_ASSOC);

// If no results are found, echo a message and stop
if ($row == false){
    echo "Tabella Vuota";
    exit;
}

// Print the titles using the first line
print_titles($row);
// Iterate over the results and print each one in a line
while ($row != false) {
    // Print the line
  echo implode(array_values($row), ",") . "\n";
    // Fetch the next line
  $row = $query->fetch(PDO::FETCH_ASSOC);
}

// Prints the column names
function print_titles($row){
    echo implode(array_keys($row), ",") . "\n";
}