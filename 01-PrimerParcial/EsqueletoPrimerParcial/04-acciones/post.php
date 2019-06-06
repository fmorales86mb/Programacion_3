<?php
    include_once "./02-entidades/proveedor.php";
    include_once "./02-entidades/pedido.php";
    include_once "./04-acciones/get.php";
    include_once "./01-fwk/imagenes.php";

    class Post{
        
        public static function CargarProveedor($data, $file){                                 
            return ProveedorDb::GuardarProveedor($data, $file);
        }

        public static function CargarPedido($data){            
            $pedido = new Pedido($data);            
            $dataProveedor = Get::GetProveedorById($pedido->idProveedor);
            $retorno = "No existe el Proveedor";            
            
            if($dataProveedor != false){
                $retorno = Archivos::EscribirLineaArch(PedidoDb::$fileUrlTxt, $pedido->ToTxt());
            }

            return $retorno;
        }

        public static function modificarProveedor($data, $file){
            return ProveedorDb::UpdateProveedor($data, $file);
        }
    }

?>