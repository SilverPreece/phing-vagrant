<?php

namespace GregJPreece\Phing\Vagrant\Task;

use GregJPreece\Phing\Vagrant\Traits\AcceptsMachineIdentifier;
use GregJPreece\Phing\Vagrant\Traits\CanForceProvisioning;

/**
 * Wrapper for Vagrant's "reload" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantReloadTask extends AbstractVagrantTask {

    use AcceptsMachineIdentifier;
    use CanForceProvisioning;

    protected $provisioners = [];

    /**
     * Called by Phing to run the task
     * @return void
     * @throws BuildException
     */
    public function main() {
        $machine = $this->getMachineIdentifier();
        $machine = (!empty($machine)) ? ' ' . $machine : $machine;
        $flags = [];

        if ($this->hasProvisioningOption()) {
            $flags[] = $this->getProvisioningFlag();
        }

        if ($this->hasProvisioners()) {
            $flags[] = '--provision-with ' . implode(',', $this->getProvisioners());
        }

        $flagSpacer = ((count($flags)) ? ' ' : '');
        $command = 'reload' . $machine . $flagSpacer . implode(' ', $flags);
        $this->runCommand($command);
    }

    public function setProvisioners($provisioners): void {
        $this->provisioners = explode(',', $provisioners);
    }

    public function getProvisioners(): array {
        return $this->provisioners;
    }

    public function hasProvisioners(): bool {
        return count($this->provisioners) > 0;
    }

}
