<?php 
 include_once 'conexion/conexion.php'; 
 include_once 'run_model.php'; 
 $Run_ModeD = new Run_Model();
 $Run_ModeP = new Run_Model();
 $Run_Destiny = $Run_ModeD->Run_destiny();

 $Run_Paciente = $Run_ModeP->Run_paciente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Agregar</title>

    <link rel="stylesheet" href="css/main_style.css" >
</head>
<body>
    <main id="conteiner">
        <div id="box">
            <form action="upload_archive_pdf.php" method="post" enctype="multipart/form-data">
                
                <!-- Paciente -->
                <label for="paciente">Paciente</label>
                <select class= "selector" name="idPaciente">
                    <option value="0">Seleccione:</option>
                    <?php  
                        while($get_paciente = mysqli_fetch_assoc($Run_Paciente)){ ?>
                            <option  value="<?php echo $get_paciente['id']; ?>"> <?php echo $get_paciente['dni'] . ' - ' . $get_paciente['name'];?></option>
                    <?php } ?>
                </select>     
                <hr>
                <!-- Destino -->
                <label for="destino">Destino</label>
                <select class= "selector" name="idDestino">
                    <option value="0">Seleccione:</option>
                    <?php  
                    while($get_destiny = mysqli_fetch_assoc($Run_Destiny)){ ?>
                        <option  value="<?php echo $get_destiny['id']; ?>"> <?php echo $get_destiny['destiny'];?></option>
                    <?php } ?>         
                </select>  
                
                <hr> 

                <label for='fecha'>Fecha *</label>
                <input class='fecha' type='date' name='fecha' required='required'><br/>

                <hr> 

                <div>
                    <label for="yourPassword" class="form-label">Multiple Archivo (WORD & PDF)</label>
                    <input type="file" name="files[]" multiple id="archivo" class="form-control" required>
                </div>

                </br>
                <input type="submit" name="submit" value="UPLOAD">
            </form>

            <hr>
        </div>
    </main>
</body>
</html>