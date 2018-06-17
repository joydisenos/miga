--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,  
  `estado_logico` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_ingreso` int(11) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `usuario_ultima_modificacion` int(11) DEFAULT NULL,
  `ultima_fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `id_categoria` int(11) DEFAULT NULL,  
  `nombre_producto` varchar(60) NOT NULL DEFAULT '',    
  `desc_producto` varchar(60) NOT NULL DEFAULT '',    
  `precio_venta` double DEFAULT NULL,    
  `cantidad` varchar(50) NOT NULL DEFAULT '',  
  `cantidad_descripcion` varchar(20) NOT NULL DEFAULT '',  
  `disponible` int(1) NOT NULL,  
  `estado_logico` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_ingreso` int(11) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `usuario_ultima_modificacion` int(11) DEFAULT NULL,
  `ultima_fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `password` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,  
  `estado_logico` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_ingreso` int(11) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `usuario_ultima_modificacion` int(11) DEFAULT NULL,
  `ultima_fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------