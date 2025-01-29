

Comandos para que funcione el proyecto 


docker run --name mariadb_practicas -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=practicas -e MYSQL_USER=usuario -e MYSQL_PASSWORD=pepe123 -p 3306:3306 -d mariadb:latest


si el puerto esta ocupado se puede cambiar el puerto de escucha o detener el proceso que ocupa el puerto
para detenerlo en windows 

Encuentra el id del proceso
netstat -ano | findstr 3306

Detiene el proceso
Stop-Process -Id NumeroID



docker exec -it mariadb_practicas mariadb -u usuario -p

cp .env.example .env

composer install
si win da fallos hay que desactivar opcion analisis en tiempo real de Windows Defender


php artisan key:generate


php artisan migrate:fresh


php artisan db:seed


php artisan serve





# AD-3-Practica

[Tablas en detalle y explicadas](docs/guia.md)


# Definición de Tablas y Relaciones

## Tabla General con Campos y Relaciones


| Tabla                  | Campos principales                                        | Relaciones                                     |
|------------------------|----------------------------------------------------------|-----------------------------------------------|
| **users**             | id, name, email, password, role                          | HasOne(alumno), HasOne(empresa)               |
| **alumno**            | id, user_id, centro_educativo_id, carrera, año_graduacion | `BelongsTo(users)`, BelongsTo(centro_educativo), HasMany(postulacion), HasManyThrough(tutor, postulacion) |
| **empresa**           | id, user_id, direccion, telefono, sector                 | BelongsTo(users), HasMany(oferta_de_practica) |
| **oferta_de_practica**| id, empresa_id, puesto, duracion, requisitos             | BelongsTo(empresa), HasMany(postulacion)      |
| **candidatura**       | id, alumno_id, oferta_de_practica_id, tutor_id, estado   | BelongsTo(alumno), BelongsTo(oferta_de_practica), BelongsTo(tutor) |
| **centro_educativo**  | id, nombre, direccion, telefono, email                   | HasMany(alumno)                               |
| **tutor**             | id, nombre, email, telefono                              | HasMany(postulacion)                          |






## Tabla: `users`

| **Campo**       | **Tipo**     | **Descripción**                                   |
|------------------|-------------|---------------------------------------------------|
| `id`            | Integer (PK) | Identificador único del usuario.                 |
| `name`          | String       | Nombre del usuario.                              |
| `email`         | String       | Correo electrónico único del usuario.            |
| `password`      | String       | Contraseña del usuario (encriptada).             |
| `role`          | Enum         | Rol del usuario (`alumno` o `empresa`).          |
| `created_at`    | Timestamp    | Fecha de creación del registro.                  |
| `updated_at`    | Timestamp    | Fecha de última actualización del registro.      |


## Tabla: `alumno`

| **Campo**              | **Tipo**       | **Descripción**                                   |
|-------------------------|---------------|---------------------------------------------------|
| `id`                   | Integer (PK)  | Identificador único del alumno.                  |
| `user_id`              | Integer (FK)  | Relación con `users.id`.                         |
| `centro_educativo_id`  | Integer (FK)  | Relación con `centro_educativo.id`.              |
| `carrera`              | String        | Carrera o especialización del alumno.            |
| `año_graduacion`       | Year          | Año estimado de graduación.                      |
| `telefono`             | String        | Número de teléfono del alumno.                   |
| `created_at`           | Timestamp     | Fecha de creación del registro.                  |
| `updated_at`           | Timestamp     | Fecha de última actualización del registro.      |


## Tabla: `empresa`

| **Campo**      | **Tipo**       | **Descripción**                                   |
|-----------------|---------------|---------------------------------------------------|
| `id`           | Integer (PK)  | Identificador único de la empresa.               |
| `user_id`      | Integer (FK)  | Relación con `users.id`.                         |
| `direccion`    | String        | Dirección física de la empresa.                  |
| `telefono`     | String        | Número de contacto de la empresa.                |
| `sector`       | String        | Sector industrial al que pertenece la empresa.   |
| `created_at`   | Timestamp     | Fecha de creación del registro.                  |
| `updated_at`   | Timestamp     | Fecha de última actualización del registro.      |


## Tabla: `oferta_de_practica`

