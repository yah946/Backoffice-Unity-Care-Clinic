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
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <title>Backoffice Unity CC</title>
</head>
<body>
    <aside class="menu">
        <ul>
            <li class="menu-home--margin"><a class="active" href="index.php">
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
        <div class="main-btn-container">
            <button class="main-btn"><a href="insert_doctors.php">New Doctor</a></button>
        </div>
        <div class="main-table--flex">
            <table width="90%">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Specialization</th>
                <th>Tel</th>
                <th>Email</th>
                <th>Update</th>
                <th>Delete</th>
            </thead>
            <tbody>
                <?php
                    include('config.php');
                    $start = 0;
                    if(isset($_GET['page-nr'])){
                        $page = $_GET['page-nr'] - 1;
                        $start = $page * 7;
                    }
                    $sql = "select * from doctor order by id limit 7 offset $start";
                    $select_limit = mysqli_query($conn,$sql);
                    $pages=ceil(mysqli_num_rows(mysqli_query($conn,"select * from doctor"))/7);
                    while($row = mysqli_fetch_assoc($select_limit)){
                        echo "
                        <tr>
                            <td>$row[firstName]</td>
                            <td>$row[lastName]</td>
                            <td>$row[specialization]</td>
                            <td>$row[phoneNum]</td>
                            <td>$row[email]</td>
                            <td>
                                <a class='action-button update-button' href='insert_doctors.php?id=$row[id]'>update</a>
                            </td>
                            <td>
                                <a class='action-button' href='delete.php?id=$row[id]'>delete</a>
                            </td>
                        </tr>
                        ";
                    }
                ?>
            <tbody>
        </div>
    </table>
    <div class="pagination">
        <a href="?page-nr=1">&laquo;</a>
        <?php
        for($i=1 ;$i<=$pages;$i++){?>
        <a href="?page-nr=<?php echo $i ?>"><?php echo $i ?></a>
        <?php
        }
        ?>
        <a href="?page-nr=<?php echo $pages;?>">&raquo;</a>
    </div>
    </main>
</body>
</html>