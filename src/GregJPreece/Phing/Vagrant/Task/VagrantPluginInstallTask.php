<?php

namespace GregJPreece\Phing\Vagrant\Task;

use GregJPreece\Phing\Vagrant\Task\AbstractVagrantTask;

/**
 * Installs the specified Vagrant plugin
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantPluginInstallTask extends AbstractVagrantTask {
    
    /**
     * The name of the plugin to install
     * @var string
     */
    protected $name;
    
    /**
     * If true, the plugin will be installed only
     * for the current project, rather than the entire host
     * @var bool
     */
    protected $local = false;
    
    /**
     * The exact version of the plugin to install
     * @var string
     */
    protected $version;
    
    /**
     * The minimum version of the plugin to install
     * (If not using exact version. Does not require max version.)
     * @var string
     */
    protected $minVersion;
    
    /**
     * The maximum version of the plugin to install
     * (If not using exact version. Does not require min version.)
     * @var string
     */
    protected $maxVersion;

    /**
     * Called by Phing to run the task
     * @return void
     * @throws BuildException
     */    
    public function main(): void {
        if (! $this->hasName()) {
            throw new \BuildException('No vagrant plugin name was specified to install.');
        }
        
        $flags = [];
        
        if ($this->getLocal()) {
            $flags[] = '--local';
        }
        
        // Vagrant cannot currently accept min and max versions at the same time
        // https://github.com/hashicorp/vagrant/issues/10877
        if ($this->hasVersion()) {
            $flags[] = '--plugin-version ' . $this->getVersion();
        } else if ($this->hasMinVersion()) {
            $flags[] = '--plugin-version ">' . $this->getMinVersion() . '"';
        } else if ($this->hasMaxVersion()) {
            $flags[] = '--plugin-version "<' . $this->getMaxVersion() . '"';
        }
        
        $flagSpacer = ((count($flags)) ? ' ' : '');
        $command = 'plugin install ' . $this->getName() . $flagSpacer . implode(' ', $flags);
        $this->runCommand($command);
    }
    
    /**
     * Returns the name of the plugin to install
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }
    
    /**
     * Returns whether the plugin should be installed
     * locally, rather than globally
     * @return bool
     */
    public function getLocal(): bool {
        return $this->local;
    }

    /**
     * Returns the version of the plugin to be installed
     * @return string|null
     */
    public function getVersion(): ?string {
        return $this->version;
    }

    /**
     * Returns the minimum version of the plugin
     * to be installed
     * @return string|null
     */
    public function getMinVersion(): ?string {
        return $this->minVersion;
    }

    /**
     * Returns the maximum version of the plugin
     * to be installed
     * @return string|null
     */
    public function getMaxVersion(): ?string {
        return $this->maxVersion;
    }

    /**
     * Sets the name of the plugin to install
     * @param string $name Plugin name
     * @return void
     */
    public function setName(string $name): void {
        $this->name = $name;
    }
    
    /**
     * Set whether to install the plugin locally,
     * or for the entire host
     * @param bool $local Set true for local install
     * @return void
     */
    public function setLocal(bool $local): void {
        $this->local = $local;
    }

    /**
     * Sets the version of the plugin to install
     * @param string $version Plugin version
     * @return void
     */
    public function setVersion(string $version): void {
        $this->version = $version;
    }
    
    /**
     * Sets the minimum version of the plugin to install.
     * If a specific version has also been set, this will
     * be ignored.
     * @param string $minVersion Minimum plugin version
     * @return void
     */
    public function setMinVersion(string $minVersion): void {
        $this->minVersion = $minVersion;
    }

    /**
     * Sets the maximum version of the plugin to install.
     * If a specific version has also been set, this will
     * be ignored.
     * @param string $maxVersion Maximum plugin version
     * @return void
     */
    public function setMaxVersion(string $maxVersion): void {
        $this->maxVersion = $maxVersion;
    }
    
    /**
     * Returns whether a name has been set for the plugin to install
     * @return bool
     */
    public function hasName(): bool {
        return $this->name !== null;
    }
    
    /**
     * Returns whether a specific version has been set for the plugin installation
     * @return bool
     */
    public function hasVersion(): bool {
        return $this->version !== null;
    }
    
    /**
     * Returns whether a minimum installation version has been specified
     * @return bool
     */
    public function hasMinVersion(): bool {
        return $this->minVersion !== null;
    }
    
    /**
     * Returns whether a maximum installation version has been specified
     * @return bool
     */
    public function hasMaxVersion(): bool {
        return $this->maxVersion !== null;
    }
    
}
