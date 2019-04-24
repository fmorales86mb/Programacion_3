<?php
    include_once "./entidades/proveedor.php";
    include_once "./acciones/archivos.php";

    class Get{

        public static function GetProveedorByNombre($nombre){
            //$strFilas = Archivos::ExtraerArrayArchTxt(Proveedor::$fileUrl);
            //var_dump($strFilas);
            $listaProveedores;
            var_dump($nombre);
            // for($i =0; i<count($strFilas); $i++){
            //     $proveedor = new Proveedor($strFilas[$i]);

            //     if($proveedor->nombre == $nombre){
            //         $listaProveedores[] = $proveedor;
            //     }
            // }
                return "bla";
            //return json_encode($listaProveedores);
        }

    }
?>