<?php
/*
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set and not empty
    if (isset($_POST["filename"]) && !empty($_POST["filename"]) && isset($_POST["envname"]) && isset($_POST["maxtime"])) {
        // Retrieve form data
        $filename = $_POST["filename"];
        $envnames = $_POST["envname"];
        $maxtimes = $_POST["maxtime"];

        // Content for the first text file containing all input data
        $allContent = "File Name: " . $filename . "\n";
        $allContent .= "Trials:\n";
        for ($i = 0; $i < count($envnames); $i++) {
            $allContent .= "Trial " . ($i + 1) . ":\n";
            $allContent .= "Environment: " . $envnames[$i] . "\n";
            $allContent .= "Maximum Time: " . $maxtimes[$i] . "\n\n";
        }

        // Content for the second text file containing only part of the input data
        $partContent = "File Name: " . $filename . "\n";
        $partContent .= "First Trial:\n";
        $partContent .= "Environment: " . $envnames[0] . "\n";
        $partContent .= "Maximum Time: " . $maxtimes[0] . "\n";

        // Generate and download the first text file
        $allFile = fopen($filename . "_all.txt", "w") or die("Unable to open file!");
        fwrite($allFile, $allContent);
        fclose($allFile);
        header("Content-Disposition: attachment; filename=" . $filename . "_all.txt");
        readfile($filename . "_all.txt");
    } else {
        // Handle missing form fields
        echo "Error: Missing form fields.";
    }
} else {
    // Handle non-POST requests
    echo "Error: Form submission method not allowed.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["filename"]) && !empty($_POST["filename"]) && isset($_POST["envname"]) && isset($_POST["maxtime"])) {
        $filename = $_POST["filename"];
        $envnames = $_POST["envname"];
        $maxtimes = $_POST["maxtime"];

        // Validate input format
        if (!isValidTimeFormat($maxtimes)) {
            echo "Error: Invalid time format.";
            exit;
        }

        // Generate content for all trials
        $allContent = "File Name: " . $filename . "\n";
        $allContent .= "Trials:\n";
        for ($i = 0; $i < count($envnames); $i++) {
            $allContent .= "Trial " . ($i + 1) . ":\n";
            $allContent .= "Environment: " . $envnames[$i] . "\n";
            $allContent .= "Maximum Time: " . $maxtimes[$i] . "\n\n";
        }

        // Specify the directory to save the file
$directory = "C:\xampp\htdocs\hvs_image_phpwfd\text_files" . DIRECTORY_SEPARATOR;

// Write content to file
$allFilePath = $directory . $filename . "_all.txt";
$allFile = fopen($allFilePath, "w");
if ($allFile === false) {
    echo "Error: Unable to open file for writing.";
    exit;
}
fwrite($allFile, $allContent);
fclose($allFile);

echo "File generated successfully at: " . $allFilePath;
    }*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["filename"]) && !empty($_POST["filename"]) && isset($_POST["envname"]) && isset($_POST["maxtime"])) {
        $filename = $_POST["filename"];
        $envnames = $_POST["envname"];
        $maxtimes = $_POST["maxtime"];

        // Validate input format
        if (!isValidTimeFormat($maxtimes)) {
            echo "Error: Invalid time format.";
            exit;
        }

        // Generate content for all trials
        $allContent = "File Name: " . $filename . "\n";
        $allContent .= "Trials:\n";
        for ($i = 0; $i < count($envnames); $i++) {
            $allContent .= "Trial " . ($i + 1) . ":\n";
            $allContent .= "Environment: " . $envnames[$i] . "\n";
            $allContent .= "Maximum Time: " . $maxtimes[$i] . "\n\n";
        }

        // Specify the directory to save the file
        $directory = 'C:\xampp\htdocs\hvs_image_phpwfd\text_files' . DIRECTORY_SEPARATOR;

        // Write content to file
        $allFilePath = $directory . $filename . "_all.txt";
        $allFile = fopen($allFilePath, "w");
        if ($allFile === false) {
            echo "Error: Unable to open file for writing.";
            exit;
        }
        fwrite($allFile, $allContent);
        fclose($allFile);

        echo "File generated successfully at: " . $allFilePath;
        exit;
    } else {
        echo "Error: Missing form fields.";
    }
} else {
    echo "Error: Form submission method not allowed.";
}

function isValidTimeFormat($times)
{
    foreach ($times as $time) {
        if (!preg_match("/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/", $time)) {
            return false;
        }
    }
    return true;
}

?>