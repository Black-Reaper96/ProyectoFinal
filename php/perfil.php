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
                            $sql = $dbConn->prepare("SELECT * FROM usuarios WHERE NOMBRE_U=:nombre_u");
                            $result = $sql -> execute(array(":nombre_u"=>$_SESSION['logueado']));
                            header("HTTP/1.1 200 OK");
                            $json=json_encode($sql->fetchAll());
                            $array=json_decode($json, true);

                            echo "<form name='modificar' method=\"POST\" action='perfil.php'>";

                            echo '<table id="customers">
                                    <tr>
                                        <th>Nombre de usuario</th>
                                        <th>Contraseña</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                    </tr>';
                            
                                foreach($array as $v){
                                    for ($i=0;$i<6;$i++){
                                                
                                        if($i==0){
                                            echo "<tr><td>".$v['NOMBRE_U']."</td>";
                                        }
                                        if($i==1){       
                                            echo "<td><input type=text size='20' name='password' value='".$desencriptar($v['CONTRASEÑA'])."'/></td>";
                                            
                                        }
                                        if($i==2){       
                                            echo "<td><input type='text' size='20'name='nombre_persona' value='".$v['NOMBRE']."'/></td>";
                                            
                                        }
                                        if($i==3){       
                                            echo "<td><input type='text' size='20' name='apellido' value='".$v['APELLIDOS']."'/></td>";
                                            
                                        }
                                        if($i==4){       
                                            echo "<td><input type='text' size='20' name='telefono' value='".$v['TELEFONO']."'/></td>";
                                            
                                        }
                                        if($i==5){       
                                            echo "<td><input type='text' size='20' name='direccion' value='".$v['DIRECCION']."'/></td></tr>";
                                            
                                        }
                                        
                                    } 
                                }
                            
                            echo'</table>';
                            echo'<section id="botones">';
                            echo '<button name="btnModificar" type="submit" class="btn btn-primary btn-block btn-large">Modificar</button>';
                            echo '</form>';
                            echo "<form name='baja_usuario' method=\"POST\" action='baja.php'>";
                            echo '<button type="submit" class="btn btn-primary btn-block btn-large">Darme de baja</button>';
                            echo '</form>';
                            echo "<form name='cerrar_sesion' method=\"POST\" action='logout.php'>";
                            echo '<button type="submit" class="btn btn-primary btn-block btn-large">Cerrar sesion</button>';
                            echo '</form>';
                            echo'</section>';
                        }
                            if(isset($_POST['btnModificar'])){
                                $nueva_contra=$encriptar($_POST['password']);
                                $nuevo_nombre=$_POST['nombre_persona'];
                                $nuevo_apellido=$_POST['apellido'];
                                $nuevo_telefono=$_POST['telefono'];
                                $nuevo_direccion=$_POST['direccion'];
                                $sql = "UPDATE usuarios
                                SET CONTRASEÑA=?, NOMBRE=?, APELLIDOS=?, TELEFONO=?, DIRECCION=?
                                WHERE NOMBRE_U=?";
                                $statement = $dbConn->prepare($sql);
                                $result = $statement -> execute(array($nueva_contra,$nuevo_nombre,$nuevo_apellido, $nuevo_telefono,$nuevo_direccion,$_SESSION['logueado']));

                                echo "<script>alert('Cambio realizado');
                                        window.location= 'perfil.php'</script>";
                                
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