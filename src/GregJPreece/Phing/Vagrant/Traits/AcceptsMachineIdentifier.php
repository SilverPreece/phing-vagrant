<?php

namespace GregJPreece\Phing\Vagrant\Traits;

/**
 * Numerous tasks accept machine name or ID.
 * This trait contains the boilerplate needed
 * to accept either of those parameters as task attributes.
 * @author Greg J Preece <greg@preece.ca>
 */
trait AcceptsMachineIdentifier {
    
    /**
     * Vagrant ID of the machine to start
     * @var string
     */
    private $machineId;
    
    /**
     * Name of the Vagrant machine to start
     * @var string
     */
    private $machineName;
    
    /**
     * Gets the ID or name that should be used to 
     * specify the target Vagrant machine when running
     * a command. (Or null if one was not specified.)
     * @return string|null
     */
    protected function getMachineIdentifier(): ?string {
        $machine = null;
        
        // ID trumps name
        if ($this->getMachineId() != '') {
            $machine = $this->getMachineId();
        } else if ($this->getMachineName() != '') {
            $machine = $this->getMachineName();
        }

        return $machine;
    }
    
    /**
     * Returns the Vagrant ID of the machine to start
     * @return string|null
     */
    public function getMachineId(): ?string {
        return $this->machineId;
    }

    /**
     * Returns the name of the Vagrant machine to start
     * @return string|null
     */
    public function getMachineName(): ?string {
        return $this->machineName;
    }

    /**
     * Sets the Vagrant ID of the machine to start
     * @param string $machineId Vagrant machine ID
     * @return void
     */
    public function setMachineId(string $machineId): void {
        $this->machineId = $machineId;
    }
    
    /**
     * Sets the name of the Vagrant machine to start
     * @param string $machineName Vagrant machine name
     * @return void
     */
    public function setMachineName(string $machineName): void {
        $this->machineName = $machineName;
    }    
    
}