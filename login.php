<?php
    //importar conexion
    require 'includes/config/database.php';
    $db = conectarDB();

    $errores= [];

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        // echo"<pre>";
        // var_dump($_POST);
        // echo"</pre>";
        $email = mysqli_real_escape_string($db,filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db,$_POST['password']);
        if(!$email) {
            $errores[] = "El email es obligatorio o no es valido";
        }
        if(!$password) {
            $errores[] = "El password es obligatorio";
        }
        if(empty($errores)) {
            // si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);
            // var_dump($resultado);
            if($resultado->num_rows ) {
                $usuario = mysqli_fetch_assoc($resultado);
                //verificar si el password es correcto o no
                $auth= password_verify($password, $usuario["password"]);
                if($auth){
                    session_start();
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                    header('Location: /admin');
                }else{
                    $errores[] = "El password es incorrecto";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
        // echo"<pre>";
        // var_dump($errores);
        // echo"</pre>";
    }

    require 'includes/funciones.php';
    incluirTemplate('header');

?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        
        <form class="formulario" method="POST">
            <fieldset>
                <legend>Email y password</legend>

                <label for="email"></label>
                <input type="email" placeholder="Tu Email" id="email" name="email">
                <label for="password"></label>
                <input type="password" placeholder="Tu Password" id="password" name="password">
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>