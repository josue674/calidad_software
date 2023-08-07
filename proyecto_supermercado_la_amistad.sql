create schema proyecto_supermercado_la_amistad;
use proyecto_supermercado_la_amistad;
CREATE TABLE tb_Provincia (
  id_Provincia INT AUTO_INCREMENT PRIMARY KEY,
  Provincia VARCHAR(50)
);

-- Crear tabla tb_Canton
CREATE TABLE tb_Canton (
  id_Canton INT AUTO_INCREMENT PRIMARY KEY,
  Canton VARCHAR(50),
  id_Provincia INT,
  FOREIGN KEY (id_Provincia) REFERENCES tb_Provincia(id_Provincia)
);

-- Crear tabla tb_Distrito
CREATE TABLE tb_Distrito (
  id_Distrito INT AUTO_INCREMENT PRIMARY KEY,
  Distrito VARCHAR(50),
  id_Canton INT,
  FOREIGN KEY (id_Canton) REFERENCES tb_Canton(id_Canton)
);

-- Crear tabla tb_Direccion
CREATE TABLE tb_Direccion (
  id_Direccion INT PRIMARY KEY AUTO_INCREMENT,
  Provincia INT,
  FOREIGN KEY (Provincia) REFERENCES tb_Provincia(id_Provincia),
  Otras_senas VARCHAR(100),
  Canton INT,
  FOREIGN KEY (Canton) REFERENCES tb_Canton(id_Canton),
  Distrito INT,
  FOREIGN KEY (Distrito) REFERENCES tb_Distrito(id_Distrito)
);

CREATE TABLE tb_Categoria (
    id_Categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre_Categoria VARCHAR(50),
    descripcion VARCHAR(50)
);

CREATE TABLE tb_Marca (
    id_Marca INT PRIMARY KEY AUTO_INCREMENT,
    nombre_Marca VARCHAR(50)
);

CREATE TABLE tb_Lote (
    id_Lote INT PRIMARY KEY AUTO_INCREMENT,
    Fecha_Produccion DATE,
    Fecha_Vencimiento DATE
);

CREATE TABLE tb_Proveedor (
    id_Proveedor INT PRIMARY KEY AUTO_INCREMENT,
    nombreProveedor VARCHAR(50),
    identificacion INT,
    correo VARCHAR(80),
    telefono INT,
    id_Direccion INT,
    estado bit,
    FOREIGN KEY (id_Direccion) REFERENCES tb_Direccion(id_Direccion)
);

CREATE TABLE tb_Cliente (
    idCliente INT PRIMARY KEY AUTO_INCREMENT,
    identificacion INT,
    Nombre VARCHAR(50),
    PrimerApellido VARCHAR(50),
    SegundApellido VARCHAR(50),
    Correo VARCHAR(50),
    telefono INT,
    id_Direccion INT,
    estado bit,
    FOREIGN KEY (id_Direccion) REFERENCES tb_Direccion(id_Direccion)
);

CREATE TABLE tb_Usuario_Rol (
    id_usuario_Rol INT PRIMARY KEY AUTO_INCREMENT,
    nombre_Rol VARCHAR(50),
    descripcion_Rol varchar(50)
);

CREATE TABLE tb_Empleado (
    id_Empleado INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50),
    PrimerApellido VARCHAR(50),
    SegundoApellido VARCHAR(50),
    correo VARCHAR(50),
    telefono VARCHAR(50),
    Salario DOUBLE,
    contrasena VARCHAR(50),
    num_identificacion INT,
    fecha_Nacimiento DATE,
    horas_labor INT,
    id_Direccion INT,
    estado bit,
    id_usuario_Rol INT,
    FOREIGN KEY (id_Direccion) REFERENCES tb_Direccion(id_Direccion),
    FOREIGN KEY (id_usuario_Rol) REFERENCES tb_Usuario_Rol(id_usuario_Rol)
);

