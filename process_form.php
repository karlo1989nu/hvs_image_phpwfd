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
                $content .= $key . " " . $value . "\n";
            }
        }

        // Append "NEXT_TEST" at the end of the content
        $content .= "\nNEXT_TEST\n";

        // Save the content to the file
        if (file_put_contents($filepath, $content) !== false) {
            // Inform the user that the file was successfully saved
            echo "<script>alert:('File successfully saved on the server');</script>";
        } else {
            echo "<script>alert:('Error: Failed to save file.');</script>";
        }
    } else {
        echo "<script>alert:('Error: Please provide a filename.');</script>";
    }
} else {
    echo "<script>alert:('Error: Form submission error.');</script>";
}