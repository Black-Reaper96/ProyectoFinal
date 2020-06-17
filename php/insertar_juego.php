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
                <h2>Formulario de registro</h2>
                
                    <form method="POST" action="insercion_juego.php">
                        <input type="text" name="id" id="usuario" placeholder="ID" required="required" />
                        <input type="text" name="nombre" id="usuario" placeholder="Nombre" required="required" />
                        <input type="tex" name="descripcion" id="contrasena" placeholder="Descripcion" required="required" />
                        <input type="text" name="tipo" id="nombre" placeholder="Tipo" required="required" />
                        <input type="text" name="precio" id="apellidos" placeholder="Precio" required="required" />
                        <input type="text" name="stock" id="telefono" placeholder="Stock" required="required" />
                        <button name="btnLogin" type="submit" class="btn btn-primary btn-block btn-large">Insert me.</button>
                    </form>
                
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