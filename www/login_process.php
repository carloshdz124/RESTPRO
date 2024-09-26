<?php
include_once("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y sanitizar los datos
    $user = htmlspecialchars($_POST['user']);
    $password = md5(htmlspecialchars($_POST['password']));
    
    $query = "SELECT * FROM usuarios WHERE usuario=:user and md5=:password";
    $resultados = $pdo->prepare($query);
    $resultados->execute(array(":user"=> $user,":password"=> $password));
    if($resultados->rowCount() > 0) {
        $datos_usuario = $resultados->fetch(PDO::FETCH_OBJ);

        $_SESSION["id"] = $datos_usuario->id;
        $_SESSION["user"] = $datos_usuario->usuario;
        $_SESSION["tipo_user"] = $datos_usuario->tipo_usuario;

        include_once "config/consultas.php";

        // Redireccionar al index una vez validada la sesión
        header("Location: index.php");
        exit();
    }
    else {
        // Si no existe el usuario mandar mensaje de error
        $respuesta_login = "error";
        header("Location: login.php?respuesta_login=". urlencode($respuesta_login));
        exit();
    }

    
} else {
    echo "Método no permitido";
}






?>