<?php
require 'config.php';
if (!empty($_POST)) {

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $created_at = $_POST['created_at'];
    $id = $_GET['id'];
  
    
      $targetFile = 'images/'.($_FILES['image']['name']);
      $imageName = $_FILES['image']['name'];
      $imageType = pathinfo($targetFile,PATHINFO_EXTENSION);
  if($_FILES['image']['name']){
      if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
        echo "<script>alert('Image must be png or jpg,jpeg');</script>";
        
      }else{
        move_uploaded_file($_FILES['image']['tmp_name'],$targetFile);
  
        $pdo_statement = $pdo->prepare("UPDATE post set title='$title', description='$desc',image='$imageName',
                        created_at='$created_at' WHERE id = '$id'");
  
        $result = $pdo_statement->execute();
        
      }
    }else{
      $pdo_statement = $pdo->prepare("UPDATE post set title='$title', description='$desc',
                      created_at='$created_at' WHERE id = '$id'");
  
      $result = $pdo_statement->execute();
      if ($result) {
        echo "<script>alert('record is updated');window.location.href='index.php';</script>";
      }
    }
  
   
  }
  
  
  $pdo_statement = $pdo->prepare("SELECT * FROM post WHERE id=".$_GET['id']);
  $pdo_statement->execute();
  
  $result = $pdo_statement->fetchAll();

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
<?php

?>
<div class="card">
    <div class="card-body">
        <h1>Edit Post</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- <input class="form-control" type="hidden" name="id" id="title" value="<?php echo $result[0]['id']?>"> -->
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $result[0]['title']?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="8"><?php echo $result[0]['description']?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <img src="images/<?php echo $result[0]['image']?>" width="200" height="150"" alt="" style="display:block;margin-bottom:8px">
                <input class="form-control" type="file" name="image" id="title" value="<?php echo $result[0]['image']?>>
            </div>
            <div class="form-group">
                <label for="created_at">Created At</label>
                <input class="form-control" type="date" name="created_at" id="created_at" value="<?php echo date('Y-m-d',strtotime($result[0]['created_at']))?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="" value="Update">
                <a href="index.php" class="btn btn-warning">Back</a>
            </div>
        </form>
       
    </div>
</div>
    
</body>
</html>