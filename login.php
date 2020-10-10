<?php
require 'config.php';
session_start();

if(!empty($_POST)){
    $email=$_POST['email'];
    $password=$_POST['password'];
    //query prepare
    $sql="SELECT * FROM users WHERE email = :email";
    $stmt=$pdo->prepare($sql);

    //bind statament
    $stmt->bindValue(':email',$email);
    //execute statement
    $stmt->execute();

    $user= $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(empty($user)){
        echo"<script>alert('Incorrect credentials, Try again!')</script>";
    }else{
        $validPassword=password_verify($password,$user['password']);
        if($validPassword){
            $_SESSION['user_id']=$user['id'];
            $_SESSION['logged_in']=time();
            header('location: index.php');
            exit();
        }else{
            echo"<script>alert('Incorrect credentials, Try again!')</script>";
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
        <h1>Login</h1>
        <form action="login.php" method="post">
           
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="" value="Login">
                <a href="register.php">Register</a>
            </div>
        </form>
       
    </div>
</div>
    
</body>
</html>