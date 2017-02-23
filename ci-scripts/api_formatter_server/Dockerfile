# Pull from the ubuntu:14.04 image
FROM ubuntu:16.04

# Set the author
MAINTAINER Ferran Ferri <ferran.ferri@waynabox.com>

# Update cache and install base packages
RUN apt-get update && apt-get -y install \
   software-properties-common \
   python-software-properties \
   debian-archive-keyring \
   wget \
   curl \
   vim \
   aptitude \
   dialog \
   net-tools \
   mcrypt \
   build-essential \
   tcl8.5 \
   git

# Download Nginx signing key
RUN apt-key adv --recv-keys --keyserver keyserver.ubuntu.com C300EE8C

# Add to repository sources list
RUN add-apt-repository ppa:nginx/stable
RUN apt-get update

# Add to repository sources list
RUN apt-get update
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt-get upgrade -y

# Update cache and install Nginx
RUN apt-get install nginx -y
RUN apt-get update
RUN apt-get install php7.0-fpm php7.0-cli php7.0-bcmath php7.0-mcrypt php7.0-xdebug php7.0-json php7.0-opcache php7.0-mysql php7.0-mbstring php7.0-gd php7.0-imap php7.0-intl php7.0-gd php7.0-curl php7.0-zip php7.0-xml -y
RUN apt-get --purge autoremove -y


# Mount volumes
VOLUME /etc/nginx/conf.d
VOLUME /var/log/nginx/
VOLUME /var/www/current

# Set the current working directory
WORKDIR /var/www/current

# Expose port 80
EXPOSE 80
EXPOSE 443

# Fix TPV problem with mcrypt.
# RUN php5enmod mcrypt
RUN mkdir -p /usr/local/bin
COPY scripts/*.* /usr/local/bin/


# port needed by xdebug
EXPOSE 9000

# define entrypoint
ENTRYPOINT ["/bin/bash", "/usr/local/bin/start.sh"]

# USER www-data


