Instalación de la API Laravel, Angular y Base de Datos (XAMPP)
Requisitos Previos
Asegúrate de tener instalados los siguientes programas:
XAMPP con MySQL en el puerto 3308
Node.js (incluye npm)
Composer
Git

1️⃣ Instalación de la API Laravel
1.1 Clonar el repositorio
git clone https://github.com/usuario/repo-api.git
 cd repo-api

1.2 Instalar dependencias
composer install

1.3 Configurar variables de entorno
Renombrar el archivo .env.example a .env y modificar los siguientes valores:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=taskdb
DB_USERNAME=root
DB_PASSWORD=

1.4 Generar la clave de la aplicación
php artisan key:generate

1.5 Ejecutar migraciones y semillas
php artisan migrate --seed

1.6 Iniciar el servidor
php artisan serve

Por defecto, la API estará disponible en http://127.0.0.1:8000

2️⃣ Instalación de la Aplicación Angular
2.1 Clonar el repositorio
git clone https://github.com/usuario/repo-angular.git
 cd repo-angular

2.2 Instalar dependencias
npm install

2.3 Configurar la URL de la API
Modificar src/environments/environment.ts:
export const environment = {
  production: false,
  apiUrl: 'http://127.0.0.1:8000/api/v1'
};

2.4 Iniciar el servidor de desarrollo
ng serve --open

La aplicación estará disponible en http://localhost:4200

3️⃣ Configurar Base de Datos en XAMPP (MySQL en puerto 33008)
Iniciar XAMPP y asegurarse de que MySQL usa el puerto 33008.
Acceder a phpMyAdmin: http://localhost:8080/phpmyadmin.
Crear una base de datos llamada taskdb.
(Opcional) Importar una estructura inicial desde un archivo SQL:
Ir a Importar en phpMyAdmin.
Seleccionar el archivo taskdb.sql.
Hacer clic en Continuar.

4️⃣ Postman Collection
colecciones de postman:
http://localhost:8000/api/v1/tasks

[
    {
        "id": 1,
        "title": "limpiar",
        "description": "limpiar departamento",
        "status": "in_progress",
        "created_at": "2025-03-20T15:15:06.000000Z",
        "updated_at": "2025-03-20T15:29:39.000000Z"
    },
    {
        "id": 2,
        "title": "registrar",
        "description": "registrar ususario nuevo",
        "status": "completed",
        "created_at": "2025-03-20T15:30:08.000000Z",
        "updated_at": "2025-03-20T15:30:08.000000Z"
    }
]

http://127.0.0.1:8000/api/v1/users

[
    {
        "id": 1,
        "name": "admin",
        "email": "admin@gmail.com",
        "email_verified_at": null,
        "created_at": null,
        "updated_at": null
    },
    {
        "id": 2,
        "name": "axel",
        "email": "axelmiranda.845@gmail.com",
        "email_verified_at": null,
        "created_at": "2025-03-20T15:13:59.000000Z",
        "updated_at": "2025-03-20T15:13:59.000000Z"
    }
]

5️⃣ Comandos útiles
Reiniciar migraciones (Cuidado: elimina datos existentes)
php artisan migrate:fresh --seed

Ver rutas de la API
php artisan route:list

