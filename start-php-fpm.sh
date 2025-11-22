#!/bin/sh
# Exportar variables de entorno para PHP-FPM
export MYSQLHOST="${MYSQLHOST}"
export MYSQLUSER="${MYSQLUSER}"
export MYSQLPASSWORD="${MYSQLPASSWORD}"
export MYSQLDATABASE="${MYSQLDATABASE}"
export MYSQLPORT="${MYSQLPORT}"

# Iniciar PHP-FPM
exec /usr/sbin/php-fpm82 -F -R