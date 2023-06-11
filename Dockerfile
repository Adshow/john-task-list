# Use the official PHP image as the base image
FROM php:8.0-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the project files to the container
COPY . /var/www/html

# Install PHP extensions and dependencies
RUN docker-php-ext-install pdo_mysql

# Set up Apache document root
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]