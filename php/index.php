<?php 
session_start();
error_reporting(0);
include "config.php";
include "utils.php";
include "desencriptar.php";

$dbConn =  connect($db);
//porque tenias $_POST
if (isset($_GET['btnLogin'])){
    
    $usu=$_GET['usuario'];
    $contra=$_GET['contrasena'];

    $sql = $dbConn->prepare("SELECT NOMBRE_U, CONTRASEÑA, ROL FROM usuarios WHERE NOMBRE_U=:nombre_u");
    $result = $sql -> execute(array(":nombre_u"=>$usu));
    header("HTTP/1.1 200 OK");
    $json=json_encode($sql->fetchAll());
    $array=json_decode($json, true);
    if($array  || $_SESSION['nombre_usu']){
        
        $a=$array[0];
        $c=$a['NOMBRE_U'];
        $d=$a['CONTRASEÑA'];
        $_SESSION['nombre_usu']=$c;
        $d2=$desencriptar($d);
        if($c==$usu && $d2==$contra){
            $_SESSION['logueado']=$usu;
    }
    }
}
if (isset($_SESSION['logueado']))
    {
            ?>
            <!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Hojas de estilos-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/EstilosGeneral.css">
        <link href='../css/cssCarrousel.css' rel='stylesheet' />
        <link rel="stylesheet" href="../css/Login.css">

        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ARCADE:Tienda online</title>
    </head>
    <body>

        <header>
            <img src="../imagenes/icono.png" alt="imagen del juego catan" width="150" height="150">
            <titulo>
                <h1>ARCADE</h1>
                <h2>Tienda Online</h2>
            </titulo>
            <img src="../imagenes/icono.png" alt="imagen del juego catan" width="150" height="150">
        </header>

        <div>
            <input type="checkbox" id="btn-menu">
            <label for="btn-menu"><span class="fas fa-bars"></span></label>

            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php 
                    if($_SESSION['logueado']=='admin'){
                    ?>
                    <li><a href="insertar_juego.php" class="iniciarSesion">Insertar Juego</a></li>
                    <li><a href="perfil.php" class="iniciarSesion">Perfil Personal</a></li>
                    <li><a href="modificar_juego.php" class="iniciarSesion">Modificar Juego</a></li>
                    <?php 
                    }else{
                    ?>
                    <li><a href="catalogo_login.php">Catalogo</a></li>
                    <li><a href="perfil.php" class="iniciarSesion">Perfil Personal</a></li>
                    <li><a href="cesta.php">Cesta</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>

        <section>

            <article>
                <h3>Bienvenido a nuestro portal de ocio <?php echo $_SESSION['logueado']; ?></h3>
                <h3>Ranking</h3>
                <?php
                $dbConn =  connect($db);
                
                        
                        $sql = $dbConn->prepare("SELECT * FROM ranking order by VENTAS_X_PROD desc");
                        $sql->execute();
                        $sql->setFetchMode(PDO::FETCH_ASSOC);
                        header("HTTP/1.1 200 OK");
                        $json=json_encode($sql->fetchAll());
                        $array=json_decode($json, true);
                        $c=1;
                        echo '<table id="catalogo">
                        <tbody>
                            <tr>
                                <th>Id</th><th class="descripcion">ID JUEGO</th>><th>Ventas x unidad</th>
                            </tr>';
                            foreach($array as $v){
                                echo '<tr><td>'.$c.'</td>';
                                echo '<td>'.$v['PRODUCTO_NO'] .'</td>';//nombre
                                echo '<td>'.$v['VENTAS_X_PROD'] .'</td>';
                                $c++;
                            }
                        echo '</tbody>
                    </table>';
                    
                ?>
            </article>


            <aside>
                <h1>Nuestro calendario</h1>
                <table id="calendar">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th><th>Vie</th><th>Sab</th><th>Dom</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </aside>
        </section>
        

        <footer>
            
            <h2>Info Proyecto fin de ciclo:</h2>
            <p>Nombre: Alejandro</p>
            <p>Apellidos: Martin Martin</p>
            <p>Centro: IES Ribera de Castilla</p>
        
        </footer>
    </body>
</html>
<script src="../js/calendar.js"></script>
        <?php
                
        }else{
            ?>
            <!DOCTYPE html>
            <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <!--Hojas de estilos-->
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
                    <link rel="stylesheet" href="../css/Login.css">

                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>ARCADE:Tienda online</title>
                </head>
                <body>

                    <div class="login">
                        <h2>Contraseña/usuario incorrecta</h2>
                        <img src="../imagenes/icono.png" alt="Logotipo de la pagina" width="90" height="90" class="logo" >
                        <h1>Log-in</h1>
                        <form method="GET" action="index.php">
                            <input type="text" name="usuario" id="usuario" placeholder="Username" required="required" />
                            <input type="password" name="contrasena" id="contrasena" placeholder="Password" required="required" />
                            <button name="btnLogin" type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
                        </form>
                        <a href="../registro.html"><h3>Registrarse</h3></a>
                        <a href="../index.html"><i class="fas fa-arrow-circle-left fa-2x"></i></a>
                    </div>

                </body>
            </html>
            
        <?php
    }
  
?>