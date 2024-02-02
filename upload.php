<!-- upload.php -->

<?php
if (isset($_POST["image"])) {
    $data = $_POST["image"];
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);

    // Create the "img" folder if it doesn't exist
    if (!is_dir('img')) {
        mkdir('img');
    }

    // Generate a unique filename based on timestamp
    $imageName = 'img/' . time() . '.png';

    // Move the uploaded image to the "img" folder
    file_put_contents($imageName, $data);

    echo '<img src="' . $imageName . '" class="img-thumbnail" />';
}
?>
