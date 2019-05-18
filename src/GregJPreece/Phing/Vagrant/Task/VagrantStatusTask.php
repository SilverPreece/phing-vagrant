<?php

namespace GregJPreece\Phing\Vagrant\Task;

use GregJPreece\Phing\Vagrant\Run\VagrantLogEntry;
use GregJPreece\Phing\Vagrant\Run\VagrantLogType;

/**
 * Reads in details of the Vagrant installation and
 * current project, and sets useful project properties
 * that can be used by other tasks.
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantStatusTask extends AbstractVagrantTask {

    /**
     * Called by Phing to run the task
     */
    public function main() {
        $this->loadInstalledVersion();
        $this->loadProjectStatus();
    }

    /**
     * Loads information about the current project's
     * virtual machines and their state into Phing properties
     * @return void
     */
    protected function loadProjectStatus(): void {
        $statusOutput = $this->runCommand('status');

        foreach ($statusOutput as $logEntry) {
            $machineName = $logEntry->getTarget();

            if ($logEntry->getType()->equals(VagrantLogType::PROVIDER_NAME())) {
                $this->setNamespacedProperty($machineName . '.provider', $logEntry->getData()[0]);
            } else if ($logEntry->getType()->equals(VagrantLogType::STATE())) {
                $this->setNamespacedProperty($machineName . '.state', $logEntry->getData()[0]);
            }
        }
    }

    /**
     * Loads the currently installed Vagrant version into a Phing property
     * @return void
     */
    protected function loadInstalledVersion(): void {
        $versionOutput = $this->runCommand('version');
        $vagrantVersion = array_reduce($versionOutput, function($carry, VagrantLogEntry $item) {
            $matches = [];

            if ($item->getType() == VagrantLogType::VERSION_INSTALLED) {
                $carry = $item->getData()[0];
            }

            return $carry;
        });

        if (!empty($vagrantVersion)) {
            $this->setNamespacedProperty('version', $vagrantVersion);
        }
    }

}
