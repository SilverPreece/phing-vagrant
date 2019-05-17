<?php

use Codeception\Util\Fixtures;

Fixtures::add('destroy.default.success', [
    '1558105089,one,metadata,provider,virtualbox',
    '1558105090,two,metadata,provider,virtualbox',
    '1558105090,two,action,destroy,start',
    '1558105091,two,ui,info,==> two: Forcing shutdown of VM...',
    '1558105092,two,ui,info,==> two: Destroying VM and associated drives...',
    '1558105092,two,action,destroy,end',
    '1558105092,one,action,destroy,start',
    '1558105093,one,ui,info,==> one: Forcing shutdown of VM...',
    '1558105095,one,ui,info,==> one: Destroying VM and associated drives...',
    '1558105095,one,action,destroy,end'
]);

// @TODO: Figure out how to trigger errors and collect failure states
Fixtures::add('destroy.default.failure', []);

Fixtures::add('destroy.machine-id.success', [
    '1558106658,two,metadata,provider,virtualbox',
    '1558106658,two,action,destroy,start',
    '1558106659,two,ui,info,==> two: Forcing shutdown of VM...',
    '1558106661,two,ui,info,==> two: Destroying VM and associated drives...',
    '1558106661,two,action,destroy,end'
]);

Fixtures::add('destroy.machine-id.failure', []);

Fixtures::add('destroy.machine-name.success', [
    '1558106583,one,metadata,provider,virtualbox',
    '1558106583,one,action,destroy,start',
    '1558106584,one,ui,info,==> one: Forcing shutdown of VM...',
    '1558106585,one,ui,info,==> one: Destroying VM and associated drives...',
    '1558106586,one,action,destroy,end'
]);

Fixtures::add('destroy.machine-name.failure', []);

Fixtures::add('destroy.parallel.success', Fixtures::get('destroy.default.success'));

Fixtures::add('destroy.parallel.failure', []);