# README — Tienda Angular 16 + PHP API (Guía de instalación y ejecución)

Este documento explica **cómo poner en marcha** una app de ejemplo con **Angular 16 (frontend)** y **PHP (backend REST que devuelve JSON)**.

## Requisitos previos
- **Node.js 18+** (o 20+ recomendado) y **npm**
  - Comprueba: `node -v` y `npm -v`
- **PHP 8+**
  - Comprueba: `php -v`
- Un editor de código (recomendado VS Code)
- (Opcional) Git

## 1) Descarga y descompresión del paquete
1. Descarga el ZIP proporcionado.
2. Descomprímelo. Verás una estructura como esta:
   ```text
   tienda-angular-php/
   ├─ api/
   │  └─ api.php
   ├─ angular-files/
   │  └─ src/...
   ├─ scripts/
   │  ├─ setup.sh
   │  └─ setup.ps1
   └─ README.md
   ```

## 2) Arrancar la API en PHP
1. Abre una terminal dentro de `tienda-angular-php/api`.
2. Inicia un servidor PHP embebido:
   ```bash
   php -S 127.0.0.1:8000 -t .
   ```
3. La API queda disponible en: `http://127.0.0.1:8000/api.php`

### Endpoints disponibles
- Listar categorías:  `http://127.0.0.1:8000/api.php?resource=categorias`
- Listar productos:   `http://127.0.0.1:8000/api.php?resource=productos`
- Productos por categoría: `http://127.0.0.1:8000/api.php?resource=productos&categoria_slug=cocinas`
- Producto por id:    `http://127.0.0.1:8000/api.php?resource=producto&id=1`

> **Nota:** La API incluye CORS abierto para facilitar el desarrollo local.

## 3) Crear el proyecto Angular 16 con `npx`
1. En **otra terminal** (nueva ventana), sitúate en la carpeta donde quieras crear el proyecto.
2. Crea un proyecto Angular 16 **sin instalar nada global**:
   ```bash
   npx @angular/cli@16 new tienda-ng --routing --style=css
   cd tienda-ng
   ```
3. Si no se instalaron dependencias automáticamente:
   ```bash
   npm install
   ```

## 4) Copiar los archivos del ZIP al proyecto Angular
Desde la carpeta raíz del ZIP descomprimido (`tienda-angular-php/`), ejecuta **uno** de los siguientes scripts para copiar los archivos Angular dentro de `tienda-ng`:

### Opción A — Linux / macOS
```bash
bash scripts/setup.sh ../tienda-ng
```

### Opción B — Windows (PowerShell)
```powershell
.\scripts\setup.ps1 -ProjectPath ..	ienda-ng
```

> Estos scripts copian `angular-files/*` dentro de tu proyecto `tienda-ng`, sobrescribiendo rutas, módulos, componentes y servicios con la versión lista para consumir la API.

## 5) Ejecutar el frontend Angular
1. Entra en la carpeta del proyecto Angular:
   ```bash
   cd ../tienda-ng
   ```
2. Lanza el servidor de desarrollo:
   ```bash
   npm start
   # o
   npx ng serve -o
   ```
3. Abre `http://localhost:4200` en tu navegador. La app ya consumirá la API en `http://127.0.0.1:8000/api.php`.

## 6) Configurar la URL de la API (opcional)
Si quieres apuntar a otra URL (por ejemplo, producción), modifica:
- `src/environments/environment.ts` (desarrollo)
- `src/environments/environment.development.ts` (usado por `ng serve`)
- `src/environments/environment.prod.ts` (producción)

Ejemplo:
```ts
export const environment = {
  production: false,
  apiBaseUrl: 'http://127.0.0.1:8000/api.php'
};
```

## 7) Estructura funcional
- **Páginas**: `Home`, `Categoria`, `Producto`
- **Servicios Angular**: `ApiService`, `CategoriasService`, `ProductosService`
- **Modelos**: `CategoriaModel`, `ProductoModel`
- **API PHP**: `api.php` sirve JSON para `categorias`, `productos`, `producto`

## 8) (Opcional) Generar artefactos con Angular CLI
Si deseas recrear tú mismo los artefactos:

```bash
# En la carpeta del proyecto Angular (tienda-ng)
npx ng g c pages/home
npx ng g c pages/categoria
npx ng g c pages/producto

npx ng g s services/api
npx ng g s services/categorias
npx ng g s services/productos
```

> Después sustituye el contenido de los archivos por el incluido en `angular-files/`.

## 9) Errores frecuentes y consejos
- **CORS/Origen cruzado**: la API ya envía cabeceras `Access-Control-Allow-Origin: *`. Si cambias el dominio/puerto de la API, verifica que se sigan enviando.
- **Versiones de Node**: usa Node 18 o 20. Versiones más antiguas pueden fallar con dependencias modernas.
- **Puerto ocupado**: si `127.0.0.1:8000` está ocupado, usa otro puerto (ej. `php -S 127.0.0.1:8080 -t .`) y actualiza `environment.*.ts`.

## 10) Producción (pista rápida)
- Compila Angular: `npm run build`
- Sirve el `dist/` con Nginx/Apache estático.
- Despliega `api.php` en un hosting PHP o servidor propio (Apache/Nginx + PHP-FPM).
- Ajusta `environment.prod.ts` con la URL real de la API.
