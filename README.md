# Proyecto Presidencia municipal de Cadereyta.

Este proyecto es una aplicación web desarrollada con el stack LAMP (Linux, Apache, MySQL, PHP) para la gestión de información de Presidencia municipal de Cadereyta.

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
---
## Estructura de Archivos

```
.
├── archivos
├── assets
│   ├── css
│   │   ├── styles.css
│   │   ├── styles.css.map
│   ├── images
│   │   ├── Art66
│   │   ├── Art67
│   │   ├── banner
│   │   ├── carousel
│   │   ├── logo
│   │   ├── imagesfooter
│   ├── layouts
│   │   ├── footer.php
│   │   ├── header.php
│   ├── scss
│       ├── styles.scss
├── node_modules
├── .gitignore
├── art67_files.php
├── index.php
├── transparencia.php
├── transparencia copy.php
├── README.md
├── package.json
├── package-lock.json
├── cadereytapresi.code-workspace
```

---



## Uso
1. Acceder a la página principal (`index.php`) para ver el carrusel y la navegación.
2. Navegar a `transparencia.php` para explorar las secciones Art66 y Art67.


# Estructura de Archivos

Esta es la estructura de directorios y archivos utilizada en el proyecto para organizar y gestionar los recursos de las secciones `art66` y `art67`. 

## Directorio base
```
archivos/
```

## Subestructura para las categorías

Cada categoría (`art66` y `art67`) tiene su propia estructura que incluye subdirectorios para las fracciones, años y trimestres.

### Ejemplo de estructura
```
archivos/
|-- art66/
|   |-- fracc1/
|   |   |-- año2024/
|   |   |   |-- trim1/
|   |   |   |   |-- archivo1.pdf
|   |   |   |   |-- archivo2.docx
|   |   |   |-- trim2/
|   |   |-- año2025/
|   |-- fracc2/
|   |   |-- año2024/
|   |   |   |-- trim1/
|   |   |   |   |-- archivo1.xlsx
|   |   |   |   |-- archivo2.pptx
|-- art67/
    |-- fracc1/
    |   |-- año2024/
    |   |   |-- trim1/
    |   |   |   |-- archivo1.pdf
    |   |   |   |-- archivo2.docx
    |   |   |-- trim2/
    |-- fracc3/
        |-- año2024/
            |-- trim1/
            |   |-- archivo1.pptx
            |   |-- archivo2.xlsx
```

## Detalles de la estructura

- **`archivos/`**: Carpeta raíz que contiene los archivos organizados por categorías.
- **`art66/` y `art67/`**: Subdirectorios principales que separan las categorías.
- **Fracciones (`fracc1`, `fracc2`, etc.)**: Dentro de cada categoría, los archivos están organizados por fracciones.
- **Años (`año2024`, `año2025`, etc.)**: Cada fracción contiene subdirectorios por años.
- **Trimestres (`trim1`, `trim2`, etc.)**: Cada año tiene carpetas para los trimestres.
- **Archivos**: Dentro de los trimestres se almacenan los archivos relacionados, organizados por su extensión y nombre.

## Extensiones permitidas
Los archivos permitidos en la estructura deben tener alguna de las siguientes extensiones:

- Documentos: `.pdf`, `.doc`, `.docx`
- Hojas de cálculo: `.xls`, `.xlsx`
- Presentaciones: `.ppt`, `.pptx`

## Ejemplo de acceso programático
El acceso a los archivos sigue la ruta lógica de la estructura. Por ejemplo:

- Archivos del primer trimestre de 2024, fracción 1 de `art66`:
  ```
  archivos/art66/fracc1/año2024/trim1/
  ```

- Archivos del segundo trimestre de 2024, fracción 3 de `art67`:
  ```
  archivos/art67/fracc3/año2024/trim2/
  ```

---


# Proyecto de Página Web

Este documento describe la estructura del proyecto de una página web, los archivos incluidos y las funcionalidades implementadas. A continuación, se detalla la estructura del proyecto y las descripciones de los principales archivos.

---
## Descripción de Archivos Principales

### `index.php`
Este archivo representa la página principal de la aplicación web. Incluye las siguientes secciones:
- **Cabecera:** Utiliza `header.php` desde la carpeta `assets/layouts`.
- **Carrusel:** Implementa un carrusel con dos imágenes rotativas extraídas de `assets/images/carousel`.
- **Pie de página:** Utiliza `footer.php` desde la carpeta `assets/layouts`.


### `transparencia.php`
Este archivo gestiona el contenido de las secciones **Art66** y **Art67**, mostrando documentos organizados por categorías, fracciones, años y trimestres. También implementa modales para ver y descargar archivos disponibles en las carpetas especificadas.

---

## Archivos Estáticos

### `assets/css/styles.css`
Contiene los estilos principales de la página.

### `assets/images`
- **Art66** y **Art67:** Imágenes relacionadas con las fracciones de cada artículo.
- **banner:** Imágenes para encabezados o banners.
- **carousel:** Imágenes utilizadas en el carrusel principal de la página.
- **logo:** Logotipo utilizado como favicon y otros.
- **imagesfooter:** Imágenes del pie de página.

---

## Dependencias
El proyecto utiliza las siguientes herramientas y librerías:
- [Bootstrap 5.3.0](https://getbootstrap.com/)
- [Font Awesome](https://fontawesome.com/)
- [Google Fonts (Poppins)](https://fonts.google.com/)

---


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

Para cualquier consulta o sugerencia, por favor contacta a [soporte@iktansystem.uk](mailto:soporte@iktansystem.uk).



## Autor
Proyecto desarrollado para fines de gestión y organización de documentos.
