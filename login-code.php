<?php
require 'config/functions.php';

if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email !== '' && $password !== '') {
        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM admins WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            if (!password_verify($password, $hashedPassword)) {
                redirect('login.php', 'Incorrect Password');
            }

            if ($row['is_ban'] == 1) {
                redirect('login.php', 'Your account has been banned. Contact your administrator.');
            }

            // Correct session usage
            $_SESSION['loggedIn'] = true;
            $_SESSION['loggedInUser'] = [
                'user_id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone']
            ];

            redirect('admin/index.php', 'Logged in successfully');
        } else {
            redirect('login.php', 'Incorrect Email Address');
        }
    } else {
        redirect('login.php', 'All fields are mandatory.');
    }
}
?>
