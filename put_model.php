<?php
    class Put_Model{
        private $conexion;
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function Put_studies($data1, $data2, $data3){
            $consult = $this->conexion->query("CALL SP_Put_studies('$data1', '$data2', '$data3')");
            return $consult;
        }


        public function Put_documento($data1, $data2){
            $consult = $this->conexion->query("CALL SP_Put_documento('$data1', '$data2')");
            return $consult;            
        }

    }
?>
