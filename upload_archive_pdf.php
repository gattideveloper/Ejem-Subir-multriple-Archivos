<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'db.php';
    include_once 'put_model.php'; 
    include_once 'get_model.php';
    
    // Funciones
    function Create_Folder($folder) {
        // Creo la carpeta
        mkdir($folder, 0777, true);
    }
        
    //----------------------------->  
        
    // Comprobar si se ha cargado un archivo
    if(isset($_POST['submit'])){ 
               
        // Variable para la Nueva Carpeta
        $paciente_file = $_POST['idPaciente'];
        $destino_file = $_POST['idDestino'];
        $fecha = $_POST['fecha'];

        $name_patient = '';
        $dni_patient = '';
        $name_destiny = '';
        $id_studies = '';
        $insertValuesSQL = '';
           
        //-->Obtengo el Nombre del Paciente
        $Get_ModelP = new Get_Model();
        $get_paciente = $Get_ModelP->Get_patient($paciente_file);
            
        while($data_paciente = mysqli_fetch_assoc($get_paciente)){ 
            $name_patient = $data_paciente['name'];
            $dni_patient = $data_paciente['dni'];
        }

        //-->Obtengo el Nombre del Destino
        $Get_ModelD = new Get_Model();
        $get_destino = $Get_ModelD->Get_destiny($destino_file);
            
        while($data_destino = mysqli_fetch_assoc($get_destino)){ 
            $name_destiny = $data_destino['destiny'];
        }

        $Put_ModelS = new Put_Model();
        $Put_studies = $Put_ModelS->Put_studies($paciente_file, $fecha, $destino_file);
            
        //--> Obtengo el Id
        $Get_ModelS = new Get_Model();
        $get_studios = $Get_ModelS->Get_studies($paciente_file, $fecha, $destino_file);
            
        while($data_studios = mysqli_fetch_assoc($get_studios)){         
            $id_studies = $data_studios['id'];
        }  
            
        // Definir la carpeta de destino
        $carpeta_destino = 'files/' . $dni_patient . '~' . $name_patient . '/'. $name_destiny . '/' . $fecha . '/'; 
        Create_Folder($carpeta_destino);
       
    /////////////////////////////////////////////////////////////////--> 2. Agrego el archivo           

        $allowTypes = array('pdf','doc','docx'); 
        $fileNames = array_filter($_FILES['files']['name']);       

        if(!empty($fileNames)){ 
            foreach($_FILES['files']['name'] as $key=>$val){ 
            
                // Ruta de carga de archivos 
                $fileName = basename($_FILES['files']['name'][$key]); 
                $targetFilePath = $carpeta_destino . $fileName; 
             
                // Compruebe si el tipo de archivo es válido
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
               
                if(in_array($fileType, $allowTypes)){ 
                    // Subir archivo al servidor          
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                        // Archivo db insertar sql
                        $insertValuesSQL .= "('".$id_studies."','".$fileName."'),"; 
                    } 
                }else{ 
                    require_once('Error_Mensaje.php');       
                } 
            }

            if(!empty($insertValuesSQL)){ 
                $insertValuesSQL = trim($insertValuesSQL, ','); 
                // Insertar el nombre del archivo de imagen en la base de datos 
                $insert = $conexion->query("INSERT INTO documento (id_studies, archivo) VALUES $insertValuesSQL"); 
                
                if(!empty($insert)){ 
                    echo "<script language='JavaScript'>
                    alert('Archivo Subido');
                    location.assign('index.php');
                </script>";   
                }else{ 
                    echo "<script language='JavaScript'>
                    alert('Error al subir el archivo: ');
                    location.assign('index.php');
                    </script>";          
                } 
            } 
        } 
    }
?>