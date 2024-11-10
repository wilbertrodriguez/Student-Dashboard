<?php
// Include the database connection file
include('../includes/header.php');
include('../includes/sdDB.php');

// Function to get listings from the database
function getListings($mysqli) {
    $sql = "SELECT idx, name, description, created, created_at FROM listing";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return null;
    }
}

// Fetch listings
$listings = getListings($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Listings</title>
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Assuming you have a style.css file -->
</head>
<body>

    <h1>View Listings</h1>

    <?php if ($listings): ?>
        <table>
            <thead>
                <tr>
                    <th>Listing Name</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $listings->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['created']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td>
                            <a href="view_listing_items.php?listing_id=<?php echo $row['idx']; ?>">View Items</a> |
                            <a href="rename_listing.php?listing_id=<?php echo $row['idx']; ?>">Rename</a> |
                            <a href="delete_listing.php?listing_id=<?php echo $row['idx']; ?>" onclick="return confirm('Are you sure you want to delete this listing?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No listings available.</p>
    <?php endif; ?>

</body>
</html>
