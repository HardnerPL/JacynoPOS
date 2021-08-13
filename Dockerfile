FROM php:8.0-apache

# Add MySQL Client
RUN docker-php-ext-install mysqli

# Configure Apache
RUN a2enmod rewrite
RUN rm /etc/apache2/sites-enabled/000-default.conf
COPY ./infrastructure/apache/website.conf /etc/apache2/sites-available
RUN ln -s /etc/apache2/sites-available/website.conf /etc/apache2/sites-enabled/website.conf

# Copy Scripts
COPY ./infrastructure/scripts /scripts

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
