<?php

use Codeception\Util\Fixtures;

// @TODO: Figure out how to trigger errors and collect failure fixtures
Fixtures::add('halt.default.success', [
    '1557935539,one,metadata,provider,virtualbox',
    '1557935539,two,metadata,provider,virtualbox',
    '1557935539,two,action,halt,start',
    '1557935540,two,ui,output,==> two: Attempting graceful shutdown of VM...',
    '1557935545,two,action,halt,end',
    '1557935545,one,action,halt,start',
    '1557935546,one,ui,output,==> one: Attempting graceful shutdown of VM...',
    '1557935551,one,action,halt,end'
]);

Fixtures::add('halt.default.failure', []);

Fixtures::add('halt.machine-id.success', [
    '1557935883,one,metadata,provider,virtualbox',
    '1557935883,one,action,halt,start',
    '1557935884,one,ui,output,==> one: Attempting graceful shutdown of VM...',
    '1557935889,one,action,halt,end'
]);

Fixtures::add('halt.machine-id.failure', []);

Fixtures::add('halt.machine-name.success', [
    '1557935883,one,metadata,provider,virtualbox',
    '1557935883,one,action,halt,start',
    '1557935884,one,ui,output,==> one: Attempting graceful shutdown of VM...',
    '1557935889,one,action,halt,end'
]);

Fixtures::add('halt.machine-name.failure', []);

Fixtures::add('halt.force.success', [
    '1557935693,one,metadata,provider,virtualbox',
    '1557935693,two,metadata,provider,virtualbox',
    '1557935693,two,action,halt,start',
    '1557935694,two,ui,info,==> two: Forcing shutdown of VM...',
    '1557935696,two,action,halt,end',
    '1557935696,one,action,halt,start',
    '1557935696,one,ui,info,==> one: Forcing shutdown of VM...',
    '1557935698,one,action,halt,end'
]);

Fixtures::add('halt.force.failure', []);
