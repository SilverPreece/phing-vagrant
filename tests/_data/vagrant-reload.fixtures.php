<?php

use Codeception\Util\Fixtures;

// @TODO: Figure out how to trigger errors and collect failure fixtures
Fixtures::add('reload.default.success', [
    '1558054114,one,metadata,provider,virtualbox',
    '1558054114,two,metadata,provider,virtualbox',
    '1558054114,one,action,reload,start',
    '1558054115,one,ui,output,==> one: Attempting graceful shutdown of VM...',
    '1558054120,one,ui,output,==> one: Checking if box \'ubuntu/bionic64\' version \'20190513.0.0\' is up to date...',
    '1558054121,one,ui,info,==> one: Clearing any previously set forwarded ports...',
    '1558054122,one,ui,info,==> one: Clearing any previously set network interfaces...',
    '1558054122,one,ui,output,==> one: Preparing network interfaces based on configuration...',
    '1558054122,one,ui,detail,    one: Adapter 1: nat',
    '1558054122,one,ui,output,==> one: Forwarding ports...',
    '1558054122,one,ui,detail,    one: 22 (guest) => 2222 (host) (adapter 1)',
    '1558054122,one,ui,info,==> one: Running \'pre-boot\' VM customizations...',
    '1558054122,one,ui,info,==> one: Booting VM...',
    '1558054123,one,ui,output,==> one: Waiting for machine to boot. This may take a few minutes...',
    '1558054123,one,ui,detail,    one: SSH address: 127.0.0.1:2222',
    '1558054123,one,ui,detail,    one: SSH username: vagrant',
    '1558054123,one,ui,detail,    one: SSH auth method: private key',
    '1558054140,one,ui,output,==> one: Machine booted and ready!',
    '1558054140,,ui,success,[one] GuestAdditions 5.2.18 running --- OK.',
    '1558054141,one,ui,output,==> one: Checking for guest additions in VM...',
    '1558054141,one,ui,output,==> one: Mounting shared folders...',
    '1558054141,one,ui,detail,    one: /vagrant => /path/to/phing-vagrant',
    '1558054143,one,ui,info,==> one: Machine already provisioned. Run `vagrant provision` or use the `--provision`\n==> one: flag to force provisioning. Provisioners marked to run always will still run.',
    '1558054143,one,action,reload,end',
    '1558054143,two,action,reload,start',
    '1558054143,two,ui,output,==> two: Attempting graceful shutdown of VM...',
    '1558054149,two,ui,output,==> two: Checking if box \'ubuntu/bionic64\' version \'20190513.0.0\' is up to date...',
    '1558054149,two,ui,info,==> two: Clearing any previously set forwarded ports...',
    '1558054150,two,ui,info,==> two: Fixed port collision for 22 => 2222. Now on port 2200.',
    '1558054150,two,ui,info,==> two: Clearing any previously set network interfaces...',
    '1558054150,two,ui,output,==> two: Preparing network interfaces based on configuration...',
    '1558054150,two,ui,detail,    two: Adapter 1: nat',
    '1558054150,two,ui,output,==> two: Forwarding ports...',
    '1558054150,two,ui,detail,    two: 22 (guest) => 2200 (host) (adapter 1)',
    '1558054150,two,ui,info,==> two: Running \'pre-boot\' VM customizations...',
    '1558054151,two,ui,info,==> two: Booting VM...',
    '1558054151,two,ui,output,==> two: Waiting for machine to boot. This may take a few minutes...',
    '1558054151,two,ui,detail,    two: SSH address: 127.0.0.1:2200',
    '1558054151,two,ui,detail,    two: SSH username: vagrant',
    '1558054151,two,ui,detail,    two: SSH auth method: private key',
    '1558054168,two,ui,output,==> two: Machine booted and ready!',
    '1558054169,,ui,success,[two] GuestAdditions 5.2.18 running --- OK.',
    '1558054169,two,ui,output,==> two: Checking for guest additions in VM...',
    '1558054169,two,ui,output,==> two: Mounting shared folders...',
    '1558054169,two,ui,detail,    two: /vagrant => /path/to/phing-vagrant',
    '1558054171,two,ui,info,==> two: Machine already provisioned. Run `vagrant provision` or use the `--provision`\n==> two: flag to force provisioning. Provisioners marked to run always will still run.',
    '1558054171,two,action,reload,end'
]);

Fixtures::add('reload.default.failure', []);

Fixtures::add('reload.machine-id.success', [
    '1558054864,one,metadata,provider,virtualbox',
    '1558054864,one,action,reload,start',
    '1558054865,one,ui,output,==> one: Attempting graceful shutdown of VM...',
    '1558054870,one,ui,output,==> one: Checking if box \'ubuntu/bionic64\' version \'20190513.0.0\' is up to date...',
    '1558054871,one,ui,info,==> one: Clearing any previously set forwarded ports...',
    '1558054872,one,ui,info,==> one: Clearing any previously set network interfaces...',
    '1558054872,one,ui,output,==> one: Preparing network interfaces based on configuration...',
    '1558054872,one,ui,detail,    one: Adapter 1: nat',
    '1558054872,one,ui,output,==> one: Forwarding ports...',
    '1558054872,one,ui,detail,    one: 22 (guest) => 2222 (host) (adapter 1)',
    '1558054872,one,ui,info,==> one: Running \'pre-boot\' VM customizations...',
    '1558054873,one,ui,info,==> one: Booting VM...',
    '1558054873,one,ui,output,==> one: Waiting for machine to boot. This may take a few minutes...',
    '1558054873,one,ui,detail,    one: SSH address: 127.0.0.1:2222',
    '1558054873,one,ui,detail,    one: SSH username: vagrant',
    '1558054873,one,ui,detail,    one: SSH auth method: private key',
    '1558054897,one,ui,output,==> one: Machine booted and ready!',
    '1558054897,,ui,success,[one] GuestAdditions 5.2.18 running --- OK.',
    '1558054898,one,ui,output,==> one: Checking for guest additions in VM...',
    '1558054898,one,ui,output,==> one: Mounting shared folders...',
    '1558054898,one,ui,detail,    one: /vagrant => /media/veracrypt1/Programming/NetbeansProjects/phing-vagrant',
    '1558054900,one,ui,info,==> one: Machine already provisioned. Run `vagrant provision` or use the `--provision`\n==> one: flag to force provisioning. Provisioners marked to run always will still run.',
    '1558054900,one,action,reload,end'
]);

Fixtures::add('reload.machine-id.failure', []);

Fixtures::add('reload.machine-name.success', Fixtures::get('reload.machine-id.success'));

Fixtures::add('reload.machine-name.success', []);

Fixtures::add('reload.provision.success', Fixtures::get('reload.default.success'));

Fixtures::add('reload.provision.failure', []);

Fixtures::add('reload.provisioners.success', Fixtures::get('reload.default.success'));

Fixtures::add('reload.provisioners.failure', []);
