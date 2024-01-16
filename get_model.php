<?php
    class Get_Model{
        private $conexion;
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function Get_studies($data1, $data2, $data3){
            $consult = $this->conexion->query("CALL SP_Get_studies('$data1', '$data2', '$data3')");
            return $consult;
        }        

        public function Get_patient($data1){
            $consult = $this->conexion->query("CALL SP_Get_patient('$data1')");
            return $consult;
        }

        public function Get_destiny($data1){
            $consult = $this->conexion->query("CALL SP_Get_destiny('$data1')");
            return $consult;
        }

        public function Get_studiesId_Paci($data1){
            $consult = $this->conexion->query("CALL SP_Get_studiesId_Paci('$data1')");
            return $consult;
        }  

        public function Get_studieDestino($data1){
            $consult = $this->conexion->query("CALL SP_Get_studieDestino('$data1')");
            return $consult;
        }

        public function Get_studieData($data1,  $data2, $data3){
            $consult = $this->conexion->query("CALL SP_Get_studieData('$data1', '$data2', '$data3')");
            return $consult;

        }

        public function Get_documentoIdStu($data1){
            $consult = $this->conexion->query("CALL SP_Get_documentoIdStu('$data1')");
            return $consult;

        }
    }
?>