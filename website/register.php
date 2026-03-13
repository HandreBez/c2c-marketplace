<?php
include "layout/header.php";
include "db.php";

if(isset($_POST['register'])){

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)");

$role = "user";

$stmt->bind_param("ssss",$name,$email,$password,$role);

if($stmt->execute()){

echo "<p>Account created successfully.</p>";

}else{

echo "<p>Error creating account.</p>";

}

}
?>

<h2>Register</h2>

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