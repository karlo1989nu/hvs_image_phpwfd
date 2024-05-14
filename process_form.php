<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the filename from the form
    $filename = $_POST["filename"];

    // Check if the filename is provided
    if (!empty($filename)) {
        // Set the directory to save the files
        $directory = 'C:/xampp/htdocs/hvs_image_phpwfd/text_files/';

        // Generate the file path
        $filepath = $directory . $filename . ".txt";

        // Get the content from the form
        $content = "Experimental Setup\n\n";

        // Loop through each input group to retrieve data
        foreach ($_POST as $key => $value) {
            // Skip filename field
            if ($key !== 'filename') {
                // Convert array to a string
                if (is_array($value)) {
                    $value = implode(', ', $value);
                }
                // Format data
                $content .= $key . ": " . $value . "\n";
            }
        }

        // Save the content to the file
        file_put_contents($filepath, $content);

        // Force download the file
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Please provide a filename.";
    }
} else {
    echo "Form submission error.";
}


