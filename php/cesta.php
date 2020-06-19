<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Hojas de estilos-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/EstilosGeneral.css">
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
                    <li><a href="catalogo_login.php">Catalogo</a></li>
                    <li><a href="perfil.php" class="iniciarSesion">Perfil Personal</a></li>
                    <li><a href="cesta.php">Cesta</a></li>
                </ul>
            </nav>
        </div>

        <section>

            <article>
                <h2>Catalogo:</h2>
                <?php
                    session_start();
                    error_reporting(0);
                    include "config.php";
                    include "utils.php";
                    
                    
                    $dbConn =  connect($db);

                    
                    if ($_SERVER['REQUEST_METHOD'] == 'GET')
                    {
                        $sql = $dbConn->prepare("SELECT PEDIDO_NO, PRODUCTO_NO, NOMBRE FROM cesta WHERE NOMBRE_U=:nombre_u");
                        $result = $sql -> execute(array(":nombre_u"=>$_SESSION['logueado']));
                        header("HTTP/1.1 200 OK");
                        $json=json_encode($sql->fetchAll());
                        $array=json_decode($json, true);
                        
                        echo '<table id="catalogo">
                        <tbody>
                            <tr>
                                <th>ID</th><th>ID producto</th><th>Nombre</th>
                            </tr>';
                            
                            foreach($array as $v){
                                echo'<form name="Borrar" method="POST" action="cesta.php">';
                                echo '<tr><td>'.$v['PEDIDO_NO'] .'</td>';
                                echo'<input name="id_pedido" type="hidden" size="" maxlength="" value="'.$v['PEDIDO_NO'].'"/>';
                                echo '<td>'.$v['PRODUCTO_NO'] .'</td>';//nombre
                                echo'<input name="id_producto" type="hidden" size="" maxlength="" value="'.$v['PRODUCTO_NO'].'"/>';
                                echo '<td>'.$v['NOMBRE'] .'</td>';
                                echo ' <td><button name="btnBorrar" type="submit" class="btn btn-primary btn-block btn-large">Borrar</button></td></tr>';
                                echo '</form>';
                                
                            }
                        echo '</tbody>
                    </table>';
                    }
                    if(isset($_POST['btnBorrar'])){
                       
                        $idJuego=htmlentities($_POST["id_producto"]);
                        $idPedido=htmlentities($_POST["id_pedido"]);


                        if ($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                            $sql = $dbConn->prepare("DELETE FROM cesta where PEDIDO_NO=:pedido_no");
                            $result = $sql -> execute(array(":pedido_no"=>$idPedido));
                            header("HTTP/1.1 200 OK");
                            
                            if($result)
                            {
                                $sql = "UPDATE videojuego
                                SET STOCK_DISPONIBLE=STOCK_DISPONIBLE+1
                                WHERE PRODUCTO_NO=?";
                                $statement = $dbConn->prepare($sql);
                                $result = $statement -> execute(array($idJuego));

                                $sql = "UPDATE ranking
                                SET VENTAS_X_PROD=VENTAS_X_PROD-1
                                WHERE PRODUCTO_NO=?";
                                $statement = $dbConn->prepare($sql);
                                $result = $statement -> execute(array($idJuego));
                                echo "<script>alert('Producto Borrado de la cesta');
                                        window.location= 'cesta.php'</script>";
                                
                            }else{
                                echo'error a la hora de añadir';
                            }
                            
                        }
                        

                        

                    }
                   
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