| **Campo**      | **Tipo**       | **Descripción**                                   |
|-----------------|---------------|---------------------------------------------------|
| `id`           | Integer (PK)  | Identificador único de la oferta de práctica.    |
| `empresa_id`   | Integer (FK)  | Relación con `empresa.id`.                       |
| `puesto`       | String        | Nombre o título del puesto ofertado.             |
| `duracion`     | Integer       | Duración de la práctica en meses.                |
| `requisitos`   | Text          | Requisitos para aplicar a la práctica.           |
| `descripcion`  | Text          | Descripción detallada de la práctica.            |
| `created_at`   | Timestamp     | Fecha de creación del registro.                  |
| `updated_at`   | Timestamp     | Fecha de última actualización del registro.      |


## Tabla: `candidatura`

| **Campo**               | **Tipo**       | **Descripción**                                   |
|--------------------------|---------------|---------------------------------------------------|
| `id`                    | Integer (PK)  | Identificador único de la candidatura.           |
| `alumno_id`             | Integer (FK)  | Relación con `alumno.id`.                        |
| `oferta_de_practica_id` | Integer (FK)  | Relación con `oferta_de_practica.id`.            |
| `tutor_id`              | Integer (FK)  | Relación con `tutor.id`.                         |
| `estado`                | Enum          | Estado de la candidatura (`pendiente`, `aceptada`, `rechazada`). |
| `comentarios`           | Text          | Comentarios adicionales sobre la candidatura.    |
| `fecha_candidatura`     | Date          | Fecha en la que el alumno aplicó.                |
| `created_at`            | Timestamp     | Fecha de creación del registro.                  |
| `updated_at`            | Timestamp     | Fecha de última actualización del registro.      |


## Tabla: `centro_educativo`

| **Campo**      | **Tipo**       | **Descripción**                                   |
|-----------------|---------------|---------------------------------------------------|
| `id`           | Integer (PK)  | Identificador único del centro educativo.        |
| `nombre`       | String        | Nombre del centro educativo.                     |
| `direccion`    | String        | Dirección física del centro educativo.           |
| `telefono`     | String        | Número de contacto del centro educativo.         |
| `email`        | String        | Correo electrónico del centro.                   |
| `created_at`   | Timestamp     | Fecha de creación del registro.                  |
| `updated_at`   | Timestamp     | Fecha de última actualización del registro.      |


## Tabla: `tutor`

| **Campo**      | **Tipo**       | **Descripción**                                   |
|-----------------|---------------|---------------------------------------------------|
| `id`           | Integer (PK)  | Identificador único del tutor.                   |
| `nombre`       | String        | Nombre completo del tutor.                       |
| `email`        | String        | Correo electrónico del tutor.                    |
| `telefono`     | String        | Número de contacto del tutor.                    |
| `created_at`   | Timestamp     | Fecha de creación del registro.                  |
| `updated_at`   | Timestamp     | Fecha de última actualización del registro.      |


---

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

De la practica cuando la leas me gustaria dejar de lado los puntos 1,2,4 para mas tarde ya que son de explicar y el importante para mi de momento es el de 3 implemntacion y ver que funciona todo correctamente. Ese punto me gustaria hacerlo paso a paso contigo y que vayamos por fases no todo de golpe para ir comprobando que todo funciona bien 



Aqui te paso la practica en cuestion :
Práctica UD3: Base de datos relacionales
Tiempo de realización 10h (4sesiones)

Entrega
Fecha de entrega hasta el 5/02/2025 23:59
Se debe entregar únicamente la URL del repositorio en GitHub en la tarea habilitada en Aula Virtual(Moodle) en la sección "Convocatoria ordinaria". El usuario de Github jpaniorte debe tener permisos para clonar el repositorio.
Esta práctica REQUIERE defensa durante el exámen de la convocatoria del 7 al 14 Febrero 2025:
Si lo deseas, y condicionado a que sea factible, puedes solicitar defender tu práctica antes del exámen.
Debes acudir a defender la práctica en el día y hora que la escuela especifique.
La defensa durará entre 5 y 10 min, durante este tiempo, se deberá contestar a las preguntas formuladas por el profesor. Por ejemplo:
¿Cómo se implementa una relación 1..N?
La defensa de la práctica no sube ni baja nota, simplemente valida y verifica que el alumno ha realizado la práctica y ha adquirido los conocimientos. Por lo tanto, la puntuación de la práctica será:
Si supera defensa => nota obtenida según criterios de corrección.
Si no supera la defensa => No Evaluable.
Enunciado de la práctica
Debes inventar e implementar un proyecto Laravel original donde demostrar los contenidos adquiridos durante la unidad 3.

