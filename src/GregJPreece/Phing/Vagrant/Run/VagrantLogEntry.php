<?php

namespace GregJPreece\Phing\Vagrant\Run;

/**
 * Represents a single entry in the Vagrant machine log
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantLogEntry {

    /**
     * Unix timestamp at which the log event occurred
     * @var int
     */
    private $timestamp;
    
    /**
     * Target machine for the log event (usually "default")
     * @var string
     */
    private $target;
    
    /**
     * Type of log message
     * @var VagrantLogType
     */
    private $type;
    
    /**
     * Any other additional data supplied as part of the log
     * @var string[]
     */
    private $data;
    
    /**
     * Creates an object representing one line of the Vagrant logs
     * @param int $timestamp Unix timestamp at which the log event occurred
     * @param string $target Target machine for the log event
     * @param \GregJPreece\Phing\Vagrant\Run\VagrantLogType $type Type of message
     * @param array $data Any other additional data payload supplied
     */
    public function __construct(int $timestamp, string $target, 
            VagrantLogType $type, array $data) {
        $this->timestamp = $timestamp;
        $this->target = $target;
        $this->type = $type;
        $this->data = $data;
    }
    
    /**
     * Gets Unix timestamp at which the log event occurred
     * @return int
     */
    public function getTimestamp(): int {
        return $this->timestamp;
    }

    /**
     * Gets target machine for the log event (usually "default")
     * @return string
     */
    public function getTarget(): string {
        return $this->target;
    }

    /**
     * Gets the type of the log message
     * @return \GregJPreece\Phing\Vagrant\Run\VagrantLogType
     */
    public function getType(): VagrantLogType {
        return $this->type;
    }

    /**
     * Gets any additional data supplied as part of the log
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }

    /**
     * Sets Unix timestamp at which the log event occurred
     * @param int $timestamp Unix timestamp
     * @return void
     */
    public function setTimestamp(int $timestamp): void {
        $this->timestamp = $timestamp;
    }

    /**
     * Sets target machine for the log event (usually "default")
     * @param string $target Target machine
     * @return void
     */
    public function setTarget(string $target): void {
        $this->target = $target;
    }

    /**
     * Sets the type of the log message
     * @param \GregJPreece\Phing\Vagrant\Run\VagrantLogType $type Message type
     * @return void
     */
    public function setType(VagrantLogType $type): void {
        $this->type = $type;
    }

    /**
     * Sets any additional data supplied as part of the log
     * @param array $data Additional data payload
     * @return void
     */
    public function setData(array $data): void {
        $this->data = $data;
    }

}
