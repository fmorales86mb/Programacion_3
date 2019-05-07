<?php
    include_once "./01-fwk/archivos.php";
    include_once "./02-entidades/pedido.php";

    class PedidoDb{            
        public static $fileUrlTxt = "./05-data/pedidos.txt";
        
        // Devuelve una lista de objetos Pedido.
        public static function GetPedidos(){
            $objArray = Archivos::ExtraerMatizArchCsv(PedidoDb::$fileUrlTxt);            
            $lista = array();            
            
            for($i =0; $i<count($objArray); $i++){                          
                $item = new Pedido($objArray[$i]);              
                $lista[] = $item;         
            }
    
            return $lista;
        }

        // Devuelve una lista de objetos Pedido con determinado IdProveedor.
        public static function GetPedidoByIdProveedor($idProveedor){
            $objArray = Archivos::ExtraerMatizArchCsv(PedidoDb::$fileUrlTxt);            
            $lista = array();            
            
            for($i =0; $i<count($objArray); $i++){                          
                $item = new Pedido($objArray[$i]);              
                if($item->idProveedor == $idProveedor){
                    $lista[] = $item;
                }                                
            }
    
            return $lista;
        }
    }
?>