# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
#
Vagrant.configure("2") do |config|
  config.vm.box = "centos/7"

  config.vm.synced_folder ".", "/vagrant", type: "nfs", rsync__exclude: ".git/"
    
  
  config.vm.network "private_network", ip: "192.168.32.10"
  config.vm.provider "virtualbox" do |vb|
    vb.gui = true
  end

  config.vm.provision "shell", inline: <<-EOT
        # timezone
        cp -p /usr/share/zoneinfo/Japan /etc/localtime

        # iptables off
        /sbin/iptables -F
        /sbin/service iptables stop
        /sbin/chkconfig iptables off
        
        # yum and wget
        dnf clean packages
        sudo yum update -y
        sudo yum install -y wget

        # mysql
        wget http://repo.mysql.com/mysql-community-release-el7-5.noarch.rpm
        sudo rpm -ivh mysql-community-release-el7-5.noarch.rpm
        yum update
        sudo yum install mysql-server

        # php
        wget http://dl.fedoraproject.org/pub/epel/7/x86_64/e/epel-release-7-9.noarch.rpm ~/
        rpm -ivh ~/epel-release-7-9.noarch.rpm
        sudo yum install epel-release yum-utils
        sudo yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm
        sudo yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
        sudo yum-config-manager --enable remi-php73
        sudo yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm
        sudo yum install -y remi-php71 php php-devel php-mbstring php-pdo php-gd php-xml php-mcrypt php-mysqlnd php-cli php-gd php-opcache

        # sudo mkdir /var/log/php
        # sudo chown apache /var/log/php

        # composer
        yum install composer 
        chmod 777 /vagrant/xpacy
        cd /vagrant/xpacy

        # Apache
        yum -y install httpd
        #Transfer files

        # /sbin/service httpd restart
        # /sbin/chkconfig httpd on
        php artisan serve --host 0.0.0.0
  EOT
end
