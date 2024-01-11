<?php
require("database.php");

session_start();

if (!isset($_SESSION['User_ID'])) {
    header("location: resignation.php");
    die();
}

$User_ID = $_SESSION['User_ID'];
$User_name = $_SESSION['User_name'];

$check_query = mysqli_query($conn, "SELECT * FROM `resignation` WHERE ID='$User_ID'");
$row = mysqli_fetch_array($check_query);
$User_IDs = $row['ID'];

if (isset($_POST['Task_Title'])) {

    $Task_Title = $_POST['Task_Title'];
    $Task_Description = $_POST['Task_Description'];

    $insert = mysqli_query($conn, "INSERT INTO `todoapp`(`Task_name`, `Task_description`, `User_ID`) VALUES ('$Task_Title','$Task_Description','$User_IDs')");
};


if (isset($_POST['update_Task_Title'])) {
    $useridupdate = $_POST['useridupdate'];
    $update_Task_Title = $_POST['update_Task_Title'];
    $update_Task_Description = $_POST['update_Task_Description'];

    $insert_update = mysqli_query($conn, "UPDATE `todoapp` SET `Task_name`='$update_Task_Title',`Task_description`='$update_Task_Description' WHERE todoapp.ID=$useridupdate");
}

if (isset($_POST['delete_task_id'])) {
    $delete_task_id = $_POST['delete_task_id'];
    $delete_task = $_POST['delete_task'];

    $delete_query = mysqli_query($conn, "DELETE FROM `todoapp` WHERE todoapp.ID=$delete_task_id");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do Web App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Google Font  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Salsa&display=swap');

        body {
            color: #333;
            background-image: url(https://images.unsplash.com/32/Mc8kW4x9Q3aRR3RkP5Im_IMG_4417.jpg?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);
            background-position: center;
            font-family: 'Salsa', cursive;
        }

        .navbar {
            background-color: #333;
        }

        .navbar a {
            color: #ffffff;
        }

        .container {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .todo-list {
            border-radius: 10px;
            padding: 20px;
            /* border-radius: 8px; */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: transparent;
            backdrop-filter: blur(10px);

        }

        /* 
        input,
        textarea,
        table {
            backdrop-filter: blur(10px);
            background-color: transparent !important;
        } */

        .todo-item {
            margin-bottom: 20px;
        }

        .form-control:focus {
            box-shadow: none;
            border: none;
        }

        .form-control {
            border: none;
            /* border-radius: 50px; */
        }

        .user_email {
            color: #F5F5F5;
            align-items: center;
            padding: 5px;

        }

        @media (min-width: 992px) {
            .navbar-expand-lg .navbar-collapse {
                display: flex !important;
                flex-basis: auto;
                justify-content: space-between;
            }
        }

        .modal-confirm {
            color: #636363;
            width: 400px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }

        .modal-confirm .modal-body {
            color: #999;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }

        .modal-confirm .modal-footer a {
            color: #999;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }

        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-confirm .btn,
        .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }

        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }

        .modal-confirm .btn-secondary:hover,
        .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }

        .modal-confirm .btn-danger {
            background: #f15e5e;
        }

        .modal-confirm .btn-danger:hover,
        .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }

        .bn59 {
            background-color: #141414;
            border: 1px solid rgba(54, 54, 54, 0.6);
            font-weight: 600;
            position: relative;
            outline: none;
            border-radius: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            height: 45px;
            /* width: 130px; */
            opacity: 1;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><?php echo $row['Username']; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?To-Do-List">To-Do List</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-between"><em class="user_email d-flex"><?php echo $row['Email']; ?></em><a class="btn btn-danger" href="./logout.php">Logout</a></div>
            </div>
        </div>
    </nav>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">UPDATE TO-DO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php" method="post">

                    <div class="modal-body">
                        <input type="hidden" name="useridupdate" id="useridupdate">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Update task name</label>
                            <input name="update_Task_Title" id="update_Task_Title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Task Name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Update Task Description</label>
                            <textarea name="update_Task_Description" id="update_Task_Description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <form action="index.php" method="post">
                    <input type="hidden" id="delete_task_id" name="delete_task_id">
                    <div class="modal-header flex-column">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title w-100">Are you sure?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete This task?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" name="delete_task" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <form action="index.php" method="post">
            <div class="todo-list">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Enter task name</label>
                    <input name="Task_Title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Task Name">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Enter Task Description</label>
                    <textarea name="Task_Description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button class="btn btn-success w-100 my-2 bn59" type="submit">Update</button>
                <button class="btn btn-danger w-100 my-2 bn59" type="reset">Reset All</button>
            </div>
        </form>
    </div>


    <div class="container">

        <?php

        if (isset($_GET['To-Do-List'])) {
            include "To-Do-List.php";
        }

        ?>



    </div>


    <!-- Main js -->
    <script src="script.js"></script>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>