CREATE TABLE tb_Producto (
    id_Producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre_Producto VARCHAR(50),
    cantidad_Disponible INT,
    precio_Venta DOUBLE,
    descripcion VARCHAR(50),
    id_Lote INT,
    id_Marca INT,
    id_Categoria INT,
    id_Proveedor INT,
    FOREIGN KEY (id_Lote) REFERENCES tb_Lote(id_Lote),
    FOREIGN KEY (id_Marca) REFERENCES tb_Marca(id_Marca),
    FOREIGN KEY (id_Categoria) REFERENCES tb_Categoria(id_Categoria),
    FOREIGN KEY (id_Proveedor) REFERENCES tb_Proveedor(id_Proveedor)
);

CREATE TABLE tb_compra (
    id_Compra INT PRIMARY KEY,
    fecha_Factura DATE,
    idCliente INT,
    id_Empleado INT,
    FOREIGN KEY (idCliente) REFERENCES tb_Cliente(idCliente),
    FOREIGN KEY (id_Empleado) REFERENCES tb_Empleado(id_Empleado)
);

CREATE TABLE tb_detalle_Compra (
	id_detalle_Compra INT PRIMARY KEY ,
	cantidad_Venta INT,
	id_Producto INT,
    id_Compra int,
    FOREIGN KEY (id_Producto) REFERENCES tb_Producto(id_Producto),
    FOREIGN KEY (id_Compra) REFERENCES tb_compra(id_Compra)
);

CREATE TABLE tb_Factura (
    id_Factura INT PRIMARY KEY AUTO_INCREMENT,
    fecha_Factura DATE,
    idCliente INT,
    id_Empleado INT,
    FOREIGN KEY (idCliente) REFERENCES tb_Cliente(idCliente),
    FOREIGN KEY (id_Empleado) REFERENCES tb_Empleado(id_Empleado)
);

CREATE TABLE tb_detalle_Factura (
    id_detalleFactura INT PRIMARY KEY AUTO_INCREMENT,
    cantidad_Venta INT,
    id_Producto INT,
    id_Factura int,
    FOREIGN KEY (id_Producto) REFERENCES tb_Producto(id_Producto),
    FOREIGN KEY (id_Factura) REFERENCES tb_Factura(id_Factura)
);
select * from tb_cliente;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AgregarProducto` (IN `pidProducto` INT, IN `pidFactura` INT,IN `pCantidadProducto` INT)   
BEGIN
	if(select 1 from tb_detalle_Factura where  pidProducto = id_Producto and id_Factura = pidFactura)then
		update tb_Producto set cantidad_Disponible = cantidad_Disponible-pCantidadProducto where pidProducto = id_Producto;
		update tb_detalle_Factura set cantidad_Venta = cantidad_Venta + pCantidadProducto where  pidProducto = id_Producto and id_Factura = pidFactura;
    else
		insert into tb_detalle_Factura(cantidad_Venta,id_Producto,id_Factura) values(pCantidadProducto,pidProducto,pidFactura);
        update tb_Producto set cantidad_Disponible = cantidad_Disponible-pCantidadProducto where pidProducto = id_Producto;
    end if;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDetalleCompra`(IN `pIdCompra` INT)
