# Proyecto Cadereyta Presidencia municipal.

Este proyecto es una aplicación web desarrollada con el stack LAMP (Linux, Apache, MySQL, PHP) para la gestión de información de Cadereyta Presi.

## Requisitos

- Servidor con sistema operativo Linux
- Servidor web Apache
- Base de datos MySQL
- PHP 7.4 o superior

## Instalación

1. Clonar el repositorio en el directorio deseado:
    ```bash
    git clone https://github.com/usuario/cadereytapresi.git
    ```

2. Navegar al directorio del proyecto:
    ```bash
    cd cadereytapresi
    ```

3. Configurar el archivo de entorno `.env` con las credenciales de la base de datos:
    ```bash
    cp .env.example .env
    nano .env
    ```

4. Importar la base de datos:
    ```bash
    mysql -u usuario -p base_de_datos < database.sql
    ```



## Uso



1. Acceder a la aplicación desde el navegador:
    ```
    https://cadereytademontes.gob.mx
    ```

## Estructura del Proyecto

- `assets/`: Contiene los archivos públicos accesibles desde el navegador.
- `assets/css/`: Contiene los estilos del sitio web.
- `assets/images/`: Contiene los archivos de imagenes.
- `assets/scss/`: Contiene la hoja de configuracion de estilos para css

## Contribuciones

1. Hacer un fork del repositorio.
2. Crear una nueva rama para tu funcionalidad:
    ```bash
    git checkout -b nueva-funcionalidad
    ```
3. Realizar los cambios y hacer commit:
    ```bash
    git commit -m "Añadir nueva funcionalidad"
    ```
4. Enviar los cambios al repositorio remoto:
    ```bash
    git push origin nueva-funcionalidad
    ```
5. Crear un Pull Request en GitHub.

## Licencia

Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo `LICENSE` para más detalles.

## Contacto

Para cualquier consulta o sugerencia, por favor contacta a [correo@ejemplo.com](mailto:soporte@iktansystem.uk).
