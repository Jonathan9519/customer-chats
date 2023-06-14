# Customer Chats

Es una aplicacion sencilla de chats a través de publicaciones realizadas por vendedores


## Requisitos previos

- PHP = 8.X
- VueJs 3
- Laravel 10
- Pusher
- Laravel-Echo


## Instalacion 

1. Clona este repositorio en tu máquina local:

```bash
  https://github.com/Jonathan9519/customer-chats.git
```

2. Accede al directorio del proyecto

```bash
  cd customer-chats
```

3. Instala las dependencias de Composer y Javascript 

```bash
  composer install && npm i
```

4. Crea un archivo .env basado en el archivo `.env.example` y actualiza las configuraciones de la base de datos:

```bash
  cp .env.example .env
```

5. Genera la clave de la aplicación:

```bash
  php artisan key:generate
```

## Configuración pusher

1. Crea una cuenta en [Pusher](https://pusher.com) y obtén las credenciales de tu aplicación.

2. Actualiza el archivo `.env` con las siguientes configuraciones:

```bash
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=your-app-cluster
```

3. Configura las credenciales de Pusher en el archivo `config/broadcasting.php`:

```bash
'connections' => [
    'pusher' => [
        'driver' => 'pusher',
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
        'options' => [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true,
            'useTLS' => true,
        ],
    ],
],
```

## Ejecutar el proyecto

**Nota antes de empezar**: Todos los Usuarios que se registran empezarán con el tipo de usuario "buyer" registra 3 suarios y en tu tabla **`chatcustomers.users`** cambia el **`user_type`** a "seller" seguido de eso en el archivo `resources\js\components\FeedPosts.vue` agrega los respectivos **owner_id** en el arreglo de posts


1. Inicia el servidor de desarrollo de Laravel:

```bash
php artisan serve
```

2. Compila los assets de JavaScript y ejecuta el entorno de desarrollo de Vue.js:

```bash
npm run dev
```
3. Accede a la aplicación en tu navegador web en la dirección http://127.0.0.1:8000.

## Caracteristicas extras

 - Base de datos clientes y prospectos
 - Posibilidad de habilitar Chatbot con respuestas automaticas
 - Interfaz para visualizar unicamente los archivos adjuntos del chat
 - Poder descargar los archivos si fuera necesario
 - Editar mensajes
 - Citar mensajes (Como whatsapp, Instagram, Messegenger)
