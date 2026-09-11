# MokaLab Inventario

Práctica de la materia **Optativa - Bases de Datos en la Nube**.

El proyecto consiste en un pequeño sistema de inventario para MokaLab, desarrollado con **React** como frontend, **Laravel** como API REST y **Neon PostgreSQL** como base de datos en la nube.

## Objetivo

Diseñar e implementar una base de datos relacional de tres tablas relacionadas en un servicio de nube y desarrollar una API REST que permita realizar operaciones CRUD sobre los datos.

La aplicación permite administrar:

* Categorías
* Marcas
* Productos

Los productos están relacionados con una categoría y una marca mediante llaves foráneas.

---

## Tecnologías utilizadas

### Frontend

* React

### Backend

* Laravel

### Base de datos

* PostgreSQL
* Neon

---

## Arquitectura

```text
React
  │
  │ HTTP / REST API
  ▼
Laravel
  │
  │ Eloquent ORM
  ▼
Neon PostgreSQL
```

El frontend no se conecta directamente a la base de datos. Todas las operaciones pasan por la API de Laravel.

---

## Modelo de datos

El sistema utiliza tres tablas:

### categories

| Campo       | Tipo         | Descripción            |
| ----------- | ------------ | ---------------------- |
| id          | BIGINT       | Llave primaria         |
| name        | VARCHAR(100) | Nombre de la categoría |
| description | TEXT         | Descripción            |
| created_at  | TIMESTAMP    | Fecha de creación      |
| updated_at  | TIMESTAMP    | Fecha de actualización |

### brands

| Campo       | Tipo         | Descripción            |
| ----------- | ------------ | ---------------------- |
| id          | BIGINT       | Llave primaria         |
| name        | VARCHAR(100) | Nombre de la marca     |
| description | TEXT         | Descripción            |
| created_at  | TIMESTAMP    | Fecha de creación      |
| updated_at  | TIMESTAMP    | Fecha de actualización |

### products

| Campo       | Tipo          | Descripción                    |
| ----------- | ------------- | ------------------------------ |
| id          | BIGINT        | Llave primaria                 |
| category_id | BIGINT        | Llave foránea hacia categories |
| brand_id    | BIGINT        | Llave foránea hacia brands     |
| name        | VARCHAR(150)  | Nombre del producto            |
| description | TEXT          | Descripción                    |
| price       | DECIMAL(10,2) | Precio                         |
| stock       | INTEGER       | Existencias                    |
| created_at  | TIMESTAMP     | Fecha de creación              |
| updated_at  | TIMESTAMP     | Fecha de actualización         |

### Relaciones

```text
categories 1 ─── N products
brands     1 ─── N products
```

---

## Configuración del backend

### Configurar variables de entorno

```env
DB_CONNECTION=pgsql
DB_HOST=HOST_DE_NEON
DB_PORT=5432
DB_DATABASE=Nombre
DB_USERNAME=Usuario
DB_PASSWORD=Contraseña
DB_SSLMODE=require
```

## Códigos HTTP utilizados

| Código | Uso                        |
| ------ | -------------------------- |
| 200    | Operación exitosa          |
| 201    | Registro creado            |
| 400    | Solicitud inválida         |
| 404    | Registro no encontrado     |
| 500    | Error interno del servidor |

---

## Evidencias

### Diagrama Entidad-Relación

Agregar aquí la imagen del DER:

```text
docs/DER.png
```

