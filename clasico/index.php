<?php
// index.php — Inicio: lista categorías y algunos productos

function getData() {
    $json = '{
      "categorias": [
        {"slug": "cocinas", "nombre": "Cocinas"},
        {"slug": "banos", "nombre": "Baños"},
        {"slug": "electrohogar", "nombre": "Electrohogar"}
      ],
      "productos": [
        {"id": 1, "nombre": "Mueble Cocina Blanco", "precio": 799.99, "categoria_slug": "cocinas", "descripcion": "Cocina modular con acabado blanco mate."},
        {"id": 2, "nombre": "Encimera Granito", "precio": 299.00, "categoria_slug": "cocinas", "descripcion": "Encimera resistente de granito natural."},
        {"id": 3, "nombre": "Lavabo Suspendido", "precio": 159.50, "categoria_slug": "banos", "descripcion": "Lavabo con instalación suspendida y sifón oculto."},
        {"id": 4, "nombre": "Mampara Ducha 120", "precio": 220.00, "categoria_slug": "banos", "descripcion": "Mampara corredera templada 6mm."},
        {"id": 5, "nombre": "Lavadora 8kg A+++", "precio": 399.90, "categoria_slug": "electrohogar", "descripcion": "Lavadora eficiente con 15 programas."},
        {"id": 6, "nombre": "Nueva Lavadora 8kg A+++", "precio": 1399.90, "categoria_slug": "electrohogar", "descripcion": "Nueva Lavadora takataa eficiente con 15 programas."}      
        ]
    }';
    return json_decode($json, true);
}

$data = getData();
$categorias = $data['categorias'];
$productos = $data['productos'];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Tienda — Inicio</title>
</head>
<body>
  <h1>Tienda (arquitectura clásica PHP)</h1>

  <h2>Categorías</h2>
  <ul>
    <?php foreach ($categorias as $cat): ?>
      <li>
        <a href="categoria.php?slug=<?php echo urlencode($cat['slug']); ?>">
          <?php echo htmlspecialchars($cat['nombre']); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>

  <h2>Productos destacados</h2>
  <ul>
    <?php foreach ($productos as $p): ?>
      <li>
        <a href="producto.php?id=<?php echo (int)$p['id']; ?>">
          <?php echo htmlspecialchars($p['nombre']); ?>
        </a>
        — <?php echo number_format($p['precio'], 2, ',', '.'); ?> €
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
