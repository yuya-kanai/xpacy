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
    
  
  config.vm.network "private_network", ip: "192.168.33.10"
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
        sudo yum -y update
        yum install wget
        
        # mysql
        wget http://repo.mysql.com/mysql-community-release-el7-5.noarch.rpm
        sudo rpm -ivh mysql-community-release-el7-5.noarch.rpm
        yum update
        sudo yum install mysql-server

        # php
        sudo yum install php php-pear php-mysql
        sudo mkdir /var/log/php
        sudo chown apache /var/log/php

        # Apache
        yum -y install httpd

        #Transfer files
        cp -a /vagrant/httpd.conf /etc/httpd/conf/
        cp -a /vagrant/php.conf /etc/httpd/conf.d/
        

        /sbin/service httpd restart
        /sbin/chkconfig httpd on
  EOT
end
