<?php
session_start();
include "config.php";
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $passwd = $_POST['paaswd'];
    $query = mysqli_query($conn,"select * from login where email=\"$email\" And passwd =\"$passwd\"");
    if(mysqli_num_rows($query)>0){
        $_SESSION['USER-ID']=mysqli_fetch_assoc($query)['id'];
        header("Location: index.php");
        exit;
    }else{
        $error = 'Plaese Enter Valid Details';
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
    <h1 class="title">Log in page</h1>
    <form
    class="form"
    action=""
    method="POST"
    >
        <input id="id" type="hidden" value="<?= $id ?? '' ?>">
        <input placeholder="Email" type="email" name="email" value="<?= $dname ?? '' ?>">
        <input placeholder="Password" type="password" name="paaswd" value="<?= $location ?? '' ?>">
        <button class="form_button" type="submit" name="login" value="login">Log In</button>
        <?php if(!empty($error)){
            echo $error;
        } ?>

    </form>
</body>
</html>