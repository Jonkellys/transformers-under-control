<?php
    require_once "./funciones.php";

    if(isset($_GET['emailTrial'])) {

        $email = strClean($_POST['recoverForm']);

        if($email == "") {
            echo "<script>new swal('¡Error!', 'You must add your email', 'error');</script>";
            exit(); 
        } else {
            $consulta = ejecutar_consulta_simple("SELECT userEmail FROM usuarios WHERE userEmail = '$email'");
            if($consulta->rowCount() != 1) {
                echo "<script>new swal('¡Error!', 'The entered email is not saved in the system', 'error');</script>";
                exit();
            }
        }

        $stmt = "SELECT * FROM usuarios WHERE userEmail = '$email'";
        $result = connect()->query($stmt);

        while ($rows = $result->fetch()) {
            $codigo = $rows['userCodigo'];
            $tipo = $rows['userType'];
        }; 

        $token = bin2hex(random_bytes(50));

        $sql = connect()->prepare("INSERT INTO contrasenas(contrasenaEmail, contrasenaToken, userCodigo, userType) VALUES ('$email', '$token', '$codigo', '$tipo')");

        if($sql->execute()){
            echo "<script>new swal('¡Success!', 'Wait a moment', 'success');</script>";
            echo '<script> window.location.href = "http://localhost/transformers-under-control/newPass?token=' . $token .'"; </script>';
                
        } 
    } else if(isset($_GET['newPass'])) {
        $token = strClean($_POST['token']);

        $pass = strClean($_POST['newPassForm']);
        $newpass = strClean($_POST['confirmPassForm']);
        $password = password_hash($pass, PASSWORD_DEFAULT);

        if($pass == "" || $newpass == "") {
            echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
            exit(); 
        }

        if(strlen($pass) < 8){
            echo "<script>new swal('¡Error!', 'The password has to have at least 8 characters', 'error');</script>";
            exit();
        }
        
        if($pass != $newpass){
            echo "<script>new swal('¡Error!', 'The passwords don't match', 'error');</script>";
            exit();
        }  

        $stmt = "SELECT * FROM contrasenas WHERE contrasenaToken = '$token' LIMIT 1";
        $result = connect()->query($stmt);

        while ($rows = $result->fetch()) {
            $email = $rows['contrasenaEmail'];
            $tipo = $rows['userType'];
            $codigo = $rows['userCodigo'];
        }; 

        $sql = connect()->prepare("UPDATE usuarios SET userPassword = '$password'  WHERE userCodigo = '$codigo'");

        if($sql->execute()){
            echo "<script>new swal('¡Success!', 'Password Updated Correctly', 'success');</script>";
            echo '<script> window.location.href = "http://localhost/transformers-under-control/login"; </script>';
        }
    }
?>