# 使用官方 PHP 镜像，带有 Apache
FROM php:8.2.9-apache

# 安装系统依赖和 PHP 扩展
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 安装 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 设置工作目录
WORKDIR /var/www/html

# 复制当前目录内容到工作目录
COPY . .

# 修改 Apache 配置
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# 复制 Laravel Apache 配置
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# 暴露端口
EXPOSE 80

# 运行 Apache
CMD ["apache2-foreground"]
