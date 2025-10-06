param(
  [string]$ProjectPath = "tienda-ng"
)

if (!(Test-Path $ProjectPath)) {
  Write-Error "La ruta de destino no existe: $ProjectPath"
  exit 1
}

Write-Host "Copiando archivos Angular a: $ProjectPath"
Copy-Item -Path "angular-files\*" -Destination $ProjectPath -Recurse -Force

Write-Host "Hecho. Dentro de $ProjectPath ejecuta:"
Write-Host "  npm install"
Write-Host "  npx ng serve -o"
