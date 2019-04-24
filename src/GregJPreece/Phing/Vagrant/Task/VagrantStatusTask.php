<?php

namespace GregJPreece\Phing\Vagrant\Task;

/**
 * Reads in details of the Vagrant installation and
 * current project, and sets useful project properties
 * that can be used by other tasks.
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantStatusTask extends VagrantTask {

    public function main() {
        $versionOutput = $this->runCommand('version');
        $vagrantVersion = array_reduce($versionOutput, function($carry, $item) {
            $matches = [];
            $versionFound = preg_match('/Installed Version:?\s(\d\.\d\.\d)/', $item, $matches);
            if ($versionFound) {
                $carry = $matches[1];
            }
            return $carry;
        });
        
        if (! empty($vagrantVersion)) {
          $this->project->setNewProperty('vagrant.version', $vagrantVersion);          
        }
    }
    
}