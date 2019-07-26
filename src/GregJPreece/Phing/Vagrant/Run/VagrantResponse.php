<?php

namespace GregJPreece\Phing\Vagrant\Run;

use GregJPreece\Phing\Vagrant\Run\VagrantLogEntry;

/**
 * Container for the response gathered after running a Vagrant command.
 * Contains parsed log entries from Vagrant's machine-readable mode,
 * along with any other raw logs returned not directly from Vagrant - for
 * example, the output of commands run on a VM's Bash shell
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantResponse {
    
    /**
     * Logs passed back by Vagrant, up-lifted into usable objects
     * @var VagrantLogEntry[]
     */
    private $vagrantLogs = [];
    
    /**
     * Raw logs passed back by a non-Vagrant process, such as Bash
     * @var string[]
     */
    private $otherLogs = [];
    
    /**
     * Fetches all log messages that came directly from Vagrant
     * @return VagrantLogEntry[]
     */
    public function getVagrantLogs(): array {
        return $this->vagrantLogs;
    }

    /**
     * Fetches all log messages that arose from somewhere other than Vagrant.
     * These may be, for example, messages outputted to shell as part of a
     * task run.
     * @return string[]
     */
    public function getOtherLogs(): array {
        return $this->otherLogs;
    }

    /**
     * Populates the set of logs returned directly from Vagrant
     * for a given command
     * @param VagrantLogEntry[] $vagrantLogs
     * @return void
     */
    public function setVagrantLogs(array $vagrantLogs): void {
        $this->vagrantLogs = $vagrantLogs;
    }

    /**
     * Populates the set of logs returned from somewhere other than
     * Vagrant during the run of a given command
     * @param string[] $otherLogs
     * @return void
     */
    public function setOtherLogs(array $otherLogs): void {
        $this->otherLogs = $otherLogs;
    }
    
    /**
     * Returns whether the command response contains any log messages from Vagrant
     * @return bool
     */
    public function hasVagrantLogs(): bool {
        return is_array($this->vagrantLogs) && count($this->vagrantLogs) > 0;
    }
    
    /**
     * Returns whether the command response contains any log messages 
     * from somewhere other than Vagrant
     * @return bool
     */
    public function hasOtherLogs(): bool {
        return is_array($this->otherLogs) && count($this->otherLogs) > 0;
    }

    /**
     * Adds a log message from Vagrant to the command response container
     * @param VagrantLogEntry $logEntry Vagrant log message
     * @return void
     */
    public function addVagrantLogEntry(VagrantLogEntry $logEntry): void {
        $this->vagrantLogs[] = $logEntry;
    }
    
    /**
     * Adds a raw non-Vagrant log message to the command response container
     * @param string $logEntry Non-Vagrant log message
     * @return void
     */
    public function addRawLogEntry(string $logEntry): void {
        $this->otherLogs[] = $logEntry;
    }
    
}
