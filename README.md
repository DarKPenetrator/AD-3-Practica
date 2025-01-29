
# AD Practica 3
Se trata de un proyecto Laravel que utiliza Docker para desplegar un contenedor con MariaDB como base de datos.

<br>


## 1. Descripción del problema

El ayuntamiento de Alicante ha solicitado un sistema para gestionar el proceso de prácticas de los alumnos de su municipio. Se pretende centralizar la información de las empresas colaboradoras, las ofertas de prácticas, los tutores asignados y el historial de candidaturas.

De este modo, cada alumno puede inscribirse en ofertas publicadas, mientras que las empresas pueden administrar sus vacantes y supervisar el estado de las candidaturas en tiempo real. Además, el sistema permitirá al centro educativo monitorizar el progreso académico y profesional, facilitando la coordinación con tutores y generando estadísticas sobre el éxito de las prácticas. 

Con ello, se busca agilizar la inserción laboral y mejorar la comunicación entre todos los actores involucrados. Asimismo, al ser una aplicación web, podrá expandirse a diferentes campus de la misma institución, permitiendo un crecimiento escalable que favorezca la colaboración entre sedes y empresas de forma integrada.

Este proyecto tiene un objetivo de bla bla   






## 2. Modelo E-R

![Imagen de Modelo E-R](docs/MER.jpg)

### Relación entre las tablas

1. **Tabla `users`:**
   - Relación **HasOne** con `alumno` y `empresa`.

2. **Tabla `alumno`:**
   - Relación **BelongsTo** con `users`.
   - Relación **BelongsTo** con `centro_educativo`.
   - Relación **HasMany** con `candidatura`.
   - Relación **HasManyThrough** con `tutor` a través de `candidatura`.

3. **Tabla `empresa`:**
   - Relación **BelongsTo** con `users`.
   - Relación **HasMany** con `oferta_de_practica`.

4. **Tabla `oferta_de_practica`:**
   - Relación **BelongsTo** con `empresa`.
   - Relación **HasMany** con `candidatura`.

5. **Tabla `candidatura`:**
   - Relación **BelongsTo** con `alumno`, `oferta_de_practica` y `tutor`.

6. **Tabla `centro_educativo`:**
   - Relación **HasMany** con `alumno`.

7. **Tabla `tutor`:**
   - Relación **HasMany** con `candidatura`.

[Tablas en detalle y explicadas](docs/Tablas.md)


## 3. Implementación





1. **Migraciones**: Se han creado y versionado con Laravel las tablas (`users`, `alumno`, `empresa`, `oferta_de_practica`, `candidatura`, `centro_educativo`, `tutor`) y sus FKs.
2. **Modelos y Relaciones**: Cada tabla cuenta con su modelo Eloquent y las relaciones definidas (1..1, 1..N, etc.).
3. **Seeders**: Cargan datos de prueba coherentes en cada tabla, ejecutándose con `php artisan db:seed`.
4. **Endpoints (API)**: Se exponen métodos **GET, POST, PUT, DELETE** en `routes/api.php`, cumpliendo con los requisitos CRUD.Con un total de 15.
5. **Colección Postman**: Documenta en carpetas (GET, POST, PUT, DELETE) cómo probar los endpoints con ejemplos claros.


[La coleccion de postman explicada de forma detallada](docs/Postman.md)

[Coleccion de Postman ubicada en docs](docs/ADPractica3.postman_collection.json)


## 4. WoW (Way of Working)


A continuación se describe de forma resumida el proceso para poner en marcha la aplicación en un entorno Docker con MariaDB, así como algunos pasos fundamentales para la configuración de Laravel.

### Requisitos tecnológicos
- **Docker** instalado para poder ejecutar contenedores.
- **PHP** (>= 8.x) y **Composer** para gestionar dependencias de Laravel.
- **Laravel** (versión 9 o superior).


## Pasos para levantar el proyecto

1. **Arrancar contenedor de MariaDB**:

```bash
docker run --name mariadb_practicas -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=practicas -e MYSQL_USER=usuario -e MYSQL_PASSWORD=pepe123 -p 3306:3306 -d mariadb:latest
```

2. **Copiar archivo de entorno**:

```bash
cp .env.example .env
```


3. **Instalar dependencias**:

```bash
composer install
```

4. **Generar la key** de Laravel:

```bash
php artisan key:generate
```

5. **Ejecutar migraciones** para crear las tablas:

```bash
php artisan migrate
```

6. **Ejecutar seeders** (opcional, pero recomendable) para cargar datos de prueba:

```bash
php artisan db:seed
```

7. **Arrancar el servidor local**:

```bash
php artisan serve
```






<details>

  <summary>⚠¿Tienes un fallo? Haz clic aquí para ver la solución⚠</summary>

   --- 

  ### Resolución de posibles conflictos

  
  **Posibles soluciones:**
  - Asegúrate de haber instalado todas las dependencias con `composer install`.
  - Revisa que el archivo `.env` esté correctamente configurado. fijate que se vea algo asi:
  
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=practicas
DB_USERNAME=usuario
DB_PASSWORD=pepe123
```


- Si el puerto 3306 está ocupado, puedes cambiarlo a `-p 3307:3306`, etc. O puedes detener el proceso en Windows
  Encuentra el id del proceso
```bash
netstat -ano | findstr 3306
  ```
Detiene el proceso
```bash
Stop-Process -Id NumeroID
  ```
- Para Windows, desactiva antivirus o añade exclusiones si Composer falla.
- Verifica las variables de entorno si la conexión a la base de datos no funciona.

  
 ---
</details>






















