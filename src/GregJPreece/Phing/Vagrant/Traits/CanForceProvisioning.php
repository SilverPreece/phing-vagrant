<?php

namespace GregJPreece\Phing\Vagrant\Traits;

/**
 * Numerous tasks can force or prevent provisioning.
 * This trait contains the boilerplate needed
 * to accept true/false force-provisioning flags.
 * @author Greg J Preece <greg@preece.ca>
 */
trait CanForceProvisioning {
    
    /**
     * Forces or prevents the running of provisioners on start
     * @var boolean
     */
    private $provision;
    
    /**
     * Returns whether a provisioning option has been set
     * @return boolean
     */
    protected function hasProvisioningOption(): bool {
        return ($this->getProvision() !== null);
    }
    
    /**
     * Returns the flag that should be appended to a command, 
     * based on the current provisioning setting for the task
     * @return string|null
     */
    protected function getProvisioningFlag(): ?string {
        if ($this->hasProvisioningOption()) {
            return $this->getProvision()
                        ? '--provision'
                        : '--no-provision';
        } else {
            return null;
        }           
    }
    
    /**
     * Returns whether or not to run provisioners
     * @return bool|null
     */
    public function getProvision(): ?bool {
        return $this->provision;
    }
    
    /**
     * If true, provisioners are forced to run. If false, they are forced to
     * not run. By default, it does neither.
     * @param bool $provision Whether to run provisioners
     * @return void
     */
    public function setProvision(bool $provision): void {
        // The way Phing converts true/false strings to booleans is b0rked
        $this->provision = !!$provision;
    }
    
}
