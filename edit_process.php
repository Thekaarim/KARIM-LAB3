<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $line = urldecode($_POST['line']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $room_number = $_POST['room_number'];

    // Validate if all required fields are filled
    if (empty($name) || empty($email) || empty($room_number)) {
        echo "<p class='error-message'>All fields are required.</p>";
    } else {
        // Check if password and confirm password match
        if (!empty($password) && $password !== $confirm_password) {
            echo "<p class='error-message'>Password and Confirm Password do not match.</p>";
        } else {
            // Read all lines from users.txt
            $users = file("users.txt");
            $updated_users = [];

            // Loop through each line and update the user data if the line matches the one being edited
            foreach ($users as $user) {
                if (trim($user) === $line) {
                    $userData = explode(",", trim($user));
                    $userData[0] = $name;
                    $userData[1] = $email;
                    $userData[3] = $room_number;

                    // Update the password only if it is provided
                    if (!empty($password)) {
                        $userData[2] = $password;
                    }

                    $updated_users[] = implode(",", $userData) . PHP_EOL;
                } else {
                    $updated_users[] = $user;
                }
            }

            // Save the updated users data to users.txt
            file_put_contents("users.txt", $updated_users);

            echo "<p class='success-message'>Changes saved successfully!</p>";
        }
    }
}
?>