El proyecto debe contener las siguientes secciones desarrolladas en el README.md de la raíz. Al ser un tipo de fichero Markdown, es recomendable leer esta guía para que el estilo y la visualización del texto sea correcta: https://tutorialmarkdown.com/sintaxis.

1. Descripción del problema (1,5p)
Debes inventar un supuesto lo más realista posible, es decir, algo que pienses que puedan pedir en la empresa donde trabajas o trabajarás, algo que un cliente te haya pedido, etc. Por ejemplo:

Supongamos que un cliente nos solicita implementar un sistema para gestionar las notas de los alumnos en diferentes asignaturas. Además, desea realizar el cálculo de las notas medias y % de aprobados por asignatura y alumno ...

Criterio de corrección:

💪 Sobrenatural:
Todos los criterios de Notable
El supuesto puede ser de utilidad para la escuela.
Notable:
Al menos el texto contiene 100 palabras.
Supuesto realista y original.
Se representa correctamente todas las tablas y relaciones entre ellas. Todos los atributos pueden ser inferidos con la información aportada.
Bien:
Entre 50 y 100 palabras.
Supuesto poco realista.
2 tablas o relaciones no representadas.
Suspenso:
Menos de 50 palabras.
Supuesto no realista.
+2 tablas o relaciones no representadas.
2. Modelo E-R (1,5p)
Adjuntar una imagen del modelo E-R de vuestra aplicación. Ver sintaxis en Markdown para renderizar imágenes.

Criterio de corrección:

💪 Sobrenatural:
Todos los criterios de Notable.
Representa una relación ternaria.
Representa una relación de agregación.
Notable:
Se representan todos los tipos de relaciones vistas en clase (Diapositiva 3, presentación 3.3)
PK de cada tabla representado.
FK representadas con la cardenalidad (0..N, N..N)
Bien:
Faltan 2 relaciones de las vistas en clase.
Faltan 2 PK de cada tabla representado.
Faltan 2 FK representadas con la cardenalidad (0..N, N..N)
Suspenso:
Faltan >2 relaciones de las vistas en clase.
Faltan >2 PK de cada tabla representado.
Faltan >2 FK representadas con la cardenalidad (0..N, N..N)
3. Implementación (6p)
Implementar el proyecto en Laravel.

Criterio de corrección:

💪 Sobrenatural:
Todos los criterios de Notable.
Existe en la raíz del proyecto un fichero de exportación de la aplicación Postman con un ejemplo de petición a todos los endpoints publicados.
Existe validación sobre los parámetros Request de entrada.
Notable:
Todas las tablas creadas.
Todos lo modelos implementados.
Todas las tablas contienen datos de prueba mediante Seeders.
Todas las relaciones implementadas.
Existen almenos 10 endpoints en el fichero api.php Recordar configurar las API Routes.
Todos los verbos del protocolo HTTP (GET, POST, PUT, DELETE) implementados.
Bien:
Todas las tablas creadas.
Todos lo modelos implementados.
Todas las tablas contienen datos de prueba mediante Seeders.
Todas las relaciones implementadas.
Existen almenos 5 endpoints en el fichero api.php Recordar configurar las API Routes.
Todos los verbos del protocolo HTTP (GET, POST, PUT, DELETE) implementados.
Suspenso:
No todas las tablas creadas.
No todos lo modelos implementados.
No todas las tablas contienen datos de prueba mediante Seeders.
No todas las relaciones implementadas.
No existen almenos 5 endpoints en el fichero api.php Recordar configurar las API Routes.
No todos los verbos del protocolo HTTP (GET, POST, PUT, DELETE) implementados.
4. WoW (1p)
El Way of working es una descripción detallada de los requisitos tecnológicos necesarios para trabajar en el proyecto y una serie de pasos concretos a ejecutar para tener la aplicación "lista" para trabajar.

💪 Sobrenatural:
Todos los criterios de Notable.
Especifica cómo instalar todos los requisitos tecnológicos (PHP, Composer, etc).
Notable:
Ejecutando todas las instrucciones en el orden proporcionado logramos "levantar" la aplicación.
Bien:
Falta 1 paso para "levantar" la aplicación.
Suspenso:
Falta >1 paso para "levantar" la aplicación



