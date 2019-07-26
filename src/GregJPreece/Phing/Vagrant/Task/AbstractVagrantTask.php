<?php

namespace GregJPreece\Phing\Vagrant\Task;

use GregJPreece\Phing\Vagrant\Run\VagrantOutputParser;
use GregJPreece\Phing\Vagrant\Run\VagrantLogEntry;
use GregJPreece\Phing\Vagrant\Run\VagrantResponse;
use GregJPreece\Phing\Vagrant\Data\VagrantLogType;
use BuildException;

/**
 * Base task class from which other tasks derive
 * @author Greg J Preece <greg@preece.ca>
 */
abstract class AbstractVagrantTask extends \Task {

    /**
     * Whether to output full logging or filtered logging
     * @var bool
     */
    protected $verbose = false;
    
    /**
     * Whether to run silently (no output) - overrides verbosity
     * @var bool
     */
    protected $silent = false;
    
    /**
     * System path to the Vagrant executable
     * @var string
     */
    protected $vagrantPath;
    
    /**
     * Passes a command through to Vagrant and parses the response
     * @param string $command Command to run
     * @param bool $verbose If false, only important messages are returned
     * @return VagrantLogEntry[] Parsed result lines
     * @throws BuildException
     */
    protected function runCommand(string $command): array {
        $response = [];
        $command = $this->getPathedVagrantExecutable() . ' ' . $command . ' --machine-readable';
        
        // TODO: Test this on Windows and macOS
        exec($command, $response, $resCode);
        
        $parsedResponse = VagrantOutputParser::parseLineArray($response);
        
        if (! $this->getSilent()) {
            $this->outputLogsToConsole($parsedResponse);
        }

        $foundError = array_reduce($parsedResponse->getVagrantLogs(), 
            function($carry, $item) {
                if ($item->getType() == VagrantLogType::ERROR_EXIT) {
                    $carry = $item;
                }
                return $carry;
            }
        );
        
        if ($resCode != 0) {
            $this->raiseVagrantError($foundError);
        }
        
        return $parsedResponse->getVagrantLogs();
    }
    
    /**
     * Determines the path to the Vagrant executable, gives appropriate command.
     * Paths set directly on the task take precedence, then paths set as project
     * properties in Phing. If neither is set, the extension assumes Vagrant
     * is already on the path.
     * @return string
     */
    protected function getPathedVagrantExecutable(): string {
        $pathProperty = $this->getProject()->getProperty('vagrant.path');
        
        if ($this->hasVagrantPath()) {
            return $this->getVagrantPath();
        } else if (!empty($pathProperty)) {
            return $pathProperty;
        } else {
            return 'vagrant';
        }
    }
    
    protected function raiseVagrantError(?VagrantLogEntry $logEntry): void {
        // Special case blah-blah
        // If the Vagrantfile is not parsed properly, the Vagrant
        // environment cannot properly initialise, and it will output a
        // hard-coded string to stderr instead of a machine-readable one.
        // @todo Talk to the Vagrant team about having a machine-readable option for this
        if (empty($logEntry)) {
            throw new BuildException("Vagrant failed to initialize before a command \n"
                    . "could be run. This could be due to a syntax error in your \n"
                    . "Vagrantfile. Please check that your Vagrantfile is valid \n"
                    . "and that all necessary dependencies are installed.");
        } else {
            throw new BuildException('Vagrant returned a runtime error of type: ' .
                    $logEntry->getError() . ".\n\n" . 
                    implode("\n", $logEntry->getData()));
        }
    }
    
    /**
     * Outputs response logs to the console
     * @param VagrantResponse $response Response from Vagrant
     * @return void
     */
    protected function outputLogsToConsole(VagrantResponse $response): void {
        if (! $this->getVerbose()) {
            $logEntries = array_filter($response->getVagrantLogs(), 
                function(VagrantLogEntry $logLine) {
                    return in_array($logLine->getType(), [
                        VagrantLogType::ACTION,
                        VagrantLogType::BOX_NAME,
                        VagrantLogType::BOX_PROVIDER,
                        VagrantLogType::ERROR_EXIT,
                        VagrantLogType::STATE_HUMAN_LONG
                    ]);
                }
            );
        }
        
        foreach ($logEntries as $logEntry) {
            // TODO: Switch me to use $this->log
            echo $this->formatLogLine($logEntry) . "\n";
        }
        
        if ($this->getVerbose()) {
            foreach ($response->getOtherLogs() as $rawLogLine) {
                // TODO: Switch me to use $this->log
                echo $rawLogLine;
            }
        }
    }
    
    /**
     * Gets a Vagrant-scoped property.
     * @return string
     */
    protected function getNamespacedProperty(string $propertyName): ?string {
        return $this->project->getProperty('vagrant.' . $propertyName);
    }
    
    /**
     * Sets a Vagrant-scoped project property - use this to 
     * ensure all properties generated by the Vagrant tasks 
     * are namespaced together
     * @todo Make the prefix configurable
     * @param string $name Property to set
     * @param string $value New property value
     * @return void
     */
    protected function setNamespacedProperty(string $name, string $value): void {
        $this->project->setProperty('vagrant.' . $name, $value);
    }
    
    /**
     * Formats a parsed Vagrant log entry into something nicer for output
     * @param VagrantLogEntry $logEntry Log entry to format
     * @return string Formatted log entry
     */
    protected function formatLogLine(VagrantLogEntry $logEntry): string {
        $formattedTime = '[' . date('Y-m-d H:i:s', $logEntry->getTimestamp()) . ']';
        $formattedTarget = '[' . strtoupper($logEntry->getTarget()) . ']';
        $formattedType = '[' . strtoupper($logEntry->getType()) . ']';
        return $formattedTime . $formattedTarget . $formattedType . ' ' . implode(', ', $logEntry->getData());
    }
    
    /**
     * Returns whether to show verbose logging
     * @return bool
     */
    public function getVerbose(): bool {
        return $this->verbose;
    }

    /**
     * Sets whether to show verbose logging
     * @return bool
     */
    public function setVerbose(bool $verbose): void {
        $this->verbose = $verbose;
    }
    
    /**
     * Returns whether logging output is turned off (overrides verbosity)
     * @return bool
     */
    public function getSilent(): bool {
        return $this->silent;
    }

    /**
     * Sets whether to run silently (no output) - overrides verbosity
     * @param bool $silent
     * @return void
     */
    public function setSilent(bool $silent): void {
        $this->silent = $silent;
    }
    
    /**
     * Returns whether a custom Vagrant path has been set on the task
     * @return bool
     */
    public function hasVagrantPath(): bool {
        return $this->vagrantPath !== null;
    }
    
    /**
     * Returns the path to the Vagrant executable
     * (if set as a task attribute)
     * @return string
     */
    public function getVagrantPath(): ?string {
        return $this->vagrantPath;
    }

    /**
     * Sets the path to the Vagrant executable
     * @param string $vagrantPath
     * @return void
     */
    public function setVagrantPath(string $vagrantPath): void {
        $this->vagrantPath = $vagrantPath;
    }
    
}
