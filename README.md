# KN_ET
Evaluacion Tecnica Kainet
Aqui se encuentra el proyecto de la evaluacion tecnica.

Esta separado en 2 carpetas. Front-End y Back-End

En Front-End estan los archivos correspondientes a al front hecho en Angular 17
se uso Angular material, por lo cual hay q instalaro con el comando "ng add @angular/material"

En Back-End estan los archivos correspondientes a al back hecho en Laravel 11.4. 
Hay varias API:
- Metodo GET "http://localhost:8000/api/productos" trae el listado de productos desde la base de datos ordenados por la columna "usoFrecuente"
- Metodo POST "http://localhost:8000/api/posiciones/" permite ingresar una posicion nueva a la base de datos si le ingresamos los 5 parametros que son: 'idEmpresa ', 'idProducto', 'fechaEntregaInicio', 'moneda' y 'precio'. La fecha tiene una validación que solo permite fechas iguales o mayores a la del dia presente. Precio tiene la validacion que tiene que se mayor que 0
- Metodo GET "http://localhost:8000/api/posiciones/" trae como respuesta la union de las tablas "posiciones" y "Productos" y los datos estan ordenados por el campo "usoFrecuente"

Se creo el comando de consola "pos:createpos" que se ejecuta "php artisan pos:createpos" y que pide 5 datos para ingresar una posicion nueva a la base de datos.

Se adjunta la base de datos en formato sql