BEGIN
Select d.cantidad_Venta,p.nombre_Producto,p.precio_Venta
from 
tb_detalle_Compra d
INNER JOIN tb_Producto p ON p.id_Producto = d.id_Producto
where d.id_Compra = pIdCompra;
end$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerCompras`()
BEGIN
select d.id_Compra, d.fecha_Factura ,c.Nombre as Cliente,e.Nombre as Empleado
from tb_compra d
inner join tb_cliente c on d.idCliente = c.idCliente
inner join tb_empleado e on d.id_Empleado = e.id_Empleado
;
end$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarProducto` (IN `pidProducto` INT, IN `pidFactura` INT,IN `pCantidadProducto` INT)   
BEGIN
	update tb_Producto set cantidad_Disponible = cantidad_Disponible + pCantidadProducto where pidProducto = id_Producto;
	delete from tb_detalle_Factura where  pidProducto = id_Producto and id_Factura = pidFactura;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarFactura` (IN `pidFactura` INT)   
BEGIN
    INSERT INTO tb_compra(id_Compra,fecha_Factura,idCliente,id_Empleado)
	select id_Factura,fecha_Factura,idCliente,id_Empleado
	FROM tb_factura
    where id_Factura = pidFactura;
    
	INSERT INTO tb_detalle_compra(id_detalle_Compra,cantidad_Venta,id_Producto,id_Compra)
    SELECT id_detalleFactura,cantidad_Venta,id_Producto,id_Factura FROM tb_detalle_factura
    where  id_Factura = pidFactura;

	delete from tb_detalle_Factura where id_Factura = pidFactura;
    delete from tb_Factura where  id_Factura = pidFactura;
END$$

select * from tb_compra;
select * from tb_detalle_compra;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDetalleFactura` (IN `pidFactura` INT)   
BEGIN
	select p.nombre_Producto,p.precio_Venta,d.cantidad_Venta,d.id_Factura,d.id_Producto
    from tb_detalle_factura d
    inner join tb_producto p on p.id_Producto = d.id_Producto
    where pidFactura = id_Factura;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearFactura` (
IN `pidCliente` INT, 
IN `pidEmpleado` INT,
OUT `pidFactura` INT) 
BEGIN
	insert into tb_Factura(fecha_Factura, idCliente, id_Empleado) values (NOW(), pidCliente, pidEmpleado);
    set pidFactura = Last_insert_id();
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidacionSesion` (IN `pCorreo` VARCHAR(80), IN `pContrasena` INT)   BEGIN
SELECT 	id_Empleado,
		num_identificacion,
    	correo,
        estado,
        U.id_usuario_Rol,
        R.nombre_Rol
  	FROM 	tb_Empleado U
    INNER JOIN tb_usuario_rol R ON U.id_usuario_Rol = R.id_usuario_Rol
    WHERE 	correo = pCorreo
    	AND contrasena = pContrasena
        AND estado= 1;
END$$


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDatosClientes` ()   BEGIN
    SELECT idCliente,
           identificacion,
           Nombre,
           PrimerApellido,
           SegundApellido,
           Correo,
           telefono,
           CASE WHEN estado = 1 THEN 'Activo' ELSE 'Inactivo' END 'DescEstado'
    FROM   tb_cliente;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ElimiarCliente` (IN `pIdCliente` int)   BEGIN
    update tb_cliente set  estado = 0 where idCliente = pIdCliente;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActivarCliente` (IN `pIdCliente` int)   BEGIN
    update tb_cliente set  estado = 1 where idCliente = pIdCliente;
END$$


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDatosCliente` (IN `pIdCliente` int )   BEGIN
    SELECT c.*, d.*, p.*, ca.*, di.*
	FROM tb_Cliente c
	INNER JOIN tb_Direccion d ON c.id_Direccion = d.id_Direccion
	INNER JOIN tb_Provincia p ON d.Provincia = p.id_Provincia
	INNER JOIN tb_Canton ca ON d.Canton = ca.id_Canton
	INNER JOIN tb_Distrito di ON d.Distrito = di.id_Distrito
    where c.idCliente = pIdCliente;
