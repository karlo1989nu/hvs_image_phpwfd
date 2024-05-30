<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the filename from the form
    $filename = $_POST["filename"];

    // Check if the filename is provided
    if (!empty($filename)) {
        // Set the directory to save the files (local directory on the server)
        $directory = './text_files/';

        // Ensure the directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $filepath = $directory . $filename . ".vrScript";
        $content = "";

        // Get the number of trials to avoid comma bulking
        $numberOfTrials = count($_POST["TRIAL_NAME"]);

        // Define the external file path 
        $externalFile = "./fixed.txt";

        // Read content from the external file
        $externalContent = "";
        if (file_exists($externalFile)) {
            $externalContent = file_get_contents($externalFile);
        } else {
            echo "External file not found.";
            exit;
        }

        // Loop through each trial and construct the content
        for ($i = 0; $i < $numberOfTrials; $i++) {
            foreach ($_POST as $key => $value) {
                if ($key !== 'filename') {
                    if (is_array($value)) {
                        $currentValue = $value[$i];
                    } else {
                        $currentValue = $value;
                    }
                    $content .= $key . " " . $currentValue . "\n";
                }
            }

            // Append the external file content before "NEXT_TEST"
            if (!empty($externalContent)) {
                $content .= $externalContent . "\n";
            }

            $content .= "\nNEXT_TEST\n";
        }

        // Save the content to the file and inform the user
        if (file_put_contents($filepath, $content) !== false) {
            echo "File successfully saved on the server.";
        } else {
            echo "Failed to save file.";
        }
    } else {
        echo "Please provide a filename.";
    }
} else {
    echo "Form submission error.";
}
