<?php

namespace GregJPreece\Phing\Vagrant\Task;

use GregJPreece\Phing\Vagrant\Traits\AcceptsMachineIdentifier;

/**
 * Wrapper for Vagrant's "halt" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantHaltTask extends VagrantTask {

    use AcceptsMachineIdentifier;
    
    public function main() {
        $machine = $this->getMachineIdentifier();
        $this->runCommand('halt ' . $machine);
    }
    
}
