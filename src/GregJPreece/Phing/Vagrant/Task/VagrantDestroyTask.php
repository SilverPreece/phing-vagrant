<?php

namespace GregJPreece\Phing\Vagrant\Task;

use GregJPreece\Phing\Vagrant\Traits\AcceptsMachineIdentifier;

/**
 * Wrapper for Vagrant's "destroy" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantDestroyTask extends AbstractVagrantTask {

    use AcceptsMachineIdentifier;
    
    public function main() {
        $machine = $this->getMachineIdentifier();
        $this->runCommand('destroy ' . $machine . ' --force');
    }

}