[![](https://mermaid.ink/img/pako:eNq1Vu1u2jAUfRUrUqVVajX1L_8ySDe0EVBwpm1Ciu7sS7GW2Jk_NlWlD7Nn2YvNIQHSNKi0dPkDubZzzrnxOfFdwBTHYBCgHgm40VAsJPFXOo-SObmrb6prHFMiOJl93JfmNBnH74mEAh8VsQCRP6qWYMxvpfl-IIrTCdEqbz2BjifRnIaTGWEawSLPwPaNupI_GL1fyPpP-CmdxNMnyFclZ1Bnvn7dqTOUVqsMuWNgxS_VndOoYaA1atjXv0ZhQkAKlflGcgdMKPlolcUcl0qqVxQcTWZJNA9fqLjhxYVGdiTjZsAgs0q_opDpdZTQMBtF2SwJh3Q8PEYTFqVGAwdklQ6NVQ9XcKc774ZGXyjR-NMJI6wynQGOhmlRdpacKnYYxqPxKKRpcoxKyF0hVd9uVUvUFjKOWellWcGgb5Z1_lV1Bzbu8_0BrjqSmSq8CUCLdjM82Ygska0gYyC58MJce_-f3pIopsk0i0bpMKTjz9MjA0gV3zW-xobupNbJemhKp8lJIvpz9D9kyNkZSTDf2ALNYFdLpc8MV-2Dykkcved1sxeJ2lqPvLkaXJ23Pxzr9eXler1N4gFZBB_ATCW-fYe5kjeGqkXQM38bZIcWtGnVIU12Id3wsyg9w8KxlTINUVPxi88PbLEN9F2H6gTk7WHoRn8XEAxp2eIBavP0Bqvt_GMAYdfoGrJ6xTvI2v7GhxQp9d8_mwBoQ2972mD3ROxxFGqc54jugXphA-r0arBL0F6j8D8E5VMcagc-Bza4CArU3nbcn4o21l0EdoX-jBNUazjoH9W0ez8PPKv5rWTBwGqHF4FW7mYVDJaQG39XW605Ve2qJchvSm3v7_8B9wPOLg?type=png)](https://mermaid.live/edit#pako:eNq1Vu1u2jAUfRUrUqVVajX1L_8ySDe0EVBwpm1Ciu7sS7GW2Jk_NlWlD7Nn2YvNIQHSNKi0dPkDubZzzrnxOfFdwBTHYBCgHgm40VAsJPFXOo-SObmrb6prHFMiOJl93JfmNBnH74mEAh8VsQCRP6qWYMxvpfl-IIrTCdEqbz2BjifRnIaTGWEawSLPwPaNupI_GL1fyPpP-CmdxNMnyFclZ1Bnvn7dqTOUVqsMuWNgxS_VndOoYaA1atjXv0ZhQkAKlflGcgdMKPlolcUcl0qqVxQcTWZJNA9fqLjhxYVGdiTjZsAgs0q_opDpdZTQMBtF2SwJh3Q8PEYTFqVGAwdklQ6NVQ9XcKc774ZGXyjR-NMJI6wynQGOhmlRdpacKnYYxqPxKKRpcoxKyF0hVd9uVUvUFjKOWellWcGgb5Z1_lV1Bzbu8_0BrjqSmSq8CUCLdjM82Ygska0gYyC58MJce_-f3pIopsk0i0bpMKTjz9MjA0gV3zW-xobupNbJemhKp8lJIvpz9D9kyNkZSTDf2ALNYFdLpc8MV-2Dykkcved1sxeJ2lqPvLkaXJ23Pxzr9eXler1N4gFZBB_ATCW-fYe5kjeGqkXQM38bZIcWtGnVIU12Id3wsyg9w8KxlTINUVPxi88PbLEN9F2H6gTk7WHoRn8XEAxp2eIBavP0Bqvt_GMAYdfoGrJ6xTvI2v7GhxQp9d8_mwBoQ2972mD3ROxxFGqc54jugXphA-r0arBL0F6j8D8E5VMcagc-Bza4CArU3nbcn4o21l0EdoX-jBNUazjoH9W0ez8PPKv5rWTBwGqHF4FW7mYVDJaQG39XW605Ve2qJchvSm3v7_8B9wPOLg)
