<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'get_model.php'; 

    // Obtener el nombre del archivo desde la URL
    $id_paciente = $_GET["p"];
    $id_destino = $_GET["d"];
    $id_studio = $_GET["s"];

    $archivo = $_GET["archivo"];

    if(!preg_match('/^[A-Za-z0-9- ]+\.pdf$/', $archivo)){
        echo "<p>Nombre de archivo invalido</p>";
        exit;
    }

    $name_patient = '';
    $dni_patient = '';
    $name_destiny = '';
    $id_studies = '';
    $fecha = '';

    //-->Obtengo el Nombre del Paciente
    $Get_ModelP = new Get_Model();
    $get_paciente = $Get_ModelP->Get_patient($id_paciente);
        
    while($data_paciente = mysqli_fetch_assoc($get_paciente)){ 
        $name_patient = $data_paciente['name'];
        $dni_patient = $data_paciente['dni'];
    }

    //-->Obtengo el Nombre del Destino
    $Get_ModelD = new Get_Model();
    $get_destino = $Get_ModelD->Get_destiny($id_destino);
        
    while($data_destino = mysqli_fetch_assoc($get_destino)){ 
        $name_destiny = $data_destino['destiny'];
    }

    $Get_ModelDS = new Get_Model();
    $get_studie = $Get_ModelDS->Get_studieData($id_paciente,  $id_destino, $id_studio);

    while($data_studie = mysqli_fetch_assoc($get_studie)){ 
        $date = $data_studie['date'];
        $fecha = date("Y-m-d", strtotime($date));
    }

    $carpetas = 'files/' . $dni_patient . '~' . $name_patient . '/'. $name_destiny . '/' . $fecha . '/' . $archivo; 

    $mi_pdf = fopen ("$carpetas", "r");
    if (!$mi_pdf) {
        echo "<p>No puedo abrir el archivo para lectura</p>";
        exit;
    }

    header('Content-type: application/pdf');

    fpassthru($mi_pdf);  
    fclose ($archivo);
?>