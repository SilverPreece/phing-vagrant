<?php

use Codeception\Util\Fixtures;

Fixtures::add('parser.single.vagrant', '1558142346,one,state,running');

Fixtures::add('parser.single.non-vagrant', 'drwxr-xr-x 5 vagrant vagrant 4096 Jul 23 01:25');

Fixtures::add('parser.single.comma-cleaning', '1558455471,vagrant-hostmanager,plugin-version,1.8.9%!(VAGRANT_COMMA) global');

Fixtures::add('parser.array.vagrant-success', [
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

Fixtures::add('parser.array.vagrant-failure', [
    '1563998212,one,metadata,provider,virtualbox',
    '1563998212,two,metadata,provider,virtualbox',
    '1563998212,,ui,error,This command requires a specific VM name to target in a multi-VM environment.',
    '1563998212,,error-exit,Vagrant::Errors::MultiVMTargetRequired,This command requires a specific VM name to target in a multi-VM environment.'
]);

Fixtures::add('parser.array.mixed-success', [
    '1564071110,one,metadata,provider,virtualbox',
    '1564071110,one,action,ssh_run,start',
    'total 36',
    'drwxr-xr-x 5 vagrant vagrant 4096 Jul 23 01:25 .',
    'drwxr-xr-x 4 root    root    4096 Jul 22 15:14 ..',
    '-rw------- 1 vagrant vagrant    5 Jul 23 01:25 .bash_history',
    '-rw-r--r-- 1 vagrant vagrant  220 Jun 12 12:35 .bash_logout',
    '-rw-r--r-- 1 vagrant vagrant 3771 Jun 12 12:35 .bashrc',
    'drwx------ 2 vagrant vagrant 4096 Jul 22 15:14 .cache',
    'drwx------ 3 vagrant vagrant 4096 Jul 22 15:14 .gnupg',
    '-rw-r--r-- 1 vagrant vagrant  807 Jun 12 12:35 .profile',
    'drwx------ 2 vagrant vagrant 4096 Jul 22 15:14 .ssh',
    'Connection to 127.0.0.1 closed.',
    '1564071112,one,action,ssh_run,end'
]);

// Time for some cheating!
Fixtures::add('parser.raw.vagrant-success', 
        implode("\n", Fixtures::get('parser.array.vagrant-success')));

Fixtures::add('parser.raw.vagrant-failure',
        implode("\n", Fixtures::get('parser.array.vagrant-failure')));

Fixtures::add('parser.raw.mixed-success',
        implode("\n", Fixtures::get('parser.array.mixed-success')));
