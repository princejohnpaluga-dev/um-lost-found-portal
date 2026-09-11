<?php

require_once "db.php";

$sql = "SELECT * FROM items
        WHERE item_type = 'found'
        AND status = 'active'
        ORDER BY created_at DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found Items - UM Lost & Found Portal</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
        }

        header {
            background: #6a2020;
            color: white;
            padding: 25px;
            text-align: center;
        }

        nav {
            background: white;
            padding: 15px;
            text-align: center;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #6a2020;
            font-weight: bold;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 30px auto;
        }

        .item {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .item h3 {
            color: #123b6d;
        }

        .report-button {
            display: inline-block;
            background: #6d1212;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .header-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.header-content img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid white;
}
    </style>
</head>

<body>

<header>
    <div class="header-content">

        <img
            src="../images/logo.png"
            alt="UM Lost & Found Logo"
        >

        <div>
            <h1>UM Lost & Found Portal</h1>
            <p>University of Mindanao Lost & Found System</p>
        </div>

    </div>
</header>

<nav>
    <a href="../index.html">Home</a>
    <a href="lost.php">Lost Items</a>
    <a href="found.php">Found Items</a>
    <a href="../report.html">Report Item</a>
</nav>

<div class="container">

    <h2>Found Items</h2>

    <?php if ($result->num_rows > 0): ?>

        <?php while ($row = $result->fetch_assoc()): ?>

            <div class="item">

            <?php if (!empty($row['image'])): ?>

    <img
        src="../uploads/items/<?php echo htmlspecialchars($row['image']); ?>"
        alt="Item Photo"
        style="width: 200px; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 15px;"
    >

<?php endif; ?>

                <h3>
                    <?php echo htmlspecialchars($row['item_name']); ?>
                </h3>

                <p>
                    <strong>Description:</strong>
                    <?php echo htmlspecialchars($row['description']); ?>
                </p>

                <p>
                    <strong>Location:</strong>
                    <?php echo htmlspecialchars($row['location']); ?>
                </p>

                <p>
                    <strong>Date Reported:</strong>
                    <?php echo htmlspecialchars($row['date_reported']); ?>
                </p>

            </div>

        <?php endwhile; ?>

    <?php else: ?>

        <div class="item">
            <p>No found items reported yet.</p>
        </div>

    <?php endif; ?>

    <a class="report-button" href="../report.html">
        Report an Item
    </a>

</div>

</body>
</html>

<?php
$conn->close();
?>