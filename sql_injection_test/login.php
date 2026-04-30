<?php
$conn = mysqli_connect("localhost", "root", "", "test_db");

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();

if(mysqli_num_rows($result) > 0){
    echo "Login berhasil!";
} else {
    echo "Login gagal!";
}
?>