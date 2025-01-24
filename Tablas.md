# AD-3-Practica


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
