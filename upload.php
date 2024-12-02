<?php
if(isset($_POST['submit'])){
    // Set the maximum file size limit (5MB in bytes)
    $maxFileSize = 5 * 1024 * 1024; // 5 MB

    // Get file info
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    // Check if the file is larger than 5MB
    if ($fileSize > $maxFileSize) {
        echo "File is too large. The maximum file size is 5MB.";
    } elseif ($fileError !== 0) {
        echo "There was an error uploading your file.";
    } else {
        // Extract file extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        // Check if the file type is allowed
        if (!in_array($fileExt, $allowed)) {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        } else {
            // Create a unique file name to prevent overwriting
            $fileNewName = uniqid('', true) . '.' . $fileExt;

            // Set file upload directory
            $fileDestination = 'uploads/' . $fileNewName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                echo "File uploaded successfully! <br>";
                echo "File path: " . $fileDestination;
            } else {
                echo "There was an error moving your file.";
            }
        }
    }
}
?>
