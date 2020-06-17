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
                    <?php
                        include "config.php";
                        include "utils.php";
                        include "desencriptar.php";
                        
                        $dbConn =  connect($db);
    
                        
                        if ($_SERVER['REQUEST_METHOD'] == 'GET')
                        {
                            $sql = $dbConn->prepare("SELECT * FROM videojuego");
                            $result = $sql -> execute(array());
                            header("HTTP/1.1 200 OK");
                            $json=json_encode($sql->fetchAll());
                            $array=json_decode($json, true);

                            

                            echo '<table id="customers">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                    </tr>';
                            
                                foreach($array as $v){
                                    echo "<form name='modificar' method=\"POST\" action='modificar_juego.php'>";    
                                    echo "<td><input type='text' readonly size='8' name='id' value=".$v['PRODUCTO_NO']."></td>";  

                                    echo "<td><input type='text' name='nombre' size='20' value='".$v['NOMBRE']."'/></td>";
                                    echo "<td><input type='text' name='descripcion' size='20' value='". $v['DESCRIPCION'] . "'/></td>";
                                    echo "<td><input type='text' name='tipo' size='20' value='".$v['TIPO']."'/></td>";
                                    echo "<td><input type='text' name='precio' size='20' value='".$v['PRECIO_ACTUAL']."'/></td>";
                                    echo "<td><input type='text' name='stock' size='20' value='".$v['STOCK_DISPONIBLE']."'/></td>";
                                    echo'<section id="botones">';
                                    echo '<td><button name="btnModificar" type="submit" class="btn btn-primary btn-block btn-large">Modificar</button></td>';
                                    echo '<td><button name="btnBorrar" type="submit" class="btn btn-primary btn-block btn-large">Eliminar</button></td></tr>';
                                    echo'</section>';
                                    echo '</form>';
                                }
                            
                            echo'</table>';
                           
                            
                        }
                            if(isset($_POST['btnModificar'])){
                                $idJuego=htmlentities($_POST["id"]);
                                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                {
                           
                                    $nuevo_nombre=$_POST['nombre'];
                                    $nueva_descripcion=$_POST['descripcion'];
                                    $nuevo_tipo=$_POST['tipo'];
                                    $nuevo_precio=$_POST['precio'];
                                    $nuevo_stock=$_POST['stock'];
                                    $sql = "UPDATE videojuego
                                    SET NOMBRE=?, DESCRIPCION=?, TIPO=?, PRECIO_ACTUAL=?, STOCK_DISPONIBLE=?
                                    WHERE PRODUCTO_NO=?";
                                    $statement = $dbConn->prepare($sql);
                                    $result = $statement -> execute(array($nuevo_nombre,$nueva_descripcion,$nuevo_tipo, $nuevo_precio,$nuevo_stock,$idJuego));
                                    if($result){
                                        echo "<script>alert('Juego Borrado');
                                        window.location= 'modificar_juego.php'</script>";
                                    }
                                    
                                }
                                
                                
                            }

                            if(isset($_POST['btnBorrar'])){
                       
                                $idJuego=htmlentities($_POST["id"]);
        
        
                                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                {
                                    $sql = $dbConn->prepare("DELETE FROM videojuego where PRODUCTO_NO=:prodicto_no");
                                    $result = $sql -> execute(array(":prodicto_no"=>$idJuego));
                                    header("HTTP/1.1 200 OK");
                                    
                                    if($result)
                                    {
                                        echo "<script>alert('Juego Borrado');
                                        window.location= 'modificar_juego.php'</script>";
                                        
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