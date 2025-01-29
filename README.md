
# AD-3-Practica
se trata de un proyecto laravel bla bla 



[Tablas en detalle y explicadas](docs/Tablas.md)
<br>
## 1. Descripción del problema


Este proyecto tiene un objetivo de bla bla   
### Tabla General con Campos y Relaciones


| Tabla                  | Relaciones                                     |
|------------------------|----------------------------------------------------------|
| **users**             | HasOne(alumno), HasOne(empresa)               |
| **alumno**            | `BelongsTo(users)`, BelongsTo(centro_educativo), HasMany(candidatura), HasManyThrough(tutor, candidatura) |
| **empresa**           | BelongsTo(users), HasMany(oferta_de_practica) |
| **oferta_de_practica**| BelongsTo(empresa), HasMany(candidatura)      |
| **candidatura**       | BelongsTo(alumno), BelongsTo(oferta_de_practica), BelongsTo(tutor) |
| **centro_educativo**  | HasMany(alumno)                               |
| **tutor**             | HasMany(candidatura)                          |

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
<br>
## 2. Modelo E-R

![Imagen de Modelo E-R](docs/imagen.png)

[![Pepe estuvo aqui](https://mermaid.ink/img/pako:eNq1Vu1u2jAUfRUrUqVVajX1L_8ySDe0EVBwpm1Ciu7sS7GW2Jk_NlWlD7Nn2YvNIQHSNKi0dPkDubZzzrnxOfFdwBTHYBCgHgm40VAsJPFXOo-SObmrb6prHFMiOJl93JfmNBnH74mEAh8VsQCRP6qWYMxvpfl-IIrTCdEqbz2BjifRnIaTGWEawSLPwPaNupI_GL1fyPpP-CmdxNMnyFclZ1Bnvn7dqTOUVqsMuWNgxS_VndOoYaA1atjXv0ZhQkAKlflGcgdMKPlolcUcl0qqVxQcTWZJNA9fqLjhxYVGdiTjZsAgs0q_opDpdZTQMBtF2SwJh3Q8PEYTFqVGAwdklQ6NVQ9XcKc774ZGXyjR-NMJI6wynQGOhmlRdpacKnYYxqPxKKRpcoxKyF0hVd9uVUvUFjKOWellWcGgb5Z1_lV1Bzbu8_0BrjqSmSq8CUCLdjM82Ygska0gYyC58MJce_-f3pIopsk0i0bpMKTjz9MjA0gV3zW-xobupNbJemhKp8lJIvpz9D9kyNkZSTDf2ALNYFdLpc8MV-2Dykkcved1sxeJ2lqPvLkaXJ23Pxzr9eXler1N4gFZBB_ATCW-fYe5kjeGqkXQM38bZIcWtGnVIU12Id3wsyg9w8KxlTINUVPxi88PbLEN9F2H6gTk7WHoRn8XEAxp2eIBavP0Bqvt_GMAYdfoGrJ6xTvI2v7GhxQp9d8_mwBoQ2972mD3ROxxFGqc54jugXphA-r0arBL0F6j8D8E5VMcagc-Bza4CArU3nbcn4o21l0EdoX-jBNUazjoH9W0ez8PPKv5rWTBwGqHF4FW7mYVDJaQG39XW605Ve2qJchvSm3v7_8B9wPOLg?type=png)](https://mermaid.live/edit#pako:eNq1Vu1u2jAUfRUrUqVVajX1L_8ySDe0EVBwpm1Ciu7sS7GW2Jk_NlWlD7Nn2YvNIQHSNKi0dPkDubZzzrnxOfFdwBTHYBCgHgm40VAsJPFXOo-SObmrb6prHFMiOJl93JfmNBnH74mEAh8VsQCRP6qWYMxvpfl-IIrTCdEqbz2BjifRnIaTGWEawSLPwPaNupI_GL1fyPpP-CmdxNMnyFclZ1Bnvn7dqTOUVqsMuWNgxS_VndOoYaA1atjXv0ZhQkAKlflGcgdMKPlolcUcl0qqVxQcTWZJNA9fqLjhxYVGdiTjZsAgs0q_opDpdZTQMBtF2SwJh3Q8PEYTFqVGAwdklQ6NVQ9XcKc774ZGXyjR-NMJI6wynQGOhmlRdpacKnYYxqPxKKRpcoxKyF0hVd9uVUvUFjKOWellWcGgb5Z1_lV1Bzbu8_0BrjqSmSq8CUCLdjM82Ygska0gYyC58MJce_-f3pIopsk0i0bpMKTjz9MjA0gV3zW-xobupNbJemhKp8lJIvpz9D9kyNkZSTDf2ALNYFdLpc8MV-2Dykkcved1sxeJ2lqPvLkaXJ23Pxzr9eXler1N4gFZBB_ATCW-fYe5kjeGqkXQM38bZIcWtGnVIU12Id3wsyg9w8KxlTINUVPxi88PbLEN9F2H6gTk7WHoRn8XEAxp2eIBavP0Bqvt_GMAYdfoGrJ6xTvI2v7GhxQp9d8_mwBoQ2972mD3ROxxFGqc54jugXphA-r0arBL0F6j8D8E5VMcagc-Bza4CArU3nbcn4o21l0EdoX-jBNUazjoH9W0ez8PPKv5rWTBwGqHF4FW7mYVDJaQG39XW605Ve2qJchvSm3v7_8B9wPOLg)

<br>
## 3. Implementación



<br>
## 4. WoW (Way of Working)
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


