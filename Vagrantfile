Vagrant.configure("2") do |config|
  config.nfs.map_uid = 0
  config.nfs.map_gid = 0
  config.ssh.forward_agent = true
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.hostmanager.ignore_private_ip = false
  config.hostmanager.include_offline = true

  config.vm.define :dev do |dev_config|
    dev_config.vm.hostname = "magento-1-7"
    dev_config.vm.box = "precise32"
    dev_config.vm.network :private_network, ip: "10.11.12.14"
    dev_config.vm.synced_folder ".", "/vagrant", :nfs => true

    dev_config.vm.provider :virtualbox do |vb|
     vb.customize ["modifyvm", :id, "--memory", "2048", "--cpus", "4"]
    end

    dev_config.hostmanager.aliases = %w(magento.dev www.magento.dev)
  end


end
