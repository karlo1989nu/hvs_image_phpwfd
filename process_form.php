<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the filename from the form
    $filename = $_POST["filename"];

    // Check if the filename is provided
    if (!empty($filename)) {
        // Set the directory where you want to save the files
        $directory = 'C:\xampp\htdocs\hvs_image_phpwfd\text_files\\';

        // Generate the file path
        $filepath = $directory . $filename . ".txt";

        // Get the content from the form
        $content = "Experimental Setup\n\n";

        // Loop through each trial and add its content to the file
        foreach ($_POST["trials"] as $trial) {
            $content .= $trial["header"] . "\n";
            foreach ($trial["data"] as $label => $value) {
                $content .= $label . ": " . $value . "\n";
            }
            $content .= "\n";
        }

        // Save the content to the file
        file_put_contents($filepath, $content);

        // Output success message
        echo "File saved successfully.";
    } else {
        // Output error message if filename is not provided
        echo "Please provide a filename.";
    }
} else {
    // Output error message if form is not submitted
    echo "Form submission error.";
}
?>