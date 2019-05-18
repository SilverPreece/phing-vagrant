<?php

namespace GregJPreece\Phing\Vagrant\Data;

use MyCLabs\Enum\Enum;

/**
 * States that a Vagrant machine can be in
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantMachineState extends Enum {
    
    /**
     * Initial state, when no VM exists,
     * up has not been run, etc.
     */
    const NOT_CREATED = 'not_created';
    
    /**
     * VM exists but is currently powered off
     */
    const POWERED_OFF = 'poweroff';
    
    /**
     * VM is running
     * NB: This only means that VM is on! Does not
     * mean that it is ready, has finished provisioning, etc
     */
    const RUNNING = 'running';
    
    /**
     * VM was running, and has been suspended to disk.
     * Can be resumed at any time using a "vagrant resume" command.
     */
    const SAVED = 'saved';
    
}
