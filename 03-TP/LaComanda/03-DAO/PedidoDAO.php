<?php    
    include_once "./02-Entidades/Pedido.php";
    include_once "./03-DAO/AccesoDatos.php";      

    class PedidoDAO{   
        const CLASSNAME = 'Pedido';
        
        #region Métodos
        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function Insert($elemento){
            $retorno = true;                       
            $query = "INSERT INTO `pedido`(`producto_id`, `codigo_comanda`) VALUES (:producto, :comanda)";                         
                             
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':producto',  $elemento->producto, PDO::PARAM_INT); 
                $sentencia->bindValue(':comanda',  $elemento->comanda, PDO::PARAM_STR);                                  
                
                $sentencia->execute();                                                                           
            } catch (PDOException $e) {
                $retorno = false;
            }
        
            return $retorno;
        }   
        
        public static function GetCantidadOperacionesPorSector($sector){
            $retorno = false;           
            $query = 
            "SELECT COUNT(producto.sector) as :sector
            FROM pedido, producto
            WHERE 
                pedido.producto_id = producto.id AND
                producto.sector = :sector";
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query);                 
                $sentencia->bindValue(':sector',  $sector, PDO::PARAM_STR);

                $sentencia->execute();                 
                $retorno = $sentencia->fetchAll(PDO::FETCH_ASSOC);                                                   
            } catch (PDOException $e) {
                $retorno = false;                  
            }
            
            return $retorno;
        }
    }
?>