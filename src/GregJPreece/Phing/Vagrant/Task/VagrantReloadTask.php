<?php

namespace GregJPreece\Phing\Vagrant\Task;

/**
 * Wrapper for Vagrant's "reload" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantReloadTask extends VagrantTask {

    public function main() {
        $this->runCommand('reload');
    }
    
}
