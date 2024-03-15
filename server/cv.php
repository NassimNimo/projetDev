<?php

require_once("./DB_class.php");

$DB = new DB_class();

// Save the blob data to a temporary file
$tempPdfFile = $DB->selectCVPath(51);

// Now you can proceed with the Python script execution using the temporary PDF file
$command = 'python ./py/CV.py ' . escapeshellarg($tempPdfFile);
exec($command, $output, $result);

if ($result === 0) {
    foreach ($output as $line) {
        echo $line . "<br>";
    }
} else {
    // Output detailed error message
    echo "Failed to execute Python script: $result<br>";
    echo "Command: $command<br>";
    echo "Error output:<br>";
    foreach ($output as $line) {
        echo $line . "<br>";
    }
}
