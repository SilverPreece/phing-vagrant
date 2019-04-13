<?php

namespace GregJPreece\Phing\Vagrant\Task;

/**
 * Wrapper for Vagrant's "destroy" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantDestroyTask extends VagrantTask {

    public function main() {
        $this->runCommand('destroy --force');
    }

    public function init() {
        parent::init();
    }
   
}
