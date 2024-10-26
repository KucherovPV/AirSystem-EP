# Используем официальный образ PHP версии 8.2 с поддержкой FPM
FROM php:8.2-fpm

# Обновляем список пакетов и устанавливаем необходимые зависимости
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpq-dev && \
    docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip

# Очищаем кэш apt и удаляем временные файлы для уменьшения размера образа
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Копируем Composer из последнего образа Composer в текущий контейнер
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создаем пользователя www и группу www
RUN useradd -G www-data,root -u 1000 -d /var/www www

# Устанавливаем рабочую директорию внутри контейнера
WORKDIR /var/www

# Копируем все файлы приложения в рабочую директорию
COPY --chown=www:www . /var/www

# Устанавливаем зависимости Composer
RUN composer install --no-dev --optimize-autoloader

# Переключаем пользователя на www для запуска приложения
USER www

# Открываем порт 9000 для доступа к приложению
EXPOSE 9000

# Определяем команду для запуска PHP-FPM
CMD ["php-fpm"]
