<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Hojas de estilos-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/EstilosGeneral.css">
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


        <article>
                <?php
                session_start(); 
                include "config.php";
                include "utils.php";
                
                $dbConn =  connect($db);

                echo '<h2>¿Esta seguro que quiere darse de baja?</h2>';
                echo "<form name='baja_usuario' method=\"POST\" action='baja.php'>";
                echo '<button name="baja_usuario" type="submit" class="btn btn-primary btn-block btn-large">SI</button>';
                echo '</form>';
                echo "<form name='cerrar_sesion' method=\"POST\" action='index.php'>";
                echo '<button type="submit" class="btn btn-primary btn-block btn-large">NO</button>';
                echo '</form>';
                
                if (isset($_POST['baja_usuario']))
                {
                    $sql = $dbConn->prepare("DELETE FROM usuarios where NOMBRE_U=:nombre_u");
                    $result = $sql -> execute(array(":nombre_u"=>$_SESSION['logueado']));
                    header("HTTP/1.1 200 OK");
                    
                            if($result)
                            {
                                //$input['id'] = $postId;
                                header("HTTP/1.1 200 OK");
                                echo "Se ha dado de baja correctamente";
                                echo "<a href='../index.html'>Salir</a>";
                                
                            }
                        
                   
                   
                    
                    
                }
                ?>
        </article>

        <footer>
            
            <h2>Info Proyecto fin de ciclo:</h2>
            <p>Nombre: Alejandro</p>
            <p>Apellidos: Martin Martin</p>
            <p>Centro: IES Ribera de Castilla</p>
        
        </footer>
    </body>
</html>