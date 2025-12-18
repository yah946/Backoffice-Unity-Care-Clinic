<?php
session_start();
include 'config.php';
if(!isset($_SESSION['USER-ID'])){
    header("Location: login.php");
    die();
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
    <script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <title>Backoffice Unity CC</title>
</head>
<body>
    <aside class="menu">
        <ul>
            <li class="menu-home--margin"><a href="index.php">
                <i class="fa-solid fa-house"></i>
                <p>Home</p>
            </a></li>
            <li><a href="patient.php">
                <i class="fa-solid fa-bed-pulse"></i>
                <p>Patients</p>
            </a></li>
            <li><a href="departement.php">
                <i class="fa-regular fa-building"></i>
                <p>Departments</p>
            </a></li>
            <li><a href="doctor.php">
                <i class="fa-solid fa-user-doctor"></i>
                <p>Doctors</p>
            </a></li>
            <li class="menu-logout"><a href="logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <p>Log Out</p>
            </a></li>
        </ul>
    </aside>
    <main class="main">
        <nav class="main-lang">
            <a class="main-links--after" href="#">English</a>
            <a class="main-links--after" href="#">Spanish</a>
            <a href="#">French</a>
        </nav>
        <section class="statistic">
            <?php include 'config.php'?>
            <div class="statistic-card">
                <h3 class="statistic-paragraph">Doctors</h3>
                <?php print_r(mysqli_num_rows(mysqli_query($conn,'select * from doctor')))?>
            </div>
            <div class="statistic-card">
                <h3 class="statistic-paragraph">Patients</h3>
                <?php print_r(mysqli_num_rows(mysqli_query($conn,'select * from patient')))?>
            </div>
            <div class="statistic-card">
                <h3 class="statistic-paragraph">Departements</h3>
                <?php print_r(mysqli_num_rows(mysqli_query($conn,'select * from departement')))?>
            </div>
        </section>
    </main>
</body>
</html>