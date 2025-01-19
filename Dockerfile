FROM php:8.2-apache

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install zip pdo pdo_mysql

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Instala dependências do Composer
RUN if [ -f "composer.json" ]; then \
        composer install --no-interaction --optimize-autoloader; \
    fi

# Ajusta as permissões
RUN chown -R www-data:www-data /var/www/html 