<p align="center">
    <h1 align="center">Kod źródłowy dockerfile konterena </h1>
    <h2 align="center">na potrzeby aplikacji "Moje ulubione miejsca"</h2>
</p>

```FROM centos:7

# Aktualizacja systemu kontenera i instalacja Apache2
RUN yum -y update
RUN yum -y install httpd httpd-tools curl

# Instalacja repozytorium EPEL
RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.                                                                                                                                                             rpm \
 && rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm

# Instalacja PHP w wersji 7.2 wraz z niezbędnymi rozszerzeniami potrzebnymi do p                                                                                                                                                             rawidłowego funkcjonowania
# framework'a Yii2.
RUN yum -y install php72w php72w-bcmath php72w-cli php72w-common php72w-gd php72                                                                                                                                                             w-intl php72w-ldap php72w-mbstring \
php72w-mysql php72w-pear php72w-soap php72w-xml php72w-xmlrpc php-zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local                                                                                                                                                             /bin --filename=composer
RUN composer create-project yiisoft/yii2-app-basic /var/www/html

# Update Apache Configuration
RUN sed -E -i -e '/<Directory "\/var\/www\/html">/,/<\/Directory>/s/AllowOverrid                                                                                                                                                             e None/AllowOverride All/' /etc/httpd/conf/httpd.conf
RUN sed -E -i -e 's/DirectoryIndex (.*)$/DirectoryIndex index.php \1/g' /etc/htt                                                                                                                                                             pd/conf/httpd.conf
RUN sed -i 's/www\/html/www\/html\/web/' /etc/httpd/conf/httpd.conf

# Instalacja PostgreSQL
#RUN yum -y install postgresql-server postgresql-contrib
#RUN /etc/init.d/postgresql start

# Tymczasowo do następnych zajęć zahaszowane - działa ok.
RUN yum -y install wget unzip git
RUN git clone https://github.com/161587/mojeMiejsca_AI.git temp\
        && cd /temp\
        && cd Moje\ ulubione\ miejsca\
        && yes | cp -R * /var/www/html\
        && cd /\
        && rm -Rf temp

## Pozostaje usunąć z plików z ostrzeżeniami PHP słowo Yii

EXPOSE 80

# Start Apache
CMD ["/usr/sbin/httpd","-D","FOREGROUND"]
```
