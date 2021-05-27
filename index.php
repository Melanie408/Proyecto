<?php
    session_start();

    include "config/config.php";

    if (isset($_SESSION['user_id']) && $_SESSION!==null) {
       
        $id_user = $_SESSION['user_id'];
        $query = mysqli_query($con, "select * from user where id=$id_user");
        $row = mysqli_fetch_array($query);
        $user_kind = $row['kind'];

        if($user_kind == "1"){
            header("location: dashboard.php");
        } else if($user_kind == "2"){
            header("location: tracing2.php");
        } else if($user_kind == "3"){
            header("location: tickets3.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Iniciar Sesión </title>

        <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/nprogress/nprogress.css" rel="stylesheet">
        <link href="css/animate.css/animate.min.css" rel="stylesheet">
        <link href="css/custom.min.css" rel="stylesheet">

    </head>
    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <?php 
                        $invalid=sha1(md5("contrasena o usuario invalido"));
                        if (isset($_GET['invalid']) && $_GET['invalid']==$invalid) {
                            echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                                <strong>¡Error!</strong> Contraseña o Usuario Invalido
                                </div>";
                        }
                    ?>
                    <section class="login_content">
                        <form action="action/login.php" method="post">
                            <h1>Iniciar Sesión</h1>
                            <div>
                                <input type="text" name="username" class="form-control" placeholder="Usuario" required />
                            </div>
                            <div>
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" required/>
                            </div>
                            <div>
                                <button type="submit" name="token" value="Login" class="btn btn-default">Iniciar Sesion</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                <div class="clearfix"></div>
                                <br/>
                                <div>
                                    <h1><i class="fa fa-ticket"></i> ServiceTick</h1>
                                    <p>©2021 All Rights Reserved.</p>
                                    <p>Privacy and Terms by Gestión de la Tecnología S.A.</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
