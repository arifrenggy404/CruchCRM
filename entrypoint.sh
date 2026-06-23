#!/bin/bash
set -e

echo "=== Entrypoint script started ==="

# Disable conflicting MPMs
echo "Disabling mpm_event and mpm_worker..."
a2dismod mpm_event mpm_worker || true

echo "Enabling mpm_prefork..."
a2enmod mpm_prefork || true

# Dynamic port configuration for Railway
if [ -n "$PORT" ]; then
  echo "Configuring Apache to listen on dynamic port $PORT..."
  sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
  sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/g" /etc/apache2/sites-available/000-default.conf
fi

echo "=== Starting Apache ==="
exec "$@"
