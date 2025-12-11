FROM wordpress:php8.1-apache

# Install Node, npm, yarn, composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    nano \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install --global yarn \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite
