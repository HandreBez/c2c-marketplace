<?php
include "layout/header.php";
include "db.php";

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password)
VALUES ('$name','$email','$password')";

if($conn->query($sql) === TRUE){
    echo "Account created successfully";
} else {
    echo "Error: " . $conn->error;
}

}
?>

<h2>Create Account</h2>

<form method="POST">

Name:<br>
<input type="text" name="name" required><br><br>

Email:<br>
<input type="email" name="email" required><br><br>

Password:<br>
<input type="password" name="password" required><br><br>

<button type="submit" name="register">Register</button>

</form>

<?php include "layout/footer.php"; ?>
