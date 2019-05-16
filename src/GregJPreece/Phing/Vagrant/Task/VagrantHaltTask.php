<?php

namespace GregJPreece\Phing\Vagrant\Task;

use GregJPreece\Phing\Vagrant\Traits\AcceptsMachineIdentifier;

/**
 * Wrapper for Vagrant's "halt" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantHaltTask extends AbstractVagrantTask {

    use AcceptsMachineIdentifier;

    /**
     * Whether to force shutdown of the VM
     * @var bool
     */
    protected $force;

    /**
     * Called by Phing to run the task
     * @return void
     * @throws BuildException
     */
    public function main() {
        $machine = $this->getMachineIdentifier();
        $machine = (!empty($machine)) ? ' ' . $machine : $machine;
        $flags = [];

        if ($this->getForce()) {
            $flags[] = '--force';
        }

        $flagSpacer = ((count($flags)) ? ' ' : '');

        $command = 'halt' . $machine . $flagSpacer . implode(' ', $flags);
        $this->runCommand($command);
    }

    /**
     * Returns whether the task will force shutdown
     * of the virtual machine without waiting for the
     * OS to do it first.
     * @return bool|null
     */
    public function getForce(): ?bool {
        return $this->force;
    }

    /**
     * Sets whether the task should force shutdown
     * of the virtual machine without waiting for the
     * OS to do it first.
     * @param bool $force
     * @return void
     */
    public function setForce(bool $force): void {
        $this->force = $force;
    }

}
