# Utiliser l'image officielle de PHP avec Apache
FROM php:8.3-apache

# Définir le répertoire de travail du container
WORKDIR /var/www/html

# Installer les dépendances nécessaires pour les extensions PHP
RUN apt-get update && apt-get install nano git -y

# Voir https://github.com/mlocati/docker-php-extension-installer
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN install-php-extensions xdebug \
    intl \
    pdo_mysql \
    gd \
    zip \
    xml \
    exif

# Activer le module mod_rewrite
RUN a2enmod rewrite

# Copier le fichier de configuration d'Apache pour permettre les fichiers .htaccess
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Changer les permissions pour le répertoire /var/www
RUN chown -R www-data:www-data /var/www

# Créer un nouvel utilisateur
RUN adduser --disabled-password --gecos '' developer

# Ajouter l'utilisateur au groupe www-data
RUN chown -R developer:www-data /var/www

# Définir les permissions
RUN chmod 755 /var/www

# Basculer vers cet utilisateur
USER developer

# Exposer le port 80 pour Apache
EXPOSE 80

# Définir le point d'entrée pour démarrer Apache
CMD ["apache2-foreground"]