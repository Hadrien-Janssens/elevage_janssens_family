FROM dunglas/frankenphp

# Installation des dépendances système et PHP pour SQLite
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pcntl bcmath

# Définition du répertoire de travail
WORKDIR /app

# Copie du code source
COPY . .

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Droits sur les dossiers de stockage
RUN chown -R www-data:www-data storage bootstrap/cache

# Configuration pour SQLite
RUN touch database/database.sqlite && chown www-data:www-data database/database.sqlite

# Exposition du port
EXPOSE 8000

# Commande de démarrage (FrankenPHP)
CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8000"]
