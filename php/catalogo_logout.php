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
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="catalogo_logout.php">Catalogo</a></li>
                    <li><a href="../registro.html">Registrarse</a></li>
                    <li><a href="../login.html" class="iniciarSesion">Iniciar sesion</a></li>
                </ul>
            </nav>
        </div>

        <section>

            <article>
                <h2>Catalogo:</h2>
                <?php
                    error_reporting(0);
                    include "config.php";
                    include "utils.php";
                    
                    
                    $dbConn =  connect($db);
                    
                    if ($_SERVER['REQUEST_METHOD'] == 'GET')
                    {
                        $sql = $dbConn->prepare("SELECT * FROM videojuego");
                        $sql->execute();
                        $sql->setFetchMode(PDO::FETCH_ASSOC);
                        header("HTTP/1.1 200 OK");
                        $json=json_encode($sql->fetchAll());
                        $array=json_decode($json, true);
                        
                        echo '<table id="catalogo">
                        <tbody>
                            <tr>
                                <th>Id</th><th>Nombre</th><th class="descripcion">Descripcion</th><th>Tipo</th><th>Precio x unidad</th><th>Stock</th>
                            </tr>';
                            foreach($array as $v){
                                echo '<tr><td>'.$v['PRODUCTO_NO'] .'</td>';
                                echo '<td>'.$v['NOMBRE'] .'</td>';//nombre
                                echo '<td>'.$v['DESCRIPCION'] .'</td>'; //apellido
                                echo '<td>'.$v['TIPO'] .'</td>';//email
                                echo '<td class="precio">'.$v['PRECIO_ACTUAL'] .'</td>';//email
                                echo '<td>'.$v['STOCK_DISPONIBLE'] .'</td></tr>';
                            }
                        echo '</tbody>
                    </table>';
                    }
                   
                ?>
                <h2>Si quiere acceder a comprar <a href="../registro.html" id="enlace">registrese</a> o <a href="../login.html" id="enlace">acceda</a></h2>
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