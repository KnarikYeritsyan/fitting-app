# Deploy Server laravel project

## making up server environment

#### apache
- **[install apache on linux server](https://phoenixnap.com/kb/how-to-install-apache-web-server-on-ubuntu-18-04)**

```
sudo apt-get update
sudo apt-get install apache2
sudo apt install ufw
sudo a2enmod rewrite
ufw allow "WWW Full"

ufw app update "Apache"
sudo ufw allow 'Apache'









sudo service apache2 restart
systemctl restart apache2
enable module - sudo a2enmod name_of_module
disable module - sudo a2dismod name_of_module
```
- **[Install PHP 8.3 on Debian server](https://php.watch/articles/php-8.3-install-upgrade-on-debian-ubuntu)**

```
# check server release
lsb_release -a
# Save existing php package list to packages.txt file
sudo dpkg -l | grep php | tee packages.txt
# Add Ondrej's repo source and signing key along with dependencies
sudo apt install apt-transport-https
sudo curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg
sudo sh -c 'echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
sudo apt update
# Install PHP 8.3 for Apache
sudo apt install libapache2-mod-php8.3
# Install PHP 8.3 Packages 
sudo apt install php8.3-common php8.3-cli php8.3-fpm php8.3-{curl,bz2,mbstring,intl}
# Install PHP 8.3 Extensions 
sudo apt-get install php8.3-xml
sudo apt-get install php8.3-dom
# Web Server Integration 
sudo a2enmod php8.3
sudo systemctl restart apache2
php --version
```

- **[Install PHP 8.2 on Debian server](https://php.watch/articles/php-8.3-install-upgrade-on-debian-ubuntu)**

```
# check server release
lsb_release -a
# Save existing php package list to packages.txt file
sudo dpkg -l | grep php | tee packages.txt
# Add Ondrej's repo source and signing key along with dependencies
sudo apt install apt-transport-https
sudo curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg
sudo sh -c 'echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
sudo apt update
# Install PHP 8.2 for Apache
sudo apt install libapache2-mod-php8.2
# Install PHP 8.2 Packages 
sudo apt install php8.2-common php8.2-cli php8.2-fpm php8.2-{curl,bz2,mbstring,intl}
# Install PHP 8.2 Extensions 
sudo apt-get install php8.2-xml
sudo apt-get install php8.2-dom
sudo apt-get install php8.2-zip
# Web Server Integration 
sudo a2enmod php8.2
sudo systemctl restart apache2
apt-get install --yes zip unzip 
php --version
```

#### install composer
- **[install composer on linux server]()**
```
sudo apt-get update
sudo apt-get install curl
sudo curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

Configuration Files
```
website content - /var/www/html/
error logs - /var/log/apache2/error.log
main Apache configuration file - /etc/apache2/apache2.conf
port configuration file - /etc/apache2/ports.conf
virtual host files - /etc/apache2/sites-available
```
- **[change apache document root folder](https://askubuntu.com/questions/337874/change-apache-document-root-folder-to-secondary-hard-drive)**
```
nano /etc/apache2/sites-available/000-default.conf
```
**Edit the DocumentRoot option:**
```
DocumentRoot /path/to/my/project
```
- **[Enable .htaccess File On Apache](https://phoenixnap.com/kb/how-to-set-up-enable-htaccess-apache)**

```
nano /etc/apache2/apache2.conf
```
**Change to**
```
<Directory />                                                                                                               
    Options Indexes FollowSymLinks
    AllowOverride None
    Require all granted                                                                                                
</Directory>
  
<Directory /var/www/>                                                                                                           
    Options Indexes FollowSymLinks                                                                                          
    AllowOverride All                                                                                                       
    Require all granted                                                                                             
</Directory> 
```
**or exchange ```/var/www/``` to ```/path/to/my/project```**
```
<Directory  /var/www/html/fitting-app/public>                                                                                                           
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted                                                                                             
</Directory>  
```

then
```
sudo service apache2 restart
```

**instal composer dependencies**
```
composer install --ignore-platform-reqs
```
clear configs
```
php artisan config:cache
php artisan cache:clear
php artisan config:clear
```
change permissions
```
sudo chmod -R 777 /var/www/html/fitting-app/storage/logs
sudo chmod -R 777 /var/www/html/fitting-app/storage/framework/sessions
sudo chmod -R 777 /var/www/html/fitting-app/storage/framework/views
sudo chmod -R 777 /var/www/html/fitting-app/storage/framework/cache
sudo chmod -R 777 /var/www/html/fitting-app/storage/app
sudo chmod -R 777 /var/www/html/fitting-app/public
sudo chmod -R 777 /var/www/html/fitting-app/public/assets/
sudo chmod -R 777 /var/www/html/fitting-app/bootstrap/cache
#php artisan storage:link
```
install nodejs lts
```
curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - &&\
apt-get install -y nodejs
```


install python packages and virtual env
```
apt get-install python3-full
sudo apt update
sudo apt install pipx
pipx ensurepath
pipx completions
pipx list
eval "$(register-python-argcomplete pipx)"
pipx install virtualenv
virtualenv venv
pipx install pipenv --python python3.8
source venv/bin/activate
pip3 install numpy
pip3 install scipy
pip3 install pandas
pip3 install sympy
pip3 install json



pipx install numpy
pipx install scipy --include-deps
pipx install sympy
pipx install pandas --include-deps
pipx install json
pipx install sys
pipx install os
```


install python packages
```
apt install python3-numpy
apt install python3-pandas
apt install python3-sympy
apt install python3-scipy
apt install python3-json
apt install python3-sys
apt install python3-os
```
```
sudo apt-get install -y python3-numpy
sudo apt-get install -y python3-pandas
sudo apt-get install -y python3-sympy
sudo apt-get install -y python3-scipy
sudo apt-get install -y python3-json
sudo apt-get install -y python3-sys
sudo apt-get install -y python3-os
```

python3 read-data.py 'storage/cd-examples/large-n/Go et al/go-et-al-1.dat' false
python3 'read-data.py' 'storage/cd-examples/large-n/Go et al/go-et-al-1.dat' true
python3 'read-data.py' 'storage/cd-examples/large-n/Go et al/go-et-al-1.dat' '1'
python3 'fit-helicity-degree-large-N.py' 'storage/cd-examples/large-n/Go et al/go-et-al-1.dat' 'true'
OPENBLAS_CORETYPE=ARMV8 python3 'fit-helicity-degree-large-N.py' 'storage/cd-examples/large-n/Go et al/go-et-al-1.dat' 'true'
OPENBLAS_CORETYPE=ARMV8 python3 'read-data.py' 'storage/cd-examples/large-n/Go et al/go-et-al-1.dat' true

try to update (upgrade, check) sympy and scipy libraries
python3 -c "import scipy; print(scipy.__version__)"
python3 -c "import sympy; print(sympy.__version__)"
python3 -c "import numpy; print(numpy.__version__)"
python3 -c "import pandas; print(pandas.__version__)"
python3 -c "import json; print(json.__version__)"
python3 -c "import sys; print(sys.__version__)"
python3 -c "import os; print(os.__version__)"

python3 '../../read-data.py' '../../storage/cd-examples/large-n/Go et al/go-et-al-1.dat' '1'
python3 '../../fit-helicity-degree-large-N.py' '../../storage/cd-examples/large-n/Go et al/go-et-al-1.dat' 'true'
source /var/www/html/fitting-app/venv/bin/activate && python3 '/var/www/html/fitting-app/read-data.py' '/var/www/html/fitting-app/storage/cd-examples/large-n/Go et al/go-et-al-1.dat' '1'
source /var/www/html/fitting-app/venv/bin/activate && python3 'fit-helicity-degree-large-N.py' 'storage/cd-examples/large-n/Go et al/go-et-al-1.dat' 'true'
