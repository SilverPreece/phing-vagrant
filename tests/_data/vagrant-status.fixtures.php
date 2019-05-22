<?php

use Codeception\Util\Fixtures;

Fixtures::add('plugin-list', [
    '1558455471,,ui,info,vagrant-hostmanager (1.8.9%!(VAGRANT_COMMA) global)',
    '1558455471,,plugin-name,vagrant-hostmanager',
    '1558455471,vagrant-hostmanager,plugin-version,1.8.9%!(VAGRANT_COMMA) global',
    '1558455471,,ui,info,vagrant-reload (0.0.1%!(VAGRANT_COMMA) global)',
    '1558455471,,plugin-name,vagrant-reload',
    '1558455471,vagrant-reload,plugin-version,0.0.1%!(VAGRANT_COMMA) global',
    '1558455471,,ui,info,vagrant-remove-old-box-versions (1.2.0%!(VAGRANT_COMMA) global)',
    '1558455471,,plugin-name,vagrant-remove-old-box-versions',
    '1558455471,vagrant-remove-old-box-versions,plugin-version,1.2.0%!(VAGRANT_COMMA) global',
    '1558455471,,ui,info,vagrant-vbguest (0.15.1%!(VAGRANT_COMMA) local)',
    '1558455471,,plugin-name,vagrant-vbguest',
    '1558455471,vagrant-vbguest,plugin-version,0.15.1%!(VAGRANT_COMMA) local'
]);

Fixtures::add('status.not-created', [
    '1558142096,one,metadata,provider,virtualbox',
    '1558142097,two,metadata,provider,virtualbox',
    '1558142097,one,provider-name,virtualbox',
    '1558142097,one,state,not_created',
    '1558142097,one,state-human-short,not created',
    '1558142097,one,state-human-long,The environment has not yet been created. Run `vagrant up` to\ncreate the environment. If a machine is not created%!(VAGRANT_COMMA) only the\ndefault provider will be shown. So if a provider is not listed%!(VAGRANT_COMMA)\nthen the machine is not created for that environment.',
    '1558142097,two,provider-name,virtualbox',
    '1558142097,two,state,not_created',
    '1558142097,two,state-human-short,not created',
    '1558142097,two,state-human-long,The environment has not yet been created. Run `vagrant up` to\ncreate the environment. If a machine is not created%!(VAGRANT_COMMA) only the\ndefault provider will be shown. So if a provider is not listed%!(VAGRANT_COMMA)\nthen the machine is not created for that environment.',
    '1558142097,,ui,info,Current machine states:\n\none                       not created (virtualbox)\ntwo                       not created (virtualbox)\n\nThis environment represents multiple VMs. The VMs are all listed\nabove with their current state. For more information about a specific\nVM%!(VAGRANT_COMMA) run `vagrant status NAME`.'
]);

Fixtures::add('status.running', [
    '1558142346,one,metadata,provider,virtualbox',
    '1558142346,two,metadata,provider,virtualbox',
    '1558142346,one,provider-name,virtualbox',
    '1558142346,one,state,running',
    '1558142346,one,state-human-short,running',
    '1558142346,one,state-human-long,The VM is running. To stop this VM%!(VAGRANT_COMMA) you can run `vagrant halt` to\nshut it down forcefully%!(VAGRANT_COMMA) or you can run `vagrant suspend` to simply\nsuspend the virtual machine. In either case%!(VAGRANT_COMMA) to restart it again%!(VAGRANT_COMMA)\nsimply run `vagrant up`.',
    '1558142347,two,provider-name,virtualbox',
    '1558142347,two,state,running',
    '1558142347,two,state-human-short,running',
    '1558142347,two,state-human-long,The VM is running. To stop this VM%!(VAGRANT_COMMA) you can run `vagrant halt` to\nshut it down forcefully%!(VAGRANT_COMMA) or you can run `vagrant suspend` to simply\nsuspend the virtual machine. In either case%!(VAGRANT_COMMA) to restart it again%!(VAGRANT_COMMA)\nsimply run `vagrant up`.',
    '1558142347,,ui,info,Current machine states:\n\none                       running (virtualbox)\ntwo                       running (virtualbox)\n\nThis environment represents multiple VMs. The VMs are all listed\nabove with their current state. For more information about a specific\nVM%!(VAGRANT_COMMA) run `vagrant status NAME`.'
]);

Fixtures::add('status.saved', [
    '1558142438,one,metadata,provider,virtualbox',
    '1558142438,two,metadata,provider,virtualbox',
    '1558142438,one,provider-name,virtualbox',
    '1558142438,one,state,saved',
    '1558142438,one,state-human-short,saved',
    '1558142438,one,state-human-long,To resume this VM%!(VAGRANT_COMMA) simply run `vagrant up`.',
    '1558142439,two,provider-name,virtualbox',
    '1558142439,two,state,saved',
    '1558142439,two,state-human-short,saved',
    '1558142439,two,state-human-long,To resume this VM%!(VAGRANT_COMMA) simply run `vagrant up`.',
    '1558142439,,ui,info,Current machine states:\n\none                       saved (virtualbox)\ntwo                       saved (virtualbox)\n\nThis environment represents multiple VMs. The VMs are all listed\nabove with their current state. For more information about a specific\nVM%!(VAGRANT_COMMA) run `vagrant status NAME`.'
]);

Fixtures::add('status.powered-off', [
    '1558217948,one,metadata,provider,virtualbox',
    '1558217949,two,metadata,provider,virtualbox',
    '1558217949,one,provider-name,virtualbox',
    '1558217949,one,state,poweroff',
    '1558217949,one,state-human-short,poweroff',
    '1558217949,one,state-human-long,The VM is powered off. To restart the VM%!(VAGRANT_COMMA) simply run `vagrant up`',
    '1558217949,two,provider-name,virtualbox',
    '1558217949,two,state,poweroff',
    '1558217949,two,state-human-short,poweroff',
    '1558217949,two,state-human-long,The VM is powered off. To restart the VM%!(VAGRANT_COMMA) simply run `vagrant up`',
    '1558217949,,ui,info,Current machine states:\n\none                       poweroff (virtualbox)\ntwo                       poweroff (virtualbox)\n\nThis environment represents multiple VMs. The VMs are all listed\nabove with their current state. For more information about a specific\nVM%!(VAGRANT_COMMA) run `vagrant status NAME`.'
]);

Fixtures::add('version.current', [
    '1558218565,,ui,output,Installed Version: 2.2.4',
    '1558218565,,version-installed,2.2.4',
    '1558218565,,ui,output,Latest Version: 2.2.4',
    '1558218565,,version-latest,2.2.4',
    '1558218565,,ui,success, \nYou\'re running an up-to-date version of Vagrant!'
]);

Fixtures::add('version.current.expected', '2.2.4');

Fixtures::add('version.old', [
    '1558218565,,ui,output,Installed Version: 1.8.2',
    '1558218565,,version-installed,1.8.2',
    '1558218565,,ui,output,Latest Version: 2.2.4',
    '1558218565,,version-latest,2.2.4',
]);

Fixtures::add('version.old.expected', '1.8.2');
