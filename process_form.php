<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the filename from the form
    $filename = $_POST["filename"];

    // Check if the filename is provided
    if (!empty($filename)) {
        // Set the directory to save the files
        $directory = 'https://hvsimage.com/HVS6DVR/ExampleUniversity/ExampleUser/ivsimage_form_live_testing/text_files/';

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
            // Send a success response
            echo "File successfully saved on the server";
        } else {
            // Send an error response
            http_response_code(500);
            echo "Error: Failed to save file.";
        }
    } else {
        // Send an error response
        http_response_code(400);
        echo "Error: Please provide a filename.";
    }
} else {
    // Send an error response
    http_response_code(400);
    echo "Error: Form submission error.";
}
