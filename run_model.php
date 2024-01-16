<?php
    class Run_Model{
        private $conexion;
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function Run_destiny(){
            $consult = $this->conexion->query("CALL SP_Run_Destiny()");
            return $consult;
        }

        public function Run_paciente(){
            $consult = $this->conexion->query("CALL SP_Run_Paciente()");
            return $consult;
        }

        public function Run_Simplistudies(){
            $consult = $this->conexion->query("CALL SP_Run_Simplistudies()");
            return $consult;
        }
    }
?>
