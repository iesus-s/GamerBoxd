FROM php:8.0-apache

# Update package lists and install required dependencies for mysqli
RUN apt-get update && apt-get install -y \
    libmariadb-dev-compat libmariadb-dev zlib1g-dev \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli 

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY Website/ /var/www/html/

# Set permissions for application files
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html 

# Suppress Apache warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN docker-php-ext-install mysqli

# Expose port 80 & 443
EXPOSE 80 443 
 