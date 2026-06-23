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

# Fix Apache self-referential redirects leaking internal port (e.g. :8080) behind proxy
# Clean up any previously appended settings to keep the file clean on restarts
sed -i '/UseCanonicalName/d' /etc/apache2/apache2.conf
sed -i '/UseCanonicalPhysicalPort/d' /etc/apache2/apache2.conf
sed -i '/ServerName/d' /etc/apache2/apache2.conf

if [ -n "$RAILWAY_PUBLIC_DOMAIN" ]; then
  echo "Configuring Apache ServerName to prevent port leaks ($RAILWAY_PUBLIC_DOMAIN)..."
  echo "ServerName https://$RAILWAY_PUBLIC_DOMAIN" >> /etc/apache2/apache2.conf
  echo "UseCanonicalName On" >> /etc/apache2/apache2.conf
fi

# Run database translation in the background (allows MySQL to initialize first)
(sleep 10 && php /var/www/html/translate_db.php) >/dev/null 2>&1 &

echo "=== Starting Apache ==="
exec "$@"
