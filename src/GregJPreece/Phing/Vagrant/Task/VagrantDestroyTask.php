<?php

namespace GregJPreece\Phing\Vagrant\Task;

use GregJPreece\Phing\Vagrant\Traits\AcceptsMachineIdentifier;

/**
 * Wrapper for Vagrant's "destroy" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantDestroyTask extends AbstractVagrantTask {

    use AcceptsMachineIdentifier;
    
    /**
     * @var bool
     */
    protected $parallel = null;
    
    /**
     * Called by Phing to run the task
     * @return void
     * @throws BuildException
     */    
    public function main() {
        $machine = $this->getMachineIdentifier();
        $machine = (!empty($machine)) ? ' ' . $machine : $machine;
        $flags = [];
        
        if ($this->hasParallel()) {
            $flags[] = ($this->getParallel())
                    ? '--parallel'
                    : '--no-parallel';
        }
        
        $flagSpacer = ((count($flags)) ? ' ' : '');
        $command = 'destroy' . $machine . ' --force' . $flagSpacer . implode(' ', $flags);
        $this->runCommand($command);
    }
    
    /**
     * Returns whether to destroy the available machines in parallel
     * NB: If your chosen provider does not support parallel
     * operations, this will have no effect
     * @return bool|null If null, no option was specified
     */
    public function getParallel(): ?bool {
        return $this->parallel;
    }

    /**
     * Sets whether to destroy the available machines in parallel
     * @param bool $parallel Destroy in parallel?
     * @return void
     */
    public function setParallel(bool $parallel): void {
        $this->parallel = $parallel;
    }
    
    /**
     * Returns whether any option was specified regarding parallelism
     * @return bool Whether option exists, NOT value of option
     */
    public function hasParallel(): bool {
        return $this->parallel !== null;
    }

}
