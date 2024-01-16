<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'get_model.php';

    $id_paciente = $_GET["p"];
    $id_destino = $_GET["d"];

    $Get_Model = new Get_Model();
    $get_studie = $Get_Model->Get_studieDestino($id_destino);
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Parte 3 - Muestro las fecho de estudio realizado</title>
        <link rel="stylesheet" href="css/menuData_style.css">
    </head>
    
    <body>

        <div class="BoxMenu">
            <?php 
                while($studie = mysqli_fetch_assoc($get_studie)){  
                
                    $id = $studie['id'];
                    
                    $date = $studie['date'];
                    $fecha = date("d/m/Y", strtotime($date)); ?>
            
                    <div class="menu">
                        <h6><?php echo $fecha;?></h6>
                        <a href="paso-4.php?p=<?php echo $id_paciente;?>&d=<?php echo $id_destino;?>&s=<?php echo $id;?>">Ver</a>
                    </div>
                    
                <?php }
                
            ?>
        </div>
    </body>
</html>