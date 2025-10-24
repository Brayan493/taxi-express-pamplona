#!/bin/bash
# Script para debugging de assets en producción

echo "🔍 DIAGNÓSTICO DE ASSETS"
echo "========================"

echo ""
echo "1️⃣ Verificando Node.js y NPM:"
node --version || echo "❌ Node no instalado"
npm --version || echo "❌ NPM no instalado"

echo ""
echo "2️⃣ Verificando package.json:"
cat package.json | grep -A 5 "scripts" || echo "❌ No se encontró package.json"

echo ""
echo "3️⃣ Verificando vite.config.js:"
[ -f "vite.config.js" ] && echo "✅ vite.config.js existe" || echo "❌ vite.config.js NO existe"

echo ""
echo "4️⃣ Ejecutando npm run build:"
npm run build

echo ""
echo "5️⃣ Verificando public/build:"
if [ -d "public/build" ]; then
    echo "✅ Directorio public/build existe"
    echo ""
    echo "Estructura de archivos:"
    tree public/build || ls -R public/build
    echo ""
    echo "Tamaño de archivos:"
    du -h public/build/*
else
    echo "❌ Directorio public/build NO existe"
fi

echo ""
echo "6️⃣ Verificando manifest.json:"
if [ -f "public/build/manifest.json" ]; then
    echo "✅ manifest.json existe"
    echo ""
    echo "Contenido:"
    cat public/build/manifest.json | jq '.' || cat public/build/manifest.json
else
    echo "❌ manifest.json NO existe"
fi

echo ""
echo "7️⃣ Verificando archivos CSS:"
find public/build -name "*.css" -type f -exec ls -lh {} \; || echo "❌ No se encontraron archivos CSS"

echo ""
echo "8️⃣ Verificando archivos JS:"
find public/build -name "*.js" -type f -exec ls -lh {} \; || echo "❌ No se encontraron archivos JS"

echo ""
echo "9️⃣ Verificando permisos:"
ls -la public/build/ || echo "❌ No se puede listar public/build"

echo ""
echo "========================"
echo "✅ Diagnóstico completado"