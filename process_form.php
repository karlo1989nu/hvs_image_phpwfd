<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the filename from the form
    $filename = $_POST["filename"];

    // Check if the filename is provided
    if (!empty($filename)) {
        // Set the local directory to save the files
        $localDirectory = '/ExampleUniversity/ExampleUser/ivsimage_form/';

        // Ensure the local directory exists
        if (!is_dir($localDirectory)) {
            mkdir($localDirectory, 0777, true);
        }

        // Generate the local file path
        $localFilePath = $localDirectory . $filename . ".vrScript";

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

        // Save the content to the local file
        if (file_put_contents($localFilePath, $content) !== false) {
            // URL of the remote server endpoint that handles file uploads
            $uploadUrl = 'https://hvsimage.com/HVS6DVR/';

            // Initialize cURL session
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $uploadUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'file' => new CURLFile($localFilePath),
                'filename' => $filename // Send filename as a separate field
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects

            // Execute the POST request
            $response = curl_exec($ch);

            // Check for errors
            if ($response === false) {
                error_log('cURL error: ' . curl_error($ch));
                echo 'Failed to upload file.';
            } else {
                echo 'File uploaded successfully. Server response: ' . $response;
            }

            // Close cURL session
            curl_close($ch);

            // Optionally, delete the local file after uploading
            unlink($localFilePath);
        } else {
            echo "Failed to save file locally.";
        }
    } else {
        echo "Please provide a filename.";
    }
} else {
    echo "Form submission error.";
}
?>

===========

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
            echo "File successfully saved on the server as " . basename($filepath) . ".<br>";
            echo '<a href="text_files/' . basename($filepath) . '" download>Click here to download the file</a>';
        } else {
            echo "Error: Failed to save file.";
        }
    } else {
        echo "Error: Please provide a filename.";
    }
} else {
    echo "Error: Form submission error.";
}
?>





========

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the filename from the form
    $filename = $_POST["filename"];

    // Check if the filename is provided
    if (!empty($filename)) {
        // Set the local directory to save the files
        $localDirectory = './text_files/';

        // Ensure the local directory exists
        if (!is_dir($localDirectory)) {
            mkdir($localDirectory, 0777, true);
        }

        // Generate the local file path
        $localFilePath = $localDirectory . $filename . ".txt";

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

        // Save the content to the local file
        if (file_put_contents($localFilePath, $content) !== false) {
            // URL of the remote server endpoint that handles file uploads
            $uploadUrl = '/hvsimage.com/HVS6DVR/';

            // Initialize cURL session
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $uploadUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'file' => new CURLFile($localFilePath),
                'filename' => $filename // Send filename as a separate field
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects

            // Execute the POST request
            $response = curl_exec($ch);

            // Check for errors
            if ($response === false) {
                error_log('cURL error: ' . curl_error($ch));
                echo 'Failed to upload file.';
            } else {
                echo 'File uploaded successfully.';
            }

            // Close cURL session
            curl_close($ch);

            // Optionally, delete the local file after uploading
            unlink($localFilePath);
        } else {
            echo "Failed to save file locally.";
        }
    } else {
        echo "Please provide a filename.";
    }
} else {
    echo "Form submission error.";
}