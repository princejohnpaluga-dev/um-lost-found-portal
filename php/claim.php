<?php

require_once "db.php";

$item_id = $_POST['item_id'];
$claimant_name = $_POST['claimant_name'];
$contact = $_POST['contact'];
$reason = $_POST['reason'];

$photo_name = $_FILES['proof_photo']['name'];
$photo_tmp = $_FILES['proof_photo']['tmp_name'];

$extension = pathinfo($photo_name, PATHINFO_EXTENSION);

$new_photo_name = uniqid("claim_") . "." . $extension;

$upload_path = "../uploads/claims/" . $new_photo_name;

if (move_uploaded_file($photo_tmp, $upload_path)) {

    $sql = "INSERT INTO claims
            (item_id, claimant_name, contact, reason, proof_photo)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "issss",
        $item_id,
        $claimant_name,
        $contact,
        $reason,
        $new_photo_name
    );

    if ($stmt->execute()) {

        echo "Claim submitted successfully!";

    } else {

        echo "Error saving claim: " . $stmt->error;

    }

    $stmt->close();

} else {

    echo "Failed to upload proof photo.";

}

$conn->close();

?>