<?php
    class Pedido{
        public $producto;
        public $cantidad;
        public $idProveedor;        

        function __construct($strArray){
            $this->producto = $strArray["producto"];
            $this->cantidad = $strArray["cantidad"];
            $this->idProveedor = $strArray["idProveedor"];            
        }
        
        function ToTxt(){
            return "producto:$this->producto,cantidad:$this->cantidad,idProveedor:$this->idProveedor,";
        }
        
    }
?>