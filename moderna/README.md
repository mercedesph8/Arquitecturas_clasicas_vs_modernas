# Tienda Angular 16 + PHP API (ZIP docente)

Este paquete incluye:
- `api/api.php`: endpoint REST en PHP que devuelve JSON.
- `angular-files/`: archivos Angular listos para copiar a un proyecto nuevo.
- `scripts/setup.sh` y `scripts/setup.ps1`: scripts para copiar los archivos automáticamente.
- Esta guía paso a paso.

## Requisitos
- **Node.js 18+** (o 20+ recomendado)
- **PHP 8+** (para el endpoint)
- Git (opcional)
- Un editor de código (VS Code recomendado)

## 1) Levanta la API PHP
```bash
cd api
php -S 127.0.0.1:8000 -t .
# La API quedará en: http://127.0.0.1:8000/api.php
```

## 2) Crea el proyecto Angular 16 con NPX
> No instalamos nada global. Usamos `npx`.
```bash
# En la carpeta donde quieras el proyecto:
npx @angular/cli@16 new tienda-ng --routing --style=css
cd tienda-ng
```

Si `ng new` no instala dependencias automáticamente, ejecuta:
```bash
npm install
```

## 3) Copia los archivos del ZIP al proyecto
En una terminal ubicada en la carpeta del ZIP:

### Linux / macOS
```bash
bash scripts/setup.sh ../tienda-ng
```

### Windows PowerShell
```powershell
.\scripts\setup.ps1 -ProjectPath ..\tienda-ng
```

> Los scripts copiarán `angular-files/*` dentro de tu proyecto **tienda-ng**,
> sobrescribiendo los archivos necesarios (rutas, módulos, componentes y servicios).

## 4) Arranca Angular (frontend)
```bash
cd ../tienda-ng
npm start
# o
npx ng serve -o
# App: http://localhost:4200
```

El frontend ya consumirá la API PHP en `http://127.0.0.1:8000/api.php`.
Si quieres cambiar la URL, edita:
- `src/environments/environment.ts`
- `src/environments/environment.development.ts`
- `src/environments/environment.prod.ts`

## 5) Estructura de páginas y servicios
- Páginas: `Home`, `Categoria`, `Producto`
- Servicios: `ApiService`, `CategoriasService`, `ProductosService`
- Modelos: `CategoriaModel`, `ProductoModel`

## 6) ¿Quieres generar todo por terminal?
Si prefieres que los alumnos practiquen con CLI (no necesario si copiaste los archivos):

```bash
# Dentro de tienda-ng
npx ng g c pages/home
npx ng g c pages/categoria
npx ng g c pages/producto

npx ng g s services/api
npx ng g s services/categorias
npx ng g s services/productos
```

Luego reemplaza el contenido por el incluido en `angular-files/`.

---

¡Listo! Tienes una arquitectura moderna con frontend Angular 16 y un backend PHP REST JSON.
