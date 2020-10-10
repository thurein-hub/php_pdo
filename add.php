<?php
require 'config.php';
if(!empty($_POST)){
    
    $targetFile='images/'.($_FILES['image']['name']);
    $imageType=pathinfo($targetFile,PATHINFO_EXTENSION);
    if($imageType=='png' || $imageType=='jpg' || $imageType=='jpeg'){
    move_uploaded_file($_FILES['image']['tmp_name'],$targetFile);
    $title=$_POST['title'];
    $description=$_POST['description'];
    $created_at=$_POST['created_at'];
    $image=$_FILES['image']['name'];
    $stmt=$pdo->prepare("INSERT INTO post(title,description,image,created_at) VALUES(:title,:description,:image,:created_at)");
    $result=$stmt->execute(
        array(':title'=>$title,':description'=>$description,':image'=>$image,':created_at'=>$created_at)
    );
    
    if($result){
        echo"<script>alert('Recorded is added!');
        window.location.href='index.php';
        </script>";
    }
    }else{
        echo"<script>alert('Image must be jpg, png or jpeg!');
        </script>";
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
        <h1>Add Post Info</h1>
        <form action="add.php" method="post" enctype="multipart/form-data">
           
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="8"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control" type="file" name="image" id="title">
            </div>
            <div class="form-group">
                <label for="created_at">Created At</label>
                <input class="form-control" type="date" name="created_at" id="created_at">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="" value="ADD">
                <a href="index.php" class="btn btn-warning">Back</a>
            </div>
        </form>
       
    </div>
</div>
    
</body>
</html>