FROM dunglas/frankenphp:latest

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    npm \
    curl \
    zip \
    unzip \
    sqlite3 \
    openssl \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Install Node dependencies and build assets
RUN npm install && npm run build

# Create necessary directories and set permissions
RUN mkdir -p storage/logs bootstrap/cache && \
    chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Generate APP_KEY if not exists
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Expose port (FrankenPHP default)
EXPOSE 80 443

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

# Start FrankenPHP
CMD ["frankenphp", "run", "--listen=0.0.0.0:80"]
