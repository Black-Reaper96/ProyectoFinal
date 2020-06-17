<?php 

    session_start();

?>
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
                include "config.php";
                include "utils.php";
                include "desencriptar.php";
                
                $dbConn =  connect($db);

                $id=$_POST['id'];
                $nombre=$_POST['nombre'];
                $descripcion=$_POST['descripcion'];
                $tipo=$_POST['tipo'];
                $precio=$_POST['precio'];
                $stock=$_POST['stock'];
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                
                    $sql = "INSERT INTO videojuego
                    (PRODUCTO_NO, NOMBRE, DESCRIPCION, TIPO, PRECIO_ACTUAL, STOCK_DISPONIBLE)
                    VALUES
                    (:id, :nombre, :descripcion, :tipo, :precio, :stock)";
                    $statement = $dbConn->prepare($sql);
                    $result = $statement -> execute(array(":id" => $id ,":nombre" => $nombre , ":descripcion" => $descripcion ,":tipo" => $tipo , 
                    ":precio" => $precio , ":stock" => $stock ));
                    /*$statement->execute();*/
                    //$postId = $dbConn->lastInsertId();
                    if($result)
                    {
                                //$input['id'] = $postId;
                                header("HTTP/1.1 200 OK");
                                echo "Insercion Correcta";
                                echo "<a href='insertar_juego.php'>Volver</a>";
                                
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