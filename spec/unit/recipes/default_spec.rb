require 'spec_helper'
require 'fauxhai'

describe 'projectorion::default' do
  context 'When all are default, on Centos' do
    let(:chef_run) do
      stub_command('/usr/sbin/httpd -t').and_return(nil)
      stub_command('which php').and_return(nil)
      runner = ChefSpec::ServerRunner.new(platform: 'centos', version: '6.5') do |node, server|
        node.automatic['platform'] = 'centos'
        server.create_data_bag('projectorion-bag',
                               'projectorion' =>
                                { 'id' => 'projectorion',
                                  'connection_string' => 'xx',
                                  'user' => 'yy',
                                  'userid' => 'zz'
                                 }
                              )
      end
      runner.converge(described_recipe)
    end
    it 'includes all relavent recipes' do
      expect(chef_run).to include_recipe('apache2')
      expect(chef_run).to include_recipe('apache2::mod_php5')
      expect(chef_run).to include_recipe('projectorion::reload_override')
    end
    it 'restarts apache' do
      expect(chef_run).to restart_service('apache2')
    end
    it 'creates crons' do
      expect(chef_run).to create_cron('node_eraser')
      expect(chef_run).to create_cron('client_eraser')
    end
    it 'creates a remote directory' do
      expect(chef_run).to create_remote_directory('/var/www/cgi-bin')
    end
    it 'creates a template' do
      expect(chef_run).to create_template('/var/www/cgi-bin/connectToDB.php')
    end
    it 'converges successfully' do
      expect { chef_run }.to_not raise_error
    end
  end
end
