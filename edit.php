<?php
@include 'config.php';

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

$id = $_GET['id'];

$query = "SELECT * FROM furniture_form WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$userData = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];

    if (!empty($password)) {
        // Hash the password if it is provided
        $hashedPassword = hashPassword($password);
        $updateQuery = "UPDATE furniture_form SET name = '$name', email = '$email', user_type = '$user_type', password = '$hashedPassword' WHERE id = '$id'";
    } else {
        // Update without changing the password
        $updateQuery = "UPDATE furniture_form SET name = '$name', email = '$email', user_type = '$user_type' WHERE id = '$id'";
    }

    mysqli_query($conn, $updateQuery);

    header('location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Edit User</h3>
            <input type="text" name="name" value="<?php echo htmlspecialchars($userData['name']); ?>" required placeholder="Enter your name">
            <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required placeholder="Enter your email">
            <input type="password" name="password" placeholder="Enter new password">
            <select name="user_type">
                <option value="user" <?php echo ($userData['user_type'] == 'user') ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo ($userData['user_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
            <input type="submit" name="submit" value="Update User" class="form-btn">
        </form>
    </div>
</body>
</html>
