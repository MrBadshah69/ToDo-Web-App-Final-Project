<?php

require "database.php";


$check_query = mysqli_query($conn, "SELECT * FROM `resignation` WHERE ID='$User_ID'");
$row = mysqli_fetch_array($check_query);
$User_IDs = $row['ID'];

$select = mysqli_query($conn, "SELECT * FROM `Todoapp` WHERE User_ID='$User_IDs'");
$show_data = mysqli_num_rows($select);

?>
<div class="todo-list">

    <h1>ToDo List</h1>
<div class="form-floating mb-3">
  <input type="search" class="form-control" id="floatingInput" placeholder="Search Using Title">
  <label for="floatingInput">Search</label>
</div>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">S.no</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Date</th>
                <th scope="col">Other</th>
            </tr>
        </thead>
        <tbody id="task_table">
            <?php
            while ($rows = mysqli_fetch_array($select)) {



            ?>
                <tr>
                    <th scope="row"><?php echo $rows['ID'] ?></th>
                    <td><?php echo $rows['Task_name'] ?></td>
                    <td><?php echo $rows['Task_description'] ?></td>
                    <td><?php echo $rows['Date'] ?></td>
                    <td><button type="button" class="btn btn-success my-1 update bg-dark" id="<?php echo $rows['ID'] ?>" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button>
                        <button type="button" class="btn btn-danger my-1 delete bg-dark" id="<?php echo $rows['ID'] ?>" data-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>