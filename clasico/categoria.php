<?php
// categoria.php — Lista productos por categoría ?slug=...

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
        {"id": 5, "nombre": "Lavadora 8kg A+++", "precio": 399.90, "categoria_slug": "electrohogar", "descripcion": "Lavadora eficiente con 15 programas."}
      ]
    }';
    return json_decode($json, true);
}

function findCategoryBySlug($categorias, $slug) {
    foreach ($categorias as $c) {
        if ($c['slug'] === $slug) return $c;
    }
    return null;
}

$data = getData();
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$categoria = findCategoryBySlug($data['categorias'], $slug);

header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Categoría — <?php echo htmlspecialchars($slug ?: 'Sin categoría'); ?></title>
</head>
<body>
  <p><a href="index.php">← Volver al inicio</a></p>

  <?php if (!$categoria): ?>
    <h1>Categoría no encontrada</h1>
    <p>La categoría solicitada no existe.</p>
  <?php else: ?>
    <h1>Categoría: <?php echo htmlspecialchars($categoria['nombre']); ?></h1>
    <ul>
      <?php foreach ($data['productos'] as $p): ?>
        <?php if ($p['categoria_slug'] === $categoria['slug']): ?>
          <li>
            <a href="producto.php?id=<?php echo (int)$p['id']; ?>">
              <?php echo htmlspecialchars($p['nombre']); ?>
            </a>
            — <?php echo number_format($p['precio'], 2, ',', '.'); ?> €
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</body>
</html>
