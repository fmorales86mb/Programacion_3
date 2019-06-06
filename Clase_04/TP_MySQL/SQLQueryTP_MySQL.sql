-- 1. Obtener los detalles completos de todos los productos, ordenados alfab�ticamente.
SELECT *
FROM productos
ORDER BY productos.pNombre AND productos.Tama�o;

-- 2. Obtener los detalles completos de todos los proveedores de �Quilmes�.
SELECT *
FROM provedores
WHERE
	provedores.Localidad LIKE 'Quilmes';
    
-- 3. Obtener todos los env�os en los cuales la cantidad este entre 200 y 300 inclusive.
SELECT *
FROM envios
WHERE
	envios.Cantidad >= 200 AND
    envios.Cantidad <= 300;

-- 4. Obtener la cantidad total de todos los productos enviados.
SELECT SUM(envios.Cantidad)
FROM envios;

-- 5. Mostrar los primeros 3 n�meros de productos que se han enviado.

-- 6. Mostrar los nombres de proveedores y los nombres de los productos enviados.
SELECT provedores.Nombre, productos.pNombre 
FROM provedores, productos, envios 
WHERE envios.Numero = provedores.Numero AND envios.pNumero = productos.pNumero 

-- 7. Indicar el monto (cantidad * precio) de todos los env�os.
SELECT envios.Cantidad * productos.Precio AS Monto
FROM envios, productos
WHERE 
	envios.pNumero = productos.pNumero
	
-- 8. Obtener la cantidad total del producto 1 enviado por el proveedor 102.
SELECT SUM(envios.Cantidad)
FROM envios
WHERE
	envios.pNumero = 1 AND
    envios.Numero = 102

-- 9. Obtener todos los n�meros de los productos suministrados por alg�n proveedor de �Avellaneda�.
SELECT envios.pNumero
FROM envios, provedores
WHERE
	envios.Numero = provedores.Numero AND
	provedores.Localidad LIKE 'Avellaneda';

-- 10. Obtener los domicilios y localidades de los proveedores cuyos nombres contengan la letra �I�.
SELECT provedores.Domicilio, provedores.Localidad
FROM provedores
WHERE 
	provedores.Nombre LIKE '%i%';

-- 11. Agregar el producto n�mero 4, llamado �Chocolate�, de tama�o chico y con un precio de 25,35.
INSERT INTO productos(productos.pNombre, productos.Precio, productos.Tama�o) 
VALUES ('Chocolate', 25.35, 'Chico');

-- 12. Insertar un nuevo proveedor (�nicamente con los campos obligatorios).
INSERT INTO provedores () VALUES ();

-- 13. Insertar un nuevo proveedor (107), donde el nombre y la localidad son �Rosales� y �La Plata�.
INSERT INTO provedores (provedores.Numero, provedores.Nombre, provedores.Localidad) 
VALUES (107, 'Rosales', 'La Plata');

-- 14. Cambiar los precios de los productos de tama�o �grande� a 97,50.
UPDATE productos SET productos.Precio=97.5
WHERE 
	productos.Tama�o LIKE 'Grande';

-- 15. Cambiar el tama�o de �Chico� a �Mediano� de todos los productos cuyas cantidades sean mayores a 300 inclusive.
UPDATE productos 
SET productos.Tama�o = 'Mediano'
WHERE 
	productos.Tama�o LIKE 'Chico' AND
    productos.Precio > 300;

-- 16. Eliminar el producto n�mero 1.
DELETE FROM productos
WHERE 
	productos.pNumero = 1;

-- 17. Eliminar a todos los proveedores que no han enviado productos.


