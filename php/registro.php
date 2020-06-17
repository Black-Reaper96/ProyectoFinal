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

                $nombre_u=$_POST['usuario'];
                $contrasena=$_POST['contrasena'];
                $contra=$encriptar($contrasena);
                $nombre=$_POST['nombre'];
                $tel=$_POST['telefono'];
                $dire=$_POST['direccion'];
                $ape=$_POST['apellidos'];
                $usu="user";
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $sql = $dbConn->prepare("SELECT NOMBRE_U, CONTRASEÑA, ROL FROM usuarios WHERE NOMBRE_U=:nombre_u");
                        $result = $sql -> execute(array(":nombre_u"=>$nombre_u));
                        header("HTTP/1.1 200 OK");
                        $json=json_encode($sql->fetchAll());
                        $array=json_decode($json, true);
                        if($array){
                            echo 'El usuario ya existe';
                        }else{
                            $sql = "INSERT INTO usuarios
                            (NOMBRE_U, CONTRASEÑA, NOMBRE, APELLIDOS, TELEFONO, DIRECCION, ROL)
                            VALUES
                            (:nombre_u, :contra, :nombre, :ape, :tel, :dire, :usu)";
                            $statement = $dbConn->prepare($sql);
                            $result = $statement -> execute(array(":nombre_u" => $nombre_u , ":contra" => $contra ,":nombre" => $nombre , 
                            ":ape" => $ape , ":tel" => $tel ,  ":dire" => $dire ,":usu" => $usu ));
                            /*$statement->execute();*/
                            //$postId = $dbConn->lastInsertId();
                            if($result)
                            {
                                //$input['id'] = $postId;
                                header("HTTP/1.1 200 OK");
                                echo "Registro Correcto";
                                echo "<a href='../login.html'>Ahora a entrar</a>";
                                
                            }
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
