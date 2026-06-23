#!/bin/bash
set -e

echo "=== Entrypoint script started ==="

# Disable conflicting MPMs
echo "Disabling mpm_event and mpm_worker..."
a2dismod mpm_event mpm_worker || true

echo "Enabling mpm_prefork..."
a2enmod mpm_prefork || true

echo "=== Starting Apache ==="
exec apache2-foreground "$@"
