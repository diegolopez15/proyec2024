<?php
session_start();
include("config/db.php"); 

//inicializar variable de error
serror = "";

try {
    if ($_server["request_method"] == "post") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (!empty($email) && !empty($password) ) {
            //preparar la consulta SQL
            $stmt = $pdo->prepare("select * from usuarios where email = :email");
            $stmt-> execute(["email" => $email]);
            $user = $stmt->fetch(PDO::fetch_assoc);

            //verifica si se obtuvo el usuario
            if (suser) {
                //verificar la contraseña
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user_id"] = $user["id"];
                    header("location: test_connection.php");
                    exit();
                } else {
                    $error = "credenciales incorrectas: la contraseña no conincide.";
                }
            } else {
                $error = "credenciales incorrectas: el correo electronico no existe.";
            }
        } else {
            $error = "por favor, complete todos los campos.";
        }
    }
 catch (PDOException $e) {
        $error = "error de base de datos: " . $e->getmessage();
 catch (exception $e) {
        $error = "error del servidor:" . $e->getmessage();    
}

    }
}
?>

<!doctype html>
<html lang="es">
    <meta charset="UFT-8">
    <meta name="viewport" content="width="width=device-width, initial-scale=1.
    <title> iniciar sesion</title>
    <link href="http://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/boo"
    <stile>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin-top: 50px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0 0.1);
            border-radius: 10px;
        }
    </stile>
    <body>
        <div class="container">
            <h2 class="text-center">iniciar sesion</h2>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" id="error-alert">
                    <?php echo $error;?>
        </div>
        <?php endif; ?>
        <form action="logiin.php" method="post">
            <div class="form-group">
                <label for="email" class="form-label">correo electronico;>
                <input type="email" class="form-control" id="email" name="">
            </div>
            <div class="form-group">
                <label for="passoword" class="form-label">contraseña</label>
                

            </div>       
    </body>