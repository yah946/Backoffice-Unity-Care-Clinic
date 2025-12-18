<?php
include "config.php";
$error = '';
$suc = '';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $f_name = filter_input(INPUT_POST,'firstName',FILTER_SANITIZE_SPECIAL_CHARS);
    $l_name = filter_input( INPUT_POST,'lastName',FILTER_SANITIZE_SPECIAL_CHARS);
    $special = filter_input(INPUT_POST,'specialization',FILTER_SANITIZE_SPECIAL_CHARS);
    $tel = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    if(isset($_GET['id'])){
        if($f_name && $l_name && $email && $special && $tel){
            $id = $_GET['id'];
            $query = "update doctor set firstName=?, lastName=?,specialization=?,phoneNum=?, email=? where id = ?";
            $stm = mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stm,'sssssi',$f_name,$l_name,$special,$tel,$email,$id);
            mysqli_stmt_execute($stm);
            $suc = "Data has been changed";
            echo "<script>location.href = 'doctor.php';</script>";
        }else{
            $error = "Invalid Input";
        }
    }else{
        if($f_name && $l_name && $email && $special && $tel){
            $query = "insert into doctor (firstName, lastName, specialization, phoneNum, email) values(?,?,?,?,?)";
            $stm = mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stm,'sssss',$f_name,$l_name,$special,$tel,$email);
            mysqli_stmt_execute($stm);
            $suc = "Data has been saved";
            // echo "<script>location.href = 'patient.php';</script>";
            header('location:doctor.php');
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
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Insert a Doctor</title>
</head>
<body class="insert">
    <h1 class="title">Add A Doctor</h1>
    <?php
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = (int) $_GET['id'];
            $query = "select * from doctor where id=$id";
            $select_where = mysqli_query($conn,$query);
            $tb = mysqli_fetch_assoc($select_where);
            $fname = $tb['firstName'];
            $lname = $tb['lastName'];
            $special = $tb['specialization'];
            $tel = $tb['phoneNum'];
            $Email = $tb['email'];
        }
    ?>
    <form
    class="form"
    action=""
    method="POST"
    >
        <input id="id" type="hidden" value="<?= $id ?? '' ?>">
        <input placeholder="First Name" type="text" name="firstName" value="<?= $fname ?? '' ?>">
        <input placeholder="Last Name" type="text" name="lastName" value="<?= $lname ?? '' ?>">
        <input placeholder="Specialization" type="text" name="specialization" value="<?= $special ?? '' ?>">
        <input placeholder="Tel" type="text" name="phone" value="<?= $tel ?? '' ?>">
        <input placeholder="Email" type="email" name="email" value="<?= $Email ?? '' ?>">

        <select class="js-single-select" name="dep_name">
            <option selected disabled></option>
            <?php
            $sql = "select DISTINCT departementName,location from departement ";
            $select_dep_name = mysqli_query($conn,$sql);
            $arr = mysqli_fetch_all($select_dep_name);
            for($i=0 ; $i<mysqli_num_rows($select_dep_name); $i++){
            ?>
            <option value="<?php echo $arr[$i][0]."(".$arr[$i][1].")"?>"><?php echo $arr[$i][0]."(".$arr[$i][1].")"?></option>
            <?php }?>
        </select>
        <button class="form_button" type="submit" name="submit">
            <?php
            if(isset($_GET['id'])){
                echo "Update";
            }else{
                echo "Add a Doctor";
            }
            ?>
        </button>

    </form>
</body>
</html>