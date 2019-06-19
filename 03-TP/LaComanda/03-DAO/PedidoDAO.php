<?php
    include_once "./02-Entidades/Identificadores.php";
    include_once "./02-Entidades/Pedido.php";
    include_once "./03-DAO/AccesoDatos.php"; 
    include_once './05-Interfaces/IDaoABM.php';   

    class PedidoDAO implements IDaoABM{   
        const CLASSNAME = 'Pedido';
        
        // Traigo lista de pedidos por rol encargado y estado del pedido.
        public static function GetPedidosByRolEstado($rol, $estado){
            $retorno = null;           
            
            $query = "SELECT * 
                    FROM pedido as pe, producto as pr
                    WHERE 
                        pe.producto_id = pr.id AND
                        pr.rol_encargado = :rol AND
                        pe.estado_id = :estado";
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':rol',  $id, PDO::PARAM_INT);
                $sentencia->bindValue(':estado',  $id, PDO::PARAM_INT); 
                
                $sentencia->execute();                 
                $retorno = $sentencia->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);                                                                                     
            } catch (PDOException $e) {
                $retorno = -1;                  
            }
            
            return $retorno;
        }   

        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function Insert($elemento){
            $retorno = false;           
            
            $query = "INSERT INTO `pedido`(`comanda_id`, `producto_id`, `estado_id`, `tiempo_estimado`) 
                    VALUES (:comanda, :producto, :estado, :tiempo)";                        

            if ($sector_id !== null){
                try{
                    $db = AccesoDatos::DameUnObjetoAcceso();                 
                    $sentencia = $db->RetornarConsulta($query);
                    $sentencia->bindValue(':comanda',  $elemento->nombre, PDO::PARAM_STR);
                    $sentencia->bindValue(':producto',  $elemento->rolEncargado, PDO::PARAM_INT); 
                    $sentencia->bindValue(':estado',  $elemento->precio, PDO::PARAM_INT); 
                    $sentencia->bindValue(':tiempo',  $elemento->precio, PDO::PARAM_INT);                 
                    
                    $sentencia->execute();                     
                    $retorno = true;                                                                          
                } catch (PDOException $e) {
                    $retorno = false;
                }
            }
            
            return $retorno;
        }

        // Modifica los datos de un elemento en la DB por el id.
        // public static function Update($elemento){
        //     $retorno = null;           
        //     $query = "UPDATE `producto` SET `nombre`= :nombre,`rol_encargado`= :rol,`precio`= :precio WHERE id = :id";                    
            
        //     if ($sector_id !== null){
        //         try{
        //             $db = AccesoDatos::DameUnObjetoAcceso();                 
        //             $sentencia = $db->RetornarConsulta($query); 
        //             $sentencia->bindValue(':id',  $elemento->id, PDO::PARAM_INT);
        //             $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
        //             $sentencia->bindValue(':rol',  $elemento->rolEncargado, PDO::PARAM_INT); 
        //             $sentencia->bindValue(':precio',  $elemento->precio, PDO::PARAM_INT);   
                    
        //             $sentencia->execute();                     
        //             $retorno = $sentencia->fetch();                                  
        //         } catch (PDOException $e) {
        //             $retorno = -1;
        //         }
        //     }
        //     return $retorno;
        // }        
    }
?>