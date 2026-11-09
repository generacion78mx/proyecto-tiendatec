#!/usr/bin/env bash
# Inicia MariaDB y espera a que responda. Se ejecuta cada vez que arranca el Codespaces.

SUDO=""
if [ "$(id -u)" -ne 0 ]; then SUDO="sudo"; fi

if ! command -v mariadbd >/dev/null 2>&1 && ! command -v mysqld >/dev/null 2>&1; then
  echo "[AVISO] MariaDB no está instalada. Ejecuta: bash .devcontainer/instalar-entorno.sh"
  exit 1
fi

$SUDO mkdir -p /run/mysqld
$SUDO chown mysql:mysql /run/mysqld
$SUDO service mariadb start >/dev/null 2>&1

for intento in $(seq 1 30); do
  if $SUDO mysqladmin ping --silent >/dev/null 2>&1; then
    echo "[OK] MariaDB lista."
    exit 0
  fi
  sleep 1
done

echo "[FALLO] MariaDB no respondió en 30 segundos. Revisa: sudo tail -n 30 /var/log/mysql/error.log"
exit 1
