<?php
    include_once "./entidades/proveedor.php";
    include_once "./entidades/pedido.php";
    include_once "./db/proveedorDb.php";
    include_once "./db/pedidoDb.php";    

    class Get{

        // Devuelve una lista de proveedores con determinado nombre en formato Json.
        public static function GetProveedorByNombre($nombre){
            $lista = ProveedorDb::GetProveedoresByNombre($nombre);
            $strRespuesta;                              
  
            if(count($lista)<1){
                $strRespuesta = "No existe proveedor $nombre.";
            }
            else{
                for($i=0; $i<count($lista); $i++){
                    $strRespuesta[] = $lista[$i];
                }                
            }
            
            return json_encode($strRespuesta);
        }

        // Devuelve la lista de proveedores en formato Json. 
        public static function GetProveedores(){
            $listaProveedores = ProveedorDb::GetProveedores();
            return json_encode($listaProveedores);
        }

        // Devuelve un proveedor con determinado id en formato Json.
        public static function GetProveedorById($id){                        
            $proveedor = ProveedorDb::GetProveedorById($id);
            $strRespuesta = "Error GetProveedorById";

            if($proveedor == null){
                $strRespuesta = false;
            }
            else{
                $strRespuesta = json_encode($proveedor);
            }
            
            return $strRespuesta;
        }

        // Devuelve la lista de pedidos en formato Json. 
        public static function GetPedidos(){
            $listaPedidos = PedidoDb::GetPedidos();
            return json_encode($listaPedidos);
        }  
        
        public static function GetPedidosProveedor(){
            $listaPedidos = PedidoDb::GetPedidos();
            $listaResultado;

            foreach($listaPedidos as $pedido){
                $proveedor = ProveedorDb::GetProveedorById($pedido->idProveedor);
                $item = array(
                    "producto" => $pedido->producto,
                    "cantidad" => $pedido->cantidad,
                    "idProveedor" => $pedido->idProveedor,
                    "nombre" => $proveedor->nombre
                );

                $listaResultado[] = $item;
            }
            
            return json_encode($listaResultado);                                                
        }

        public static function GetPedidosByIdProveedor($idProveedor){
            $lista = PedidoDb::GetPedidoByIdProveedor($idProveedor);
            return json_encode($lista);
        }
    }
?>