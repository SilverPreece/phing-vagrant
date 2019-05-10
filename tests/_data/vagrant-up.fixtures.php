<?php

use Codeception\Util\Fixtures;

Fixtures::add('up.default.success', [
    '1557413934,one,metadata,provider,virtualbox',
    '1557413934,two,metadata,provider,virtualbox',
    '1557413934,,ui,info,Bringing machine \'one\' up with \'virtualbox\' provider...',
    '1557413934,,ui,info,Bringing machine \'two\' up with \'virtualbox\' provider...',
    '1557413934,one,action,up,start',
    '1557413935,one,ui,output,==> one: Checking if box \'ubuntu/bionic64\' version \'20190314.0.0\' is up to date...',
    '1557413935,one,ui,info,==> one: Clearing any previously set forwarded ports...',
    '1557413937,one,ui,info,==> one: Clearing any previously set network interfaces...',
    '1557413937,one,ui,output,==> one: Preparing network interfaces based on configuration...',
    '1557413937,one,ui,detail,    one: Adapter 1: nat',
    '1557413937,one,ui,output,==> one: Forwarding ports...',
    '1557413937,one,ui,detail,    one: 22 (guest) => 2222 (host) (adapter 1)',
    '1557413937,one,ui,info,==> one: Running \'pre-boot\' VM customizations...',
    '1557413937,one,ui,info,==> one: Booting VM...',
    '1557413937,one,ui,output,==> one: Waiting for machine to boot. This may take a few minutes...',
    '1557413938,one,ui,detail,    one: SSH address: 127.0.0.1:2222',
    '1557413938,one,ui,detail,    one: SSH username: vagrant',
    '1557413938,one,ui,detail,    one: SSH auth method: private key',
    '1557413962,one,ui,output,==> one: Machine booted and ready!',
    '1557413965,,ui,success,[one] GuestAdditions 5.2.18 running --- OK.',
    '1557413965,one,ui,output,==> one: Checking for guest additions in VM...',
    '1557413965,one,ui,output,==> one: Mounting shared folders...',
    '1557413965,one,ui,detail,    one: /vagrant => /path/to/phing-vagrant',
    '1557413967,one,ui,info,==> one: Machine already provisioned. Run `vagrant provision` or use the `--provision`\n==> one: flag to force provisioning. Provisioners marked to run always will still run.',
    '1557413967,one,action,up,end',
    '1557413967,two,action,up,start',
    '1557413967,two,ui,output,==> two: Checking if box \'ubuntu/bionic64\' version \'20190314.0.0\' is up to date...',
    '1557413968,two,ui,info,==> two: Clearing any previously set forwarded ports...',
    '1557413968,two,ui,info,==> two: Fixed port collision for 22 => 2222. Now on port 2200.',
    '1557413969,two,ui,info,==> two: Clearing any previously set network interfaces...',
    '1557413969,two,ui,output,==> two: Preparing network interfaces based on configuration...',
    '1557413969,two,ui,detail,    two: Adapter 1: nat',
    '1557413969,two,ui,output,==> two: Forwarding ports...',
    '1557413969,two,ui,detail,    two: 22 (guest) => 2200 (host) (adapter 1)',
    '1557413969,two,ui,info,==> two: Running \'pre-boot\' VM customizations...',
    '1557413969,two,ui,info,==> two: Booting VM...',
    '1557413970,two,ui,output,==> two: Waiting for machine to boot. This may take a few minutes...',
    '1557413970,two,ui,detail,    two: SSH address: 127.0.0.1:2200',
    '1557413970,two,ui,detail,    two: SSH username: vagrant',
    '1557413970,two,ui,detail,    two: SSH auth method: private key',
    '1557413985,two,ui,detail,    two: Warning: Connection reset. Retrying...',
    '1557413985,two,ui,detail,    two: Warning: Remote connection disconnect. Retrying...',
    '1557413989,two,ui,output,==> two: Machine booted and ready!',
    '1557413991,,ui,success,[two] GuestAdditions 5.2.18 running --- OK.',
    '1557413991,two,ui,output,==> two: Checking for guest additions in VM...',
    '1557413992,two,ui,output,==> two: Mounting shared folders...',
    '1557413992,two,ui,detail,    two: /vagrant => /path/to/phing-vagrant',
    '1557413993,two,ui,info,==> two: Machine already provisioned. Run `vagrant provision` or use the `--provision`\n==> two: flag to force provisioning. Provisioners marked to run always will still run.',
    '1557413993,two,action,up,end'
]);

Fixtures::add('up.default.failure', []);

Fixtures::add('up.machine-id.success', [
    '1557413934,one,metadata,provider,virtualbox',
    '1557413934,,ui,info,Bringing machine \'one\' up with \'virtualbox\' provider...',
    '1557413934,one,action,up,start',
    '1557413935,one,ui,output,==> one: Checking if box \'ubuntu/bionic64\' version \'20190314.0.0\' is up to date...',
    '1557413935,one,ui,info,==> one: Clearing any previously set forwarded ports...',
    '1557413937,one,ui,info,==> one: Clearing any previously set network interfaces...',
    '1557413937,one,ui,output,==> one: Preparing network interfaces based on configuration...',
    '1557413937,one,ui,detail,    one: Adapter 1: nat',
    '1557413937,one,ui,output,==> one: Forwarding ports...',
    '1557413937,one,ui,detail,    one: 22 (guest) => 2222 (host) (adapter 1)',
    '1557413937,one,ui,info,==> one: Running \'pre-boot\' VM customizations...',
    '1557413937,one,ui,info,==> one: Booting VM...',
    '1557413937,one,ui,output,==> one: Waiting for machine to boot. This may take a few minutes...',
    '1557413938,one,ui,detail,    one: SSH address: 127.0.0.1:2222',
    '1557413938,one,ui,detail,    one: SSH username: vagrant',
    '1557413938,one,ui,detail,    one: SSH auth method: private key',
    '1557413962,one,ui,output,==> one: Machine booted and ready!',
    '1557413965,,ui,success,[one] GuestAdditions 5.2.18 running --- OK.',
    '1557413965,one,ui,output,==> one: Checking for guest additions in VM...',
    '1557413965,one,ui,output,==> one: Mounting shared folders...',
    '1557413965,one,ui,detail,    one: /vagrant => /path/to/phing-vagrant',
    '1557413967,one,ui,info,==> one: Machine already provisioned. Run `vagrant provision` or use the `--provision`\n==> one: flag to force provisioning. Provisioners marked to run always will still run.',
    '1557413967,one,action,up,end',    
]);

Fixtures::add('up.machine-id.failure', []);

Fixtures::add('up.machine-name.success', []);

Fixtures::add('up.machine-name.failure', []);

// Should be no difference
Fixtures::add('up.destroy.success', Fixtures::get('up.default.success'));

Fixtures::add('up.destroy.failure', []);

// @TODO: Customise
Fixtures::add('up.install.success', Fixtures::get('up.default.success'));

Fixtures::add('up.install.failure', []);

Fixtures::add('up.force-provision.success', Fixtures::get('up.default.success'));

Fixtures::add('up.force-provision.failure', []);

// @TODO: Really needs customising
Fixtures::add('up.bedlam.success', Fixtures::get('up.default.success'));

Fixtures::add('up.bedlam.failure', []);