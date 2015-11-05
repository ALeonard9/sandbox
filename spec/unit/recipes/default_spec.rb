require 'spec_helper'

describe 'projectorion::default' do
  let(:chef_run) { ChefSpec::SoloRunner.converge(described_recipe) }

  it 'includes all relavent recipes' do
    expect(chef_run).to include_recipe('apache2')
    expect(chef_run).to include_recipe('apache2::mod_php5')
    expect(chef_run).to include_recipe('projectorion::reload_override')
  end
end
