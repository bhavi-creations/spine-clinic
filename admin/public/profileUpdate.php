<?php
session_start();
include '../../db.connection/db.php'; // Ensure this path is correct and the file sets $pdo

// Check if the user ID is set in the session
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not authenticated
    exit;
}

$id = $_SESSION['user_id'];
$first_name = $_POST['username'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];

try {
    if (!empty($password)) {
        $password = md5($password);
        $sql = "UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, password=:password WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':password' => $password,
            ':id' => $id
        ]);
    } else {
        $sql = "UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    if ($stmt->rowCount() > 0) {
        echo "Record updated successfully";
        header('Location: profile.php');
    } else {
        echo "No changes made to the record.";
        header('Location: profile.php');
    }
} catch (PDOException $e) {
    echo "Error updating record: " . $e->getMessage();
}
?>
