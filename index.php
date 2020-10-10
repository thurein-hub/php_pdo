<?php
require'config.php';
session_start();
if(empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
    echo"<script>alert('Please login to continue');
    window.location.href='login.php';
    </script>";
}

$stmt=$pdo->prepare("SELECT * FROM post ORDER BY id DESC");
$stmt->execute();
$result=$stmt->fetchALL();
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
    <h1 class="mb-3">Post Management</h1>
    <table class="table table-bordered">
        <div class="mb-1">
            <a href="add.php" class="btn btn-success">Create News</a>
            <a href="logout.php" class="btn btn-primary" style="float:right">Logout</a>
        </div>
        <thead>
            <tr>
                <td width="10%">Title</td>
                <td width="50%">Description</td>
                <td width="23%">Created At</td>
                <td width="15%">Action</td>
            </tr>
        </thead>

        <tbody>
            
                <?php
                if($result){
                    foreach($result as $value){
                ?>
                <tr>
                <td><?php echo $value['title']?></td>
                <td><?php echo $value['description']?></td>
                <td><?php echo date('d-m-Y',strtotime($value['created_at'])) ?></td>
                <td>
                <a href="edit.php?id=<?php echo $value['id']?>" class="btn btn-info" style="padding:3px 8px; margin-bottom:2px">Edit</a>
                <a href="delete.php?id=<?php echo $value['id']?>" class="btn btn-danger" style="padding:3px 8px;">Delete</a>
                </td>
                </tr>
                <?php }
                }?>
                
            
        </tbody>
    </table>
    </div>
</div>
    
</body>
</html>