END$$
select * from tb_cliente
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarDatosCliente` (IN `pIdentificacion` int )   BEGIN
    SELECT c.*, d.*, p.*, ca.*, di.*
	FROM tb_Cliente c
	INNER JOIN tb_Direccion d ON c.id_Direccion = d.id_Direccion
	INNER JOIN tb_Provincia p ON d.Provincia = p.id_Provincia
	INNER JOIN tb_Canton ca ON d.Canton = ca.id_Canton
	INNER JOIN tb_Distrito di ON d.Distrito = di.id_Distrito
    where c.identificacion = pIdentificacion;
END$$

select * from tb_Empleado

INSERT INTO tb_usuario_rol (`id_usuario_Rol`,`nombre_Rol`, `descripcion_Rol`) VALUES
(1, 'Administrador','n'),
(2, 'Bodeguero','n'),
(3, 'Vendedor','n');

INSERT INTO tb_direccion(Provincia,Otras_senas,Canton,Distrito)
VALUES (1,'Centro',1,1);

select * from  tb_Provincia;
select * from  tb_Canton;
select * from  tb_Distrito;
select * from  tb_direccion;

INSERT INTO tb_Empleado ( `Nombre`, `PrimerApellido`, `SegundoApellido`,`correo`,`telefono`,
`Salario`,`contrasena`,`num_identificacion`,`fecha_Nacimiento`,`horas_labor`,`id_Direccion`,`estado`,`id_usuario_Rol`) VALUES
('Josue','Aguirre','Pinzon','josueaguirre644@gmail.com',8789394,984994,'0935',19292834,'2023-04-02',2323,1,1,1);

select * from tb_Empleado

DELETE FROM tb_Empleado;

    
-- Insertar datos en tb_Provincia
INSERT INTO tb_Provincia (Provincia) VALUES ('San Jose');
INSERT INTO tb_Provincia (Provincia) VALUES ('Alajuela');
INSERT INTO tb_Provincia (Provincia) VALUES ('Cartago');
INSERT INTO tb_Provincia (Provincia) VALUES ('Heredia');
INSERT INTO tb_Provincia (Provincia) VALUES ('Guanacaste');
INSERT INTO tb_Provincia (Provincia) VALUES ('Puntarenas');
INSERT INTO tb_Provincia (Provincia) VALUES ('Limón');

-- Insertar datos en tb_Canton
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('San Jose', 1);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Escazú', 1);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Desamparados', 1);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Alajuela', 2);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Atenas', 2);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Cartago', 3);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('La Unión', 3);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Heredia', 4);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Barva', 4);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Belén', 4);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Santa Cruz', 5);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Esparza', 5);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Puntarenas', 6);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Quepos', 6);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Limón', 7);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Pococí', 7);
INSERT INTO tb_Canton (Canton, id_Provincia) VALUES ('Siquirres', 7);

INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('Carmen', 1);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('San Francisco', 1);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('San Antonio', 2);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('San Rafael', 2);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('San Rafael', 3);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('San Cristóbal', 3);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('San Josecito', 4);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('Río Segundo', 4);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('San Isidro', 5);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('Barva', 6);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('San Antonio', 7);
INSERT INTO tb_Distrito (Distrito, id_Canton) VALUES ('Concepción', 7);

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerCanton` (IN `pProvincia` int)   BEGIN
	SELECT 	id_Canton,
    		Canton
  	FROM 	tb_canton UobtenerDistrito
    WHERE 	id_Provincia = pProvincia;
