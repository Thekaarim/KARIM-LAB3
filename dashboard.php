<?php
session_start();

// Check if the user is logged in
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    // Read user data from users.txt
    $users = file("users.txt");
    $user_found = false;

    foreach ($users as $user) {
        $userData = explode(",", trim($user));
        $name = $userData[0];
        $email = $userData[1];
        $password = $userData[2];

        // Validate login data
        if ($email === $login_email && $password === $login_password) {
            $user_found = true;
            break;
        }
    }

    if (!$user_found) {
        echo "Invalid login credentials. Please go back and try again.";
        exit();
    }

    // Set the session variables after successful login
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
} else {
    // If the user is not logged in or accessed the page directly, redirect to the login page
    header("Location: login_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h2 {
    color: #00529b;
}

h3 {
    color: #4CAF50;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f5f5f5;
}

img {
    max-width: 100px;
    max-height: 100px;
}

.delete-btn, .edit-btn, .logout-btn {
    padding: 6px 10px;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    margin-right: 5px;
}

.delete-btn {
    background-color: #dc3545;
}

.edit-btn {
    background-color: #ffc107;
}

.logout-btn {
    background-color: #00529b;
}

.delete-btn:hover, .edit-btn:hover, .logout-btn:hover {
    background
    }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
    <h3>Customer List</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Room No.</th>
            <th>Profile Picture</th>
            <th>Actions</th>
        </tr>
<!-- PHP code to display customer data from users.txt -->
<?php
            $users = file("users.txt");
            foreach ($users as $user) {
                $userData = explode(",", trim($user));
                $name = $userData[0];
                $email = $userData[1];
                $room_number = $userData[3];
                $profile_picture = trim($userData[4]); // Trim the profile picture URL
                $profile_picture_path = "uploads/images/" . basename($profile_picture);
            ?>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $room_number; ?></td>
                    <td>
                        <?php if (file_exists($profile_picture_path)) { ?>
                            <img src="<?php echo $profile_picture_path; ?>" alt="Profile Picture" width="100">
                        <?php } else { ?>
                            <p>No Image Available</p>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="delete.php?line=<?php echo urlencode($user); ?>" class="delete-btn">Delete</a>
                        <a href="edit.php?line=<?php echo urlencode($user); ?>" class="edit-btn">Edit</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </table>
    <br>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html>
