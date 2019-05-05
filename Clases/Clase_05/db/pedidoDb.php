<?php
    include_once "./acciones/archivos.php";
    include_once "./entidades/pedido.php";

    class PedidoDb{
            
        // Devuelve una lista de objetos Pedido.
        public static function GetPedidos(){
            $objArray = Archivos::ExtraerMatizArchCsv(Pedido::$fileUrlTxt);            
            $lista;            
            
            for($i =0; $i<count($objArray); $i++){                          
                $item = new Pedido($objArray[$i]);              
                $lista[] = $item;         
            }
    
            return $lista;
        }

        // Devuelve una lista de objetos Pedido con determinado IdProveedor.
        public static function GetPedidoByIdProveedor($idProveedor){
            $objArray = Archivos::ExtraerMatizArchCsv(Pedido::$fileUrlTxt);            
            $lista;            
            
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