<?php

require_once "db.php";

$item_name = $_POST['item_name'];
$description = $_POST['description'];
$item_type = $_POST['item_type'];
$location = $_POST['location'];
$date_reported = $_POST['date_reported'];

$image_name = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];

$extension = pathinfo($image_name, PATHINFO_EXTENSION);

$new_image_name = uniqid("item_") . "." . $extension;

$upload_path = "../uploads/items/" . $new_image_name;

if (move_uploaded_file($image_tmp, $upload_path)) {

    $sql = "INSERT INTO items
            (item_name, description, item_type, location, date_reported, image)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssss",
        $item_name,
        $description,
        $item_type,
        $location,
        $date_reported,
        $new_image_name
    );

    if ($stmt->execute()) {

        echo "Item reported successfully!";

    } else {

        echo "Error saving item: " . $stmt->error;

    }

    $stmt->close();

} else {

    echo "Failed to upload item photo.";

}

$conn->close();

?>