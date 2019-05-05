<?php
    include_once "./acciones/archivos.php";
    include_once "./entidades/pedido.php";

    class PedidoDb{
            
        public static function GetPedidos(){
            $objArray = Archivos::ExtraerMatizArchCsv(Pedido::$fileUrlTxt);            
            $lista;            
            
            for($i =0; $i<count($objArray); $i++){                          
                $item = new Pedido($objArray[$i]);              
                $lista[] = $item;         
            }
    
            return $lista;
        }
    }
?>