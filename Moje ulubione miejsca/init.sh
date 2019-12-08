#!/bin/sh

# Utworzenie i wejście do katalogu projektu
mkdir yiiApp
cd yiiApp

# Utworzenie pliku Dockerfile do budowy obrazów kontenerów
touch Dockerfile

# Wprowadzenie do pliku Dockerfile danych do budowy
cat > Dockerfile << EOL
FROM centos:7

# Aktualizacja systemu kontenera i instalacja Apache2
RUN yum -y update
RUN yum -y install httpd httpd-tools curl

# Instalacja repozytorium EPEL
RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm \
 && rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm

# Instalacja PHP w wersji 7.2 wraz z niezbędnymi rozszerzeniami potrzebnymi do prawidłowego funkcjonowania
# framework'a Yii2.
RUN yum -y install php72w php72w-bcmath php72w-cli php72w-common php72w-gd php72w-intl php72w-ldap php72w-mbstring \
php72w-pgsql php72w-pear php72w-soap php72w-xml php72w-xmlrpc php-zip
RUN yum clean all

# Ściąganie i instalacja pakietu Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalacja frameworka Yii2
RUN composer create-project yiisoft/yii2-app-basic /var/www/html

# Aktualizacja ustawień Apache2
RUN sed -E -i -e '/<Directory "\/var\/www\/html">/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' /etc/httpd/conf/httpd.conf
RUN sed -E -i -e 's/DirectoryIndex (.*)$/DirectoryIndex index.php \1/g' /etc/httpd/conf/httpd.conf
RUN sed -i 's/www\/html/www\/html\/web/' /etc/httpd/conf/httpd.conf

# Instalacja GIT
RUN yum -y install wget unzip git

# Wprowadzanie zmian na stronie o dane z projektu
RUN git clone https://github.com/161587/mojeMiejsca_AI.git temp\
        && cd /temp\
        && cd Moje\ ulubione\ miejsca\
        && yes | cp -R * /var/www/html\
        && cd /\
        && rm -Rf temp

EXPOSE 80

# Uruchomienie Apache
CMD ["/usr/sbin/httpd","-D","FOREGROUND"]
EOL



# Budowanie obrazu kontenera serwera www
docker build -t yiiapp:latest .
rm Dockerfile

# Uruchomienie kontenera
docker run --name yii -d -p 80:80 yiiapp:latest

# Ściągnięcie kontenera bazy danych postgres i jego uruchomienie
docker pull postgres:latest
docker run --name postgres -d -p 5432:5432 postgres:latest

sleep 5

# Utworzenie pliku do zmian w bazie danych
touch zmianyDB.sql
cat > zmianyDB.sql << EOL
ALTER ROLE postgres WITH PASSWORD 'P@ssw0rd';
CREATE DATABASE yii;
\c yii;
CREATE TABLE places (id serial primary key, ownerid integer, latitude double precision, longitude double precision, text character varying(355), link character varying(355), name character varying(355), grade integer, public boolean);
CREATE TABLE public.uzytkownik (user_id SERIAL PRIMARY KEY, username character varying(50), password character varying(50), email character varying(255), created_on timestamp without time zone, last_login timestamp without time zone, ban boolean, regcode character varying(32));
EOL

# Wprowadzenie zmian w bazie
psql -h localhost -p 5432 -U postgres < zmianyDB.sql
rm zmianyDB.sql

# Utworzenie linku pomiędzy kontenerami
docker network create -d bridge --subnet 10.10.0.0/16 link
docker network connect link postgres
docker network connect link yii
