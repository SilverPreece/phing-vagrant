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

    /**
     * Sets the provisioners that should be run on reload
     * @param string $provisioners Comma separated list
     * @return void
     */
    public function setProvisioners($provisioners): void {
        $this->provisioners = explode(',', $provisioners);
    }

    /**
     * Returns the provisioners that should be run on reload
     * @return array Array of provisioner names
     */
    public function getProvisioners(): array {
        return $this->provisioners;
    }

    /**
     * Returns whether any provisioners have been specified
     * to run during the reload action
     * @return bool Whether provisioners exist
     */
    public function hasProvisioners(): bool {
        return count($this->provisioners) > 0;
    }

}
