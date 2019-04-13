<?php

namespace GregJPreece\Phing\Vagrant\Task;

/**
 * Wrapper for Vagrant's "halt" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantHaltTask extends VagrantTask {

    public function main() {
        $this->runCommand('halt');
    }

    public function init() {
        parent::init();
    }
    
}
