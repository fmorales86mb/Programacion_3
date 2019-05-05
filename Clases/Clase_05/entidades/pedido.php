<?php
    class Pedido{
        public $producto;
        public $cantidad;
        public $idProveedor;

        public static $fileUrlTxt = "./data/pedidos.txt";

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