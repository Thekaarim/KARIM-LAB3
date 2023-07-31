<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['line'])) {
    $lineToDelete = urldecode($_GET['line']);
    $users = file("users.txt");

    // Remove the specified line from the array
    $updatedUsers = array_filter($users, function ($user) use ($lineToDelete) {
        return $user !== $lineToDelete;
    });

    // Save the updated array back to the file
    file_put_contents("users.txt", implode("", $updatedUsers));

    // Redirect back to the dashboard after deleting
    header("Location: dashboard.php");
    exit();
}
?>
