# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  config.vm.box = "base"
  config.vm.box = "centos/7"
  config.vm.network :forwarded_port, id: "http", guest: 80, host: 8823
  config.vm.network :forwarded_port, id: "ssh", guest: 22, host: 22023
  config.vm.network "private_network", ip: "192.168.32.10"
  config.vm.synced_folder ".", "/vagrant", type: "nfs", rsync__exclude: ".git/"

  config.vm.provision "ansible" do |ansible|
  # 設定を適用する対象のサーバーの指定を記述するファイルの指定
  ansible.playbook = "ansible/playbook.yml"
  # サーバーの設定をカスタマイズするためのレシピを記述する設定ファイルの指定
  ansible.inventory_path = "ansible/hosts"
  ansible.limit = 'all'
  end

end

