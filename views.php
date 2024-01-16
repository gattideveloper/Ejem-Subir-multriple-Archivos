<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'run_model.php';
    include_once 'get_model.php';
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Parte 1 - Donde les marca todo los estudios que se hizo</title>
        <link rel="stylesheet" href="css/menuData_style.css">
    </head>
    
    <body>

        <div class="BoxMenu">
            <?php 
                $Run_Model = new Run_Model();
                $run_studie = $Run_Model->Run_Simplistudies();
                
                while($studie = mysqli_fetch_assoc($run_studie)){ 

                    $id_paciente = $studie['id_patient'];

                    $Get_ModelP = new Get_Model();
                    $getPaciente = $Get_ModelP->Get_patient($id_paciente);
                    
                    while($paciente = mysqli_fetch_assoc($getPaciente)){ 
                    
                        $name = $paciente['name'];
                        $dni = $paciente['dni']; ?>
       
                        <div class="menu">
                            <h6><?php echo $name;?></h6>
                            <p><?php echo $dni;?></p>
                            <a href="paso-2.php?p=<?php echo $id_paciente;?>">Ver</a>
                        </div>
                    
                    <?php }
                }
            ?>
        </div>

    </body>
</html>      