<?php

    require_once "./funciones.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        try {
            if(isset($_GET['CAdd'])) {
                $stmt = connect()->prepare("INSERT INTO usuarios(userCodigo, userUsername, userPassword, userType, userName, userLastname, userCargo, userEmail) 
                VALUES(:codigo, :usuario, :clave, :tipo, :nombre, :apellido, :cargo, :correo)");

                $stmt->bindParam(':codigo', $codigo);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':clave', $password);
                $stmt->bindParam(':tipo', $tipo);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':apellido', $apellido);
                $stmt->bindParam(':cargo', $cargo);
                $stmt->bindParam(':correo', $correo);
                
                $usuario = strClean($_POST["usuario"]);
                $clave = strClean($_POST["clave"]);
                $confirmar = strClean($_POST["confirmar"]);
                $password = password_hash($clave, PASSWORD_DEFAULT);

                $nombre = strClean($_POST["nombre"]);
                $apellido = strClean($_POST["apellido"]);
                $cargo = strClean($_POST["cargo"]);
                $correo = strClean($_POST["correo"]);
                $tipo = strClean($_POST["tipo"]);


                if($usuario == "" || $clave == "" || $confirmar == "" || $nombre == "" || $apellido == "" || $cargo == "" || $correo == "") { 
                    echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
                    exit(); 
                }

                if(strlen($clave) < 8){
                    echo "<script>new swal('¡Error!', 'The password has to have at least 8 characters', 'error');</script>";
                    exit();
                }
                
                if($clave != $confirmar){
                    echo "<script>new swal('¡Error!', 'The passwords don` t match', 'error');</script>";
                    exit();
                }  

                $consulta = ejecutar_consulta_simple("SELECT userEmail FROM usuarios WHERE userEmail = '$correo'");
                    if($consulta->rowCount()>=1) {
                    echo "<script>new swal('¡Error!', 'The entered email is already in the system', 'error');</script>";
                        exit();
                    }

                $consulta2 = ejecutar_consulta_simple("SELECT userUsername FROM usuarios WHERE userUsername = '$usuario'");
                    if($consulta2->rowCount()>=1) {
                    echo "<script>new swal('¡Error!', 'The entered username is already in the system', 'error');</script>";
                        exit();
                    }
                
                $consulta4= ejecutar_consulta_simple("SELECT id FROM usuarios");
                $numero = ($consulta4->rowCount())+1;

                if ($tipo == "Admin") {
                    $codigo = generar_codigo_aleatorio("A", 7, $numero);
                } else {
                    $codigo = generar_codigo_aleatorio("N", 7, $numero);
                }

                if($stmt->execute()){
                    echo "<script>new swal('Account Created Correctly', 'You can log in with the new user', 'success');</script>";
                    echo '<script> location.reload(); </script>';
                } 

            } else if(isset($_GET['updateC'])) {
                $sql = connect()->prepare("UPDATE usuarios SET userCodigo = :codigo, userUsername = :username, userPassword = :contrasena, userType = :tipo, userName = :nombre, userLastname = :apellido, userCargo = :cargo, userEmail = :email WHERE userCodigo = :codigo");

                $sql->bindParam(":codigo", $codigo);
                $sql->bindParam(":username", $username);
                $sql->bindParam(":contrasena", $contrasena);
                $sql->bindParam(":tipo", $tipo);
                $sql->bindParam(":nombre", $nombre);
                $sql->bindParam(":apellido", $apellido);
                $sql->bindParam(":cargo", $cargo);
                $sql->bindParam(":email", $email);

                $codigo = strClean($_POST["codigoUpdate"]);
                $username = strClean($_POST["usuarioUpdate"]);
                $contrasena = strClean($_POST["contrasenaUpdate"]);
                $tipo = strClean($_POST["tipoUpdate"]);
                $nombre = strClean($_POST["nombreUpdate"]);
                $apellido = strClean($_POST["apellidoUpdate"]);
                $cargo = strClean($_POST["cargoUpdate"]);
                $email = strClean($_POST["correoUpdate"]);
                $email2 = strClean($_POST["correoCheck"]);
                $username2 = strClean($_POST["userCheck"]);

                if($username == "" || $tipo == "" || $nombre == "" || $apellido == "" || $cargo == "" || $email == "") {
                    echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
                    exit(); 
                }

                $consulta3 = ejecutar_consulta_simple("SELECT userEmail FROM usuarios WHERE userEmail = '$email' AND userEmail != '$email2'");
                if($consulta3->rowCount()>=1) {
                    echo "<script>new swal('¡Error!', 'The entered email is already in the system', 'error');</script>";
                    exit();
                }

                $consulta4 = ejecutar_consulta_simple("SELECT userUsername FROM usuarios WHERE userUsername = '$username' AND userUsername != '$username2'");
                if($consulta4->rowCount()>=1) {
                    echo "<script>new swal('¡Error!', 'The entered username is already in the system', 'error');</script>";
                    exit();
                }

                if($sql->execute()){
                    echo "<script>new swal('¡Success!', 'Account Updated correctly', 'success');</script>";
                                      
                    echo '<script> window.location.href = "http://localhost/transformers-under-control/configurations"; </script>';
                }

            } else if(isset($_GET['deleteC'])) {
                $codigo = strClean($_POST["delC"]);
          
                $query = "DELETE FROM usuarios WHERE userCodigo = '$codigo'";
                
                $check = ejecutar_consulta_simple("SELECT * FROM usuarios WHERE userType = 'Admin' AND userCodigo != '$codigo'");
                
          
                if($check->rowCount() < 1) {
                    echo "<script>new swal('¡Can`t delete the user!', 'There has to be at least one Admin in the system', 'error');</script>";
                    exit();
                } else {
                    connect()->query($query);
                    echo "<script>new swal('¡Success!', 'Account Deleted Correctly', 'success');</script>";
                    
                    if($_SESSION['codigo'] == $codigo) {
                      echo '<script> window.location.href = "http://localhost/transformers-under-control/"; </script>';
                    } else {
                      echo '<script> window.location.href = "http://localhost/transformers-under-control/configurations"; </script>';
                    }
                }
              }

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

?>
