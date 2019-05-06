<?php
    include_once "./entidades/proveedor.php";
    include_once "./entidades/pedido.php";
    include_once "./acciones/get.php";
    include_once "./acciones/imagenes.php";

    class Post{
        
        public static function CargarProveedor($data, $file){                                 
            return ProveedorDb::GuardarProveedor($data, $file);
        }

        public static function CargarPedido($data){            
            $pedido = new Pedido($data);            
            $dataProveedor = Get::GetProveedorById($pedido->idProveedor);
            $retorno = "No existe el Proveedor";            
            if($dataProveedor != false){
                $retorno = Archivos::EscribirLineaArch(Pedido::$fileUrlTxt, $pedido->ToTxt());
            }

            return $retorno;
        }

        public static function modificarProveedor($data, $file){
            return ProveedorDb::UpdateProveedor($data, $file);
        }
    }

?>