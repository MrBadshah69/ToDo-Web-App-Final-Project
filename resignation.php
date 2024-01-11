<?php



session_start();
ob_start();
include("./database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html,
        body {
            display: grid;
            height: 100%;
            width: 100%;
            place-items: center;
            background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
        }

        ::selection {
            background: #1a75ff;
            color: #fff;
        }

        .wrapper {
            overflow: hidden;
            max-width: 390px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
        }

        .wrapper .title-text {
            display: flex;
            width: 200%;
        }

        .wrapper .title {
            width: 50%;
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .wrapper .slide-controls {
            position: relative;
            display: flex;
            height: 50px;
            width: 100%;
            overflow: hidden;
            margin: 30px 0 10px 0;
            justify-content: space-between;
            border: 1px solid lightgrey;
            border-radius: 15px;
        }

        .slide-controls .slide {
            height: 100%;
            width: 100%;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            text-align: center;
            line-height: 48px;
            cursor: pointer;
            z-index: 1;
            transition: all 0.6s ease;
        }

        .slide-controls label.signup {
            color: #000;
        }

        .slide-controls .slider-tab {
            position: absolute;
            height: 100%;
            width: 50%;
            left: 0;
            z-index: 0;
            border-radius: 15px;
            background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
            transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        input[type="radio"] {
            display: none;
        }

        #signup:checked~.slider-tab {
            left: 50%;
        }

        #signup:checked~label.signup {
            color: #fff;
            cursor: default;
            user-select: none;
        }

        #signup:checked~label.login {
            color: #000;
        }

        #login:checked~label.signup {
            color: #000;
        }

        #login:checked~label.login {
            cursor: default;
            user-select: none;
        }

        .wrapper .form-container {
            width: 100%;
            overflow: hidden;
        }

        .form-container .form-inner {
            display: flex;
            width: 200%;
        }

        .form-container .form-inner form {
            width: 50%;
            transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .form-inner form .field {
            height: 50px;
            width: 100%;
            margin-top: 20px;
        }

        .form-inner form .field input {
            height: 100%;
            width: 100%;
            outline: none;
            padding-left: 15px;
            border-radius: 15px;
            border: 1px solid lightgrey;
            border-bottom-width: 2px;
            font-size: 17px;
            transition: all 0.3s ease;
        }

        .form-inner form .field input:focus {
            border-color: #1a75ff;
            /* box-shadow: inset 0 0 3px #fb6aae; */
        }

        .form-inner form .field input::placeholder {
            color: #999;
            transition: all 0.3s ease;
        }

        form .field input:focus::placeholder {
            color: #1a75ff;
        }

        .form-inner form .pass-link {
            margin-top: 5px;
        }

        .form-inner form .signup-link {
            text-align: center;
            margin-top: 30px;
        }

        .form-inner form .pass-link a,
        .form-inner form .signup-link a {
            color: #1a75ff;
            text-decoration: none;
        }

        .form-inner form .pass-link a:hover,
        .form-inner form .signup-link a:hover {
            text-decoration: underline;
        }

        form .btn {
            height: 50px;
            width: 100%;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        form .btn .btn-layer {
            height: 100%;
            width: 300%;
            position: absolute;
            left: -100%;
            background: -webkit-linear-gradient(right, #003366, #004080, #0059b3, #0073e6);
            border-radius: 15px;
            transition: all 0.4s ease;
            ;
        }

        form .btn:hover .btn-layer {
            left: 0;
        }

        form .btn input[type="submit"] {
            height: 100%;
            width: 100%;
            z-index: 1;
            position: relative;
            background: none;
            border: none;
            color: #fff;
            padding-left: 0;
            border-radius: 15px;
            font-size: 20px;
            font-weight: 500;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Login Form</div>
            <div class="title signup">Signup Form</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form action="resignation.php" method="post" class="login">
                    <?php


                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $user_name = $_POST['user_name'];
                        $login_password = $_POST['login_password'];

                        $sql = "SELECT * FROM `resignation` WHERE Username='$user_name' AND Password='$login_password'";
                        $sql_result = mysqli_query($conn, $sql);
                        $check_login = mysqli_num_rows($sql_result);

                        if ($check_login > 0) {
                            $row =mysqli_fetch_assoc($sql_result);
                            $_SESSION['User_ID'] = $row['ID'];
                            $_SESSION['User_name'] = $row['Username'];
                            header("location: index.php");
                            ob_end_flush();
                        } else {
                            echo "<div class='alert alert-danger'>
                            <strong>error:</strong> Check your email and password
                            </div>";
                        }
                    }




                    ?>
                    <div class="field">
                        <input name="user_name" type="text" placeholder="Username" required>
                    </div>
                    <div class="field">
                        <input name="login_password" type="password" placeholder="Password" required>
                    </div>
                    <div class="pass-link"><a href="#">Forgot password?</a></div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Login">
                    </div>
                    <div class="signup-link">Not a member? <a href="">Signup now</a></div>
                </form>
                <form action="resignation.php" method="post" class="signup">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $username = $_POST['sign_User_name'];
                        $user_email = $_POST['User_email'];
                        $user_password = $_POST['User_password'];
                        $user_confirm_password = $_POST['User_Confirm_password'];

                        if ($user_password != $user_confirm_password) {
                            echo "<div class='alert alert-danger'>
                            <strong>error:</strong> Password do not match.
                            </div>";
                        } elseif (strlen($user_password) <= 8) {
                            echo "<div class='alert alert-danger'>
                            <strong>error:</strong> check your Password must above 8 chara.
                            </div>";
                        } else {
                            $check = "SELECT * FROM `resignation` WHERE Email='$user_email'";
                            $result = mysqli_query($conn, $check);
                            $row = mysqli_num_rows($result);
                            if ($row > 0) {
                                echo "<div class='alert alert-danger'>
                                <strong>error:</strong> This email is already exists
                                </div>";
                            } else {

                                $select = "INSERT INTO `resignation`(`Username`, `Email`, `Password`) VALUES ('$username','$user_email','$user_password')";
                                $INSERT_QUERY = mysqli_query($conn, $select);
                                if ($INSERT_QUERY) {
                                    echo "<div class='alert alert-info'>
                                <strong>Sign up:</strong> you are signup successfully.
                            </div>";
                                }
                            }
                        }
                    }

                    ?>
                    <div class="field">
                        <input name="sign_User_name" type="text" placeholder="Username" required>
                    </div>
                    <div class="field">
                        <input name="User_email" type="text" placeholder="Email Address" required>
                    </div>
                    <div class="field">
                        <input name="User_password" type="password" placeholder="Password" required>
                    </div>
                    <div class="field">
                        <input name="User_Confirm_password" type="password" placeholder="Confirm password" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input name="Submit" type="submit" value="Signup">
                    </div>
                    <div class="signup-link">I have already account <a href="">Login now</a></div>
                </form>
            </div>
        </div>
    </div>




    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (() => {
            signupBtn.click();
            return false;
        });
    </script>
</body>

</html>