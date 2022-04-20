<?php

$host="localhost";
$user="root";
$password='';
$dbName="traning_company";
$conn=mysqli_connect($host , $user , $password, $dbName);

################ Create ##################
if(isset($_POST['send'])){
$course=$_POST['courseName'];
$cost=$_POST['courseCost'];
$insert= "INSERT INTO `courses` VALUES(null ,'$course',$cost)";
$i=mysqli_query($conn,$insert);

if($i){
    echo"<div class='alert alert-info mx-auto w-50' >
    Insert Done To DataBase
    </div>";
}else{
    echo"<div class='alert alert-danger mx-auto w-50' >
    Insert not done To DataBase
    </div>";
}
}
################ Read ##################
$select="SELECT * FROM `courses`";
$s=mysqli_query($conn,$select);

################ Delete ##################
if(isset($_GET['delete'])){
    $id= $_GET['delete'];
    $delete="DELETE FROM `courses` WHERE id=$id";
    $d=mysqli_query($conn,$delete);
   header("location:index.php");
}

################ Update ##################
$name='';
$cost='';
$update=false;
if(isset($_GET['edit'])){
    $update=true;
$id=$_GET['edit'];
$select="SELECT * FROM `courses`WHERE id=$id";
$ss=mysqli_query($conn,$select);
$data=mysqli_fetch_assoc($ss);
$name=$data['name'];
$cost=$data['cost'];
if(isset($_POST['update'])){
    $course=$_POST['courseName'];
$cost=$_POST['courseCost'];
$update="UPDATE `courses` SET `name`='$course' , cost=$cost WHERE id =$id";
$u=mysqli_query($conn,$update);
header("location:index.php");
}



}




?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<style>
    body{
        background-color:black;
        color:white;
    }
    .card{
        background-color:#333;
        color:white;
    }
</style>
</head>
<body>


<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="">Course Name</label>
                    <input type="text" value="<?php echo $name  ?>" name="courseName" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Course Cost</label>
                    <input type="text" value="<?php echo $cost  ?>"  name="courseCost" class="form-control">
                </div>
                <?php if($update){?>
                    <button class="btn btn-primary btn-block" name="update">update Data</button>
                    <?php } else{ ?>
<button class="btn btn-info btn-block" name="send">Send Data</button>
                 <?php   } ?>

                
                

                

            </form>
        </div>
    </div>
</div>

<div class="container col-md-6 mt-4">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Cost</th>
                    <th>Action</th>
                </tr>
                <?php foreach($s as $data){  ?>
                <tr>
                    <td><?php echo $data ['id'] ?> </td>
                    <td><?php echo $data ['name'] ?> </td>
                    <td><?php echo $data ['cost'] ?> </td>
                    <td> <a onclick="return confirm('Are You Sure?!')" href=" index.php?delete=<?php echo $data ['id'] ?>" class="btn btn-danger" >Delete</a ></td>
                    <td> <a  href=" index.php?edit=<?php echo $data ['id'] ?>" class="btn btn-info" >edit</a ></td>



                </tr>
                <?php } ?>
            </table>
</div>
</div>
</div>
    
</body>
</html>