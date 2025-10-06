#!/usr/bin/env bash
# Uso: bash scripts/setup.sh /ruta/a/tienda-ng
set -euo pipefail

DEST="${1:-tienda-ng}"

if [ ! -d "$DEST" ]; then
  echo "La ruta de destino no existe: $DEST"
  exit 1
fi

echo "Copiando archivos Angular a: $DEST"
rsync -a angular-files/ "$DEST"/

echo "Hecho. Recuerda ejecutar dentro de $DEST:"
echo "  npm install"
echo "  npx ng serve -o"
