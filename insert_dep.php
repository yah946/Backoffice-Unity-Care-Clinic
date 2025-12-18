<?php
include "config.php";
$error = '';
$suc = '';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $d_name = filter_input(INPUT_POST,'depName',FILTER_SANITIZE_SPECIAL_CHARS);
    $location = filter_input( INPUT_POST,'location',FILTER_SANITIZE_SPECIAL_CHARS);
    if(isset($_GET['id'])){
        if($d_name && $location){
            $id = $_GET['id'];
            $query = "update departement set depName=?, location=? where id = ?";
            $stm = mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stm,'ssi',$d_name,$location,$id);
            mysqli_stmt_execute($stm);
            $suc = "Data has been changed";
            echo "<script>location.href = 'departement.php';</script>";
        }else{
            $error = "Invalid Input";
        }
    }else{
        if($d_name && $location){
            $query = "insert into departement (departementName, location) values(?,?)";
            $stm = mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stm,'ss', $d_name,$location);
            mysqli_stmt_execute($stm);
            $suc = "Data has been saved";
            header('location:departement.php');
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
    <meta name="description" content="dashboard for managing departements, departments, doctors">
    <meta name="keywords" content="departements, doctors, departments,appointment">
    <meta name="author" content="Moha Sr">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Insert a departement</title>
</head>
<body class="insert">
    <h1 class="title">Add A Departments</h1>
    <?php
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = (int) $_GET['id'];
            $query = "select * from departement where id=$id";
            $select_where = mysqli_query($conn,$query);
            $tb = mysqli_fetch_assoc($select_where);
            $dname = $tb['departementName'];
            $location = $tb['location'];
        }
    ?>
    <form
    class="form"
    action=""
    method="POST"
    >
        <input id="id" type="hidden" value="<?= $id ?? '' ?>">
        <input placeholder="Departement Name" type="text" name="depName" value="<?= $dname ?? '' ?>">
        <input placeholder="Location" type="text" name="location" value="<?= $location ?? '' ?>">
        <button class="form_button" type="submit" name="submit">
            <?php
            if(isset($_GET['id'])){
                echo "Update";
            }else{
                echo "Add a Departement";
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