<?php

namespace GregJPreece\Phing\Vagrant;

/**
 * Wrapper for Vagrant's "up" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantUpTask extends VagrantTask {

    public function init(): void {
        
    }
    
    public function main(): void {
        $this->runCommand('up');
    }
    
}
