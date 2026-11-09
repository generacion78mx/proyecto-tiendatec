#!/usr/bin/env bash
# Prepara el entorno del curso dentro de Codespaces:
#   1. PHP con la extensión pdo_mysql (el PHP por defecto de Codespaces no la trae)
#   2. MariaDB, con una base y un usuario SOLO para desarrollo
#   3. Adminer, para ver y editar la base desde el navegador
# Se puede ejecutar varias veces sin romper nada.

set -u
cd "$(dirname "$0")/.." || exit 1

BASE="proyecto"
USUARIO="app"
CLAVE="app123"
ADMINER_VERSION="5.4.1"
ADMINER_URL="https://github.com/vrana/adminer/releases/download/v${ADMINER_VERSION}/adminer-${ADMINER_VERSION}.php"

SUDO=""
if [ "$(id -u)" -ne 0 ]; then SUDO="sudo"; fi

paso() { echo; echo "== $1"; }

paso "1/6 Instalando MariaDB y PHP con pdo_mysql"
$SUDO apt-get update -qq || echo "[AVISO] apt-get update marcó advertencias; se continúa."
if ! DEBIAN_FRONTEND=noninteractive $SUDO apt-get install -y -qq \
     mariadb-server php-cli php-mysql php-mbstring php-xml php-curl; then
  echo "[FALLO] No se pudo instalar. Copia el mensaje de arriba y avisa a tu profesor."
  exit 1
fi

paso "2/6 Iniciando MariaDB"
bash .devcontainer/iniciar-mariadb.sh || exit 1

paso "3/6 Creando la base '${BASE}' y el usuario '${USUARIO}' (solo desarrollo)"
$SUDO mysql <<SQL
CREATE DATABASE IF NOT EXISTS ${BASE} CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE USER IF NOT EXISTS '${USUARIO}'@'localhost' IDENTIFIED BY '${CLAVE}';
CREATE USER IF NOT EXISTS '${USUARIO}'@'127.0.0.1' IDENTIFIED BY '${CLAVE}';
GRANT ALL PRIVILEGES ON ${BASE}.* TO '${USUARIO}'@'localhost';
GRANT ALL PRIVILEGES ON ${BASE}.* TO '${USUARIO}'@'127.0.0.1';
FLUSH PRIVILEGES;
SQL

paso "4/6 Haciendo que 'php' sea el PHP con pdo_mysql"
if [ -x /usr/bin/php ]; then
  mkdir -p "$HOME/.local/bin"
  ln -sf /usr/bin/php "$HOME/.local/bin/php"
  LINEA='export PATH="$HOME/.local/bin:$PATH"  # PHP con pdo_mysql (curso Aplicaciones Web)'
  for archivo in "$HOME/.bashrc" "$HOME/.zshrc"; do
    if [ -f "$archivo" ] || [ "$archivo" = "$HOME/.bashrc" ]; then
      grep -qF '.local/bin:$PATH"  # PHP con pdo_mysql' "$archivo" 2>/dev/null || echo "$LINEA" >> "$archivo"
    fi
  done
fi

paso "5/6 Mostrando los errores de PHP en el navegador (solo desarrollo)"
if [ -x /usr/bin/php ]; then
  RUTA_INI="$(/usr/bin/php --ini | sed -n 's/^Scan for additional .ini files in: *//p')"
  if [ -n "$RUTA_INI" ] && [ -d "$RUTA_INI" ]; then
    printf 'display_errors=1\nerror_reporting=E_ALL\nlog_errors=1\n' | $SUDO tee "$RUTA_INI/99-desarrollo.ini" >/dev/null
    echo "Configuración escrita en $RUTA_INI/99-desarrollo.ini"
  else
    echo "[AVISO] No se encontró la carpeta de configuración de PHP; los errores solo saldrán en la terminal."
  fi
fi

paso "6/6 Descargando Adminer (administrador web de la base)"
mkdir -p dev
if [ -f dev/adminer.php ]; then
  echo "Adminer ya estaba descargado."
elif curl -fsSL -o dev/adminer.php "$ADMINER_URL"; then
  echo "Adminer ${ADMINER_VERSION} descargado en dev/adminer.php"
else
  rm -f dev/adminer.php
  echo "[AVISO] No se pudo descargar Adminer. Se puede repetir más tarde con este mismo script."
fi

echo
echo "Listo. Abre una terminal nueva y ejecuta: php entorno/verificar-entorno.php"
echo "Datos de conexión (solo desarrollo): host 127.0.0.1 · puerto 3306 · base ${BASE} · usuario ${USUARIO} · clave ${CLAVE}"
