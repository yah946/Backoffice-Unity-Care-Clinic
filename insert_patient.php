<?php
$location = explode('/',$_SERVER['HTTP_REFERER']);
$location = explode('/',$_SERVER['HTTP_REFERER'])[3];
include "config.php";
$error = '';
$suc = '';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $f_name = filter_input(INPUT_POST,'firstName',FILTER_SANITIZE_SPECIAL_CHARS);
    $l_name = filter_input( INPUT_POST,'lastName',FILTER_SANITIZE_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST,'gender',FILTER_SANITIZE_SPECIAL_CHARS);
    $birth = filter_input(INPUT_POST,'birth',FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    // $tel = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_NUMBER_INT);
    $tel = $_POST['phone'];
    $address = filter_input(INPUT_POST,'address',FILTER_SANITIZE_SPECIAL_CHARS);
    if(isset($_GET['id'])){
        if($f_name && $l_name && $email && $gender && $birth && $tel && $address){
            $id = $_GET['id'];
            $query = "update patient set firstName=?, lastName=?,gender=?,dateOfBirth=?,phoneNum=?, email=?, address=? where id = ?";
            $stm = mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stm,'sssssssi',$f_name,$l_name,$gender,$birth,$tel,$email,$address,$id);
            mysqli_stmt_execute($stm);
            $suc = "Data has been changed";
            echo "<script>location.href = 'patient.php';</script>";
        }else{
            $error = "Invalid Input";
        }
    }else{
        if($f_name && $l_name && $email && $gender && $birth && $tel && $address){
            $query = "insert into patient (firstName, lastName, gender, dateOfBirth, phoneNum, email, address) values(?,?,?,?,?,?,?)";
            $stm = mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stm,'sssssss',$f_name,$l_name,$gender,$birth,$tel,$email,$address);
            mysqli_stmt_execute($stm);
            $suc = "Data has been saved";
            // echo "<script>location.href = 'patient.php';</script>";
            header('location:patient.php');
        }else{
            $error = "Invalid Input";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="dashboard for managing patients, departments, doctors">
    <meta name="keywords" content="patients, doctors, departments,appointment">
    <meta name="author" content="Moha Sr">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Insert a Patient</title>
</head>
<body>
    <h1 class="title">Add A Patient</h1>
    <?php
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = (int) $_GET['id'];
            $query = "select * from patient where id=$id";
            $select_where = mysqli_query($conn,$query);
            $tb = mysqli_fetch_assoc($select_where);
            $fname = $tb['firstName'];
            $lname = $tb['lastName'];
            $gender = $tb['gender'];
            $birth = $tb['dateOfBirth'];
            $tel = $tb['dateOfBirth'];
            $Email = $tb['email'];
            $address = $tb['address'];
        }
    ?>
    <form
    class="form"
    action=""
    method="POST"
    >
        <input id="id" type="hidden" value="<?= $id ?? '' ?>">
        <label for="firstName">First Name:</label>
        <input id="firstName" type="text" name="firstName" value="<?= $fname ?? '' ?>">
        <label for="lastName">Last Name:</label>
        <input id="lastName" type="text" name="lastName" value="<?= $lname ?? '' ?>">
        <label for="lastName">Gender:</label>
        <input id="lastName" type="text" name="gender" value="<?= $gender ?? '' ?>">
        <label for="lastName">Date Of Birth:</label>
        <input id="lastName" type="text" name="birth" value="<?= $birth ?? '' ?>">
        <label for="lastName">Tel:</label>
        <input id="lastName" type="text" name="phone" value="<?= $tel ?? '' ?>">
        <label for="email">Email:</label>
        <input id="email" type="email" name="email" value="<?= $Email ?? '' ?>">
        <label for="lastName">Address:</label>
        <input id="lastName" type="text" name="address" value="<?= $address ?? '' ?>">

        <button class="btn" type="submit" name="submit">
            <?php
            if(isset($_GET['id'])){
                echo "Update";
            }else{
                echo "Add a Student";
            }
            ?>
        </button>

        <?php
        if(!empty($suc)){
            echo "<span>$suc</span>";
        }else if(!empty($error)){
            echo "<span1>$error</span1>";
        }
        ?>

    </form>
</body>
</html>