END$$
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerDistrito` (IN `pCanton` int)   BEGIN
	SELECT 	id_Distrito,
    		Distrito
  	FROM 	tb_distrito
    WHERE 	id_Canton = pCanton;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerProvincia` ()   BEGIN
	SELECT 	id_Provincia,
    		Provincia
  	FROM 	tb_provincia;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarCleinte` (in pCorreoElectronico varchar(50) ,in pIdentificacion int,
    in pNombre varchar(50) ,in pPrimerApellido varchar(50),in pSegundoApellido varchar(50),in pTelefono int,
    in pProvincia int,in pCanton int,in pDistrito int ,in pOtrasSenales varchar(100))   BEGIN
	insert into tb_direccion(Provincia,Otras_senas,Canton,Distrito) values (pProvincia,pOtrasSenales,pCanton,pDistrito);
    set @id_Direccion = LAST_INSERT_ID();
    insert into tb_cliente(identificacion,Nombre,PrimerApellido,SegundApellido,Correo,telefono,id_Direccion,estado) 
    values(pIdentificacion,pNombre,pPrimerApellido,pSegundoApellido,pCorreoElectronico,pTelefono,@id_Direccion,1);
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarCliente` (in pIdClientein int ,in pCorreoElectronico varchar(50) ,in pIdentificacion int,
    in pNombre varchar(50) ,in pPrimerApellido varchar(50),in pSegundoApellido varchar(50),in pTelefono int,
    in pProvincia int,in pCanton int ,in pDistrito int  ,in pOtrasSenales varchar(100))   BEGIN
    
    if (pProvincia != 0) then
    set @direccion = (select id_Direccion from tb_cliente where pIdClientein = idCliente);
		update tb_direccion set Provincia =pProvincia,Otras_senas =pOtrasSenales,Canton =pCanton
        ,Distrito =pDistrito  where id_Direccion = @direccion;
	end if;
		update tb_cliente set identificacion =pIdentificacion ,Nombre = pNombre,PrimerApellido = pPrimerApellido
		,SegundApellido = pSegundoApellido,Correo = pCorreoElectronico,telefono = pTelefono where pIdClientein = idCliente;        
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarProveedor` (in pCorreoElectronico varchar(50) ,in pIdentificacion int,
    in pNombre varchar(50) ,in pTelefono int, in pProvincia int,in pCanton int,in pDistrito int ,in pOtrasSenales varchar(100))   BEGIN
	insert into tb_direccion(Provincia,Otras_senas,Canton,Distrito) values (pProvincia,pOtrasSenales,pCanton,pDistrito);
    set @id_Direccion = LAST_INSERT_ID();
    insert into tb_proveedor(nombreProveedor,identificacion,correo,telefono,id_Direccion,estado) 
    values(pNombre,pIdentificacion,pCorreoElectronico,pTelefono,@id_Direccion,1);
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDatosProveedores` ()   BEGIN
    SELECT id_Proveedor,
			nombreProveedor,
           identificacion,
           correo,
           telefono,
           CASE WHEN estado = 1 THEN 'Activo' ELSE 'Inactivo' END 'DescEstado'
    FROM   tb_proveedor;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ElimiarProveedor` (IN `pIdProveedor` int)   BEGIN
    update tb_proveedor set  estado = 0 where id_Proveedor = pIdProveedor;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActivarProveedor` (IN `pIdProveedor` int)   BEGIN
    update tb_proveedor set  estado = 1 where id_Proveedor = pIdProveedor;
END$$


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDatosProveedor` (IN `pIdProveedor` int )   BEGIN
    SELECT c.*, d.*, p.*, ca.*, di.*
	FROM tb_proveedor c
	INNER JOIN tb_Direccion d ON c.id_Direccion = d.id_Direccion
	INNER JOIN tb_Provincia p ON d.Provincia = p.id_Provincia
	INNER JOIN tb_Canton ca ON d.Canton = ca.id_Canton
	INNER JOIN tb_Distrito di ON d.Distrito = di.id_Distrito
    where c.id_Proveedor = pIdProveedor;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarProveedor` (IN pIdProveedor int, in pCorreoElectronico varchar(50) ,in pIdentificacion int,
    in pNombre varchar(50) ,in pTelefono int, in pProvincia int,in pCanton int,in pDistrito int ,in pOtrasSenales varchar(100))   BEGIN
    
    if (pProvincia != 0) then
    set @direccion = (select id_Direccion from tb_proveedor where pIdProveedor = id_Proveedor);
		update tb_direccion set Provincia =pProvincia,Otras_senas =pOtrasSenales,Canton =pCanton
        ,Distrito =pDistrito  where id_Direccion = @direccion;
	end if;
		update tb_proveedor set identificacion =pIdentificacion ,nombreProveedor = pNombre
        ,correo = pCorreoElectronico,telefono = pTelefono where pIdProveedor = id_Proveedor;       
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarEmpleado` (in pCorreoElectronico varchar(50) ,in pIdentificacion int,
    in pNombre varchar(50),in pPrimerApellido varchar(50),in pSegundoApellido varchar(50),in pSalario double, in pFechaNacimiento date
    ,in pHorasLaborar int,in pTelefono int, in pProvincia int,in pCanton int,in pDistrito int ,in pOtrasSenales varchar(100)
    ,in pContrasenna varchar(50),in pRol int)   BEGIN
    
	insert into tb_direccion(Provincia,Otras_senas,Canton,Distrito) values (pProvincia,pOtrasSenales,pCanton,pDistrito);
    set @id_Direccion = LAST_INSERT_ID();
    
    INSERT INTO tb_Empleado ( `Nombre`, `PrimerApellido`, `SegundoApellido`,`correo`,`telefono`,
    `Salario`,`contrasena`,`num_identificacion`,`fecha_Nacimiento`,`horas_labor`,`id_Direccion`,`estado`,`id_usuario_Rol`) VALUES
    (pNombre,pPrimerApellido,pSegundoApellido,pCorreoElectronico,pTelefono,pSalario,pContrasenna,pIdentificacion,pFechaNacimiento,pHorasLaborar
    ,@id_Direccion,1,pRol);
    
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDatosEmpleados` ()   BEGIN
    SELECT id_Empleado,
			Nombre,
           PrimerApellido,
           SegundoApellido,
           correo,
           telefono,
           Salario,
           num_identificacion,
           fecha_Nacimiento,
           horas_labor,       
           r.*,
           CASE WHEN estado = 1 THEN 'Activo' ELSE 'Inactivo' END 'DescEstado'
    FROM   tb_empleado c  
    inner join tb_usuario_rol r on r.id_usuario_Rol = c.id_usuario_Rol;
END$$
select * from tb_usuario_rol
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarEmpleado` (IN `pIdEmpleado` int)   BEGIN
    update tb_empleado set  estado = 0 where id_Empleado = pIdEmpleado;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerRol` ()   BEGIN
   select id_usuario_Rol, nombre_rol from tb_usuario_rol;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActivarEmpleado` (IN `pIdEmpleado` int)   BEGIN
    update tb_empleado set  estado = 1 where id_Empleado = pIdEmpleado;
END$$
select * from tb_empleado

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDatosEmpleado` (IN `pIdEmpleado` int )   BEGIN
    SELECT c.*, d.*, p.*, ca.*, di.*,r.*
	FROM tb_empleado c
	INNER JOIN tb_Direccion d ON c.id_Direccion = d.id_Direccion
	INNER JOIN tb_Provincia p ON d.Provincia = p.id_Provincia
	INNER JOIN tb_Canton ca ON d.Canton = ca.id_Canton
	INNER JOIN tb_Distrito di ON d.Distrito = di.id_Distrito
    inner join tb_usuario_rol r on r.id_usuario_Rol = c.id_usuario_Rol
    where c.id_Empleado = pIdEmpleado;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarEmpleado` (IN pIdEmpleado int, in pCorreoElectronico varchar(50) ,in pIdentificacion int,
    in pNombre varchar(50),in pPrimerApellido varchar(50),in pSegundoApellido varchar(50),in pSalario double, in pFechaNacimiento date
    ,in pHorasLaborar int,in pTelefono int, in pProvincia int,in pCanton int,in pDistrito int ,in pOtrasSenales varchar(100)
    ,in pContrasenna varchar(50),in pRol int)   BEGIN
    
    if (pProvincia != 0) then
    set @direccion = (select id_Direccion from tb_empleado where pIdEmpleado = id_Empleado);
		update tb_direccion set Provincia =pProvincia,Otras_senas =pOtrasSenales,Canton =pCanton
        ,Distrito =pDistrito  where id_Direccion = @direccion;
	end if;
    if(pContrasenna != null)then
		update tb_empleado set contrasenna = pContrasenna where pIdEmpleado = id_Empleado;
    end if;
    if(pRol != 0)then
		update tb_empleado set id_usuario_Rol = pRol where pIdEmpleado = id_Empleado;
    end if;
		update tb_empleado set Nombre =pNombre ,PrimerApellido = pPrimerApellido,SegundoApellido = pSegundoApellido,
        correo = pCorreoElectronico,telefono = pTelefono,Salario = pSalario,fecha_Nacimiento = pFechaNacimiento,
        horas_labor = pHorasLaborar where pIdEmpleado = id_Empleado;       
END$$
select * from tb_proveedor;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarProducto` (
    in pNombre varchar(50),in pCantidad int,in pPrecio double, in pDescripcionProducto varchar(50),
    in pFechaProduccion date,in pFechaVencimiento date ,
    in pMarca varchar(50),
    in pCategoria varchar(50),in pdescripcionCategoria varchar(50),
    in pProveedor int)   BEGIN
    
	insert into tb_lote(Fecha_Produccion,Fecha_Vencimiento) values (pFechaProduccion,pFechaVencimiento);
    set @id_lote = LAST_INSERT_ID();
    insert into tb_marca(nombre_Marca) values (pMarca);
    set @id_marca = LAST_INSERT_ID();
    insert into tb_categoria(nombre_Categoria,descripcion) values (pCategoria,pdescripcionCategoria);
    set @id_categoria = LAST_INSERT_ID();
    
    insert into tb_producto(nombre_Producto,cantidad_Disponible,precio_Venta,descripcion,id_Lote,id_Marca,id_Categoria,id_Proveedor) 
    values(pNombre,pCantidad,pPrecio,pDescripcionProducto,@id_lote,@id_marca,@id_categoria,pProveedor);
    
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerProveedor` ()   BEGIN
	SELECT 	id_Proveedor,
    		nombreProveedor
  	FROM 	tb_proveedor;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDatosProductos` ()   BEGIN
    SELECT p.id_Producto, p.nombre_Producto, p.cantidad_Disponible, p.precio_Venta, p.descripcion, 
    l.Fecha_Produccion, l.Fecha_Vencimiento, m.nombre_Marca, 
    c.nombre_Categoria, c.descripcion as descripcion_Categoria, 
    pv.nombreProveedor
    FROM tb_Producto p
    INNER JOIN tb_lote l ON p.id_Lote = l.id_Lote
    INNER JOIN tb_marca m ON p.id_Marca = m.id_Marca
    INNER JOIN tb_categoria c ON p.id_Categoria = c.id_Categoria
    INNER JOIN tb_proveedor pv ON p.id_Proveedor = pv.id_Proveedor;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerDatosProducto` (IN `pIdProducto` int )   BEGIN
    SELECT p.id_Producto, p.nombre_Producto, p.cantidad_Disponible, p.precio_Venta, p.descripcion, 
    l.Fecha_Produccion, l.Fecha_Vencimiento, m.nombre_Marca, 
    c.nombre_Categoria, c.descripcion as descripcion_Categoria, 
    pv.nombreProveedor,pv.id_Proveedor
    FROM tb_Producto p
    INNER JOIN tb_lote l ON p.id_Lote = l.id_Lote
    INNER JOIN tb_marca m ON p.id_Marca = m.id_Marca
    INNER JOIN tb_categoria c ON p.id_Categoria = c.id_Categoria
    INNER JOIN tb_proveedor pv ON p.id_Proveedor = pv.id_Proveedor
    where p.id_Producto = pIdProducto;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarProducto` (
	in pidProducto int ,in pNombre varchar(50),in pCantidad int,in pPrecio double, in pDescripcionProducto varchar(50),in pProveedor int)   BEGIN
		update tb_Producto set cantidad_Disponible = pCantidad ,precio_Venta = pPrecio ,descripcion = pDescripcionProducto ,id_Proveedor = pProveedor
        where id_Producto = pidProducto;       
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarProducto` (in pNombre varchar(50))   BEGIN
	if pNombre = '' 
    then
	SELECT id_Producto, nombre_Producto, cantidad_Disponible, precio_Venta
    FROM tb_Producto;     
    else
    SELECT id_Producto, nombre_Producto, cantidad_Disponible, precio_Venta
    FROM tb_Producto 
    where nombre_Producto = pNombre; 
    end if;
END$$

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UltimoConsecutivo` ()   BEGIN
	SELECT MAX(nombre_de_columna) FROM nombre_de_tabla;
END$$


