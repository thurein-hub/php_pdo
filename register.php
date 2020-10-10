<?php
require 'config.php';
if(!empty($_POST)){
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
if($username== '' || $email=='' || $password==''){
    echo"<script>alert('Fill all of input')</script>";
}else{
    //query prepare statement
    $sql="SELECT COUNT(email) As num FROM users WHERE email = :email";
    $stmt =$pdo->prepare($sql);

    //bind statement
    $stmt->bindValue(':email',$email);

    //execute statement
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
   

    if($row['num']>0){
    echo"<script>alert('This email already exist! Try agin!')</script>";
    }else{
        $passwordHash=password_hash($password,PASSWORD_BCRYPT);
        //query prepare
        $sql="INSERT INTO users(name,email,password) VALUES(:username,:email,:password)";
        $stmt=$pdo->prepare($sql);
        //bind statement
        $stmt->bindValue(':username',$username);
        $stmt->bindValue(':email',$email);
        $stmt->bindValue(':password',$passwordHash);
        //execute statement
        $result=$stmt->execute();
        if($result){
            echo"Thanks for your registration!".'<a href="login.php">Login</a>';
        }

    }


}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
    <div class="card-body">
        <h1>Register</h1>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Name</label>
                <input class="form-control" type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="" value="Register">
                <a href="login.php">Login</a>
            </div>
        </form>
       
    </div>
</div>
    
</body>
</html>