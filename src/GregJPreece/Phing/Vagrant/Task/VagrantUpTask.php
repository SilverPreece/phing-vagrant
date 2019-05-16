<?php

namespace GregJPreece\Phing\Vagrant\Task;

use GregJPreece\Phing\Vagrant\Traits\AcceptsMachineIdentifier;
use GregJPreece\Phing\Vagrant\Traits\CanForceProvisioning;

/**
 * Wrapper for Vagrant's "up" command
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantUpTask extends AbstractVagrantTask {

    use AcceptsMachineIdentifier;
    use CanForceProvisioning;

    /**
     * Whether to destroy a new machine if a fatal error
     * occurs during provisioning. (Only applies to first "up")
     * @var bool
     */
    protected $destroyOnError = true;

    /**
     * Whether to install the machine's provisioner if it is
     * not already present
     * @var bool
     */
    protected $installProvider = true;

    /**
     * Name of the provider to use when starting the machine,
     * overrides the provider specified in Vagrantfile.
     * @var string
     */
    protected $provider = 'virtualbox';

    /**
     * Called by Phing to run the task
     * @return void
     * @throws BuildException
     */
    public function main(): void {
        $machine = $this->getMachineIdentifier();
        $machine = (!empty($machine)) ? ' ' . $machine : $machine;
        $flags = [];

        if ($this->getDestroyOnError() !== null) {
            $flags[] = ($this->getDestroyOnError()) ? '--destroy-on-error' : '--no-destroy-on-error';
        }

        if ($this->getInstallProvider() !== null) {
            $flags[] = ($this->getInstallProvider()) ? '--install-provider' : '--no-install-provider';
        }

        if ($this->hasProvisioningOption()) {
            $flags[] = $this->getProvisioningFlag();
        }

        if ($this->getProvider() != '') {
            $flags[] = '--provider ' . $this->getProvider();
        }

        $flagSpacer = ((count($flags)) ? ' ' : '');
        $command = 'up' . $machine . $flagSpacer . implode(' ', $flags);
        $this->runCommand($command);
    }

    /**
     * Returns whether to destroy a machine if fatal
     * provisioning errors are encountered
     * @return bool|null
     */
    public function getDestroyOnError(): ?bool {
        return $this->destroyOnError;
    }

    /**
     * Returns whether to install the machine provider
     * if it is not already available
     * @return string|null
     */
    public function getInstallProvider(): ?bool {
        return $this->installProvider;
    }

    /**
     * Returns the provider to use when booting the machine(s)
     * @return string|null
     */
    public function getProvider(): ?string {
        return $this->provider;
    }

    /**
     * Sets whether to destroy VMs on fatal error during their statuses.
     * @param bool $destroyOnError Whether to destroy VMs on error
     * @return void
     */
    public function setDestroyOnError(bool $destroyOnError): void {
        $this->destroyOnError = $destroyOnError;
    }

    /**
     * Sets whether to install the machine's provider
     * if it is not already available
     * @param bool $installProvider
     * @return void
     */
    public function setInstallProvider(bool $installProvider): void {
        $this->installProvider = $installProvider;
    }

    /**
     * Sets the provider that should be used when starting the machine(s)
     * @param string $provider Provider name
     * @return void
     */
    public function setProvider(string $provider): void {
        $this->provider = $provider;
    }

}
