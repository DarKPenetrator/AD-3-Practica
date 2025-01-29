# Colección de Postman

Esta colección de Postman permite gestionar alumnos, empresas, ofertas de prácticas y candidaturas a través de una API. Contiene endpoints para operaciones de consulta, creación, actualización y eliminación de registros.

## Carpeta GET
- **GET /api/alumnos** - Todos los alumnos.
- **GET /api/alumnos/{id}** - Alumno por ID.
- **GET /api/alumnos/tutor/{tutor_id}** - Alumnos con un tutor específico.
- **GET /api/empresas** - Todas las empresas.
- **GET /api/empresas/{id}** - Empresa por ID.
- **GET /api/ofertas_practicas** - Todas las ofertas.
- **GET /api/ofertas_practicas/{id}** - Oferta por ID.
- **GET /api/candidaturas/oferta/{oferta_id}** - Candidaturas de una oferta.

## Carpeta POST
- **POST /api/alumno-usuario** - Crear usuario (role=alumno) y alumno.
- **POST /api/empresa-usuario** - Crear usuario (role=empresa) y empresa.
- **POST /api/ofertas_practicas** - Crear oferta.
- **POST /api/candidaturas** - Crear candidatura.

## Carpeta DELETE
- **DELETE /api/candidaturas/{id}** - Eliminar candidatura.
- **DELETE /api/ofertas_practicas/{id}** - Eliminar oferta y sus candidaturas.

## Carpeta PUT
- **PUT /api/alumnos/{id}** - Actualizar alumno.
- **PUT /api/empresas/{id}** - Actualizar empresa.
- **PUT /api/ofertas_practicas/{id}** - Actualizar oferta.
- **PUT /api/candidaturas/{id}** - Actualizar candidatura.
