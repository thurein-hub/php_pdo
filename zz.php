$stmt=$pdo->prepare("SELECT * FROM post WHERE id=".$_GET['id']);
$stmt->execute();
$result=$stmt->fetchAll();
if(!empty($_POST)){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $created_at=$_POST['created_at'];
    $id=$_POST['id'];
   //if for test file
   print_r($_FILES);
    if($_FILES){
    $targetFile='images/'.($_FILES['image']['name']);

    $image=$_FILES['image']['name'];

    $imageType=pathinfo($targetFile,PATHINFO_EXTENSION);

    //if for test image
    if($imageType!='png' && $imageType!='jpg' && $imageType!='jpeg'){
    echo"<script>alert('Image must be jpg, png or jpeg!');window.location.href='index.php'; </script>";
    exit();
    }
    else{
    move_uploaded_file($_FILES['image']['tmp_name'],$targetFile);

    $stmt=$pdo->prepare("UPDATE post set title='$title', description='$description',image='$image', created_at='$created_at' WHERE id='$id'");
    
    $result=$stmt->execute();
    if($result){
        echo"<script>alert('Update is successfully!');
        window.location.href='index.php';
        </script>";
        }
    }///end for test image

    }
    else{
        $stmt=$pdo->prepare("UPDATE post set title='$title', description='$description', created_at='$created_at' WHERE id='$id'");
        $result=$stmt->execute();
        if($result){
            echo"<script>alert('Update is successfully!');
            window.location.href='index.php';
            </script>";
        }
    }//end for test file

}