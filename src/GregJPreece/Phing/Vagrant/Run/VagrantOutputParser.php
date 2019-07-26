<?php

namespace GregJPreece\Phing\Vagrant\Run;

use GregJPreece\Phing\Vagrant\Data\VagrantLogType;
use GregJPreece\Phing\Vagrant\Run\VagrantLogEntry;
use GregJPreece\Phing\Vagrant\Run\VagrantResponse;

/**
 * Parses the output from Vagrant's --machine-readable mode
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantOutputParser {

    /**
     * Parses a raw string set of log lines returned after task execution
     * @param string $logLines Raw logs to parse
     * @return VagrantResponse Parsed log entries
     */
    public static function parseRawLines(string $logLines): VagrantResponse {
        $response = new VagrantResponse();
        $logLines = trim($logLines);
        
        // strtok is more performant than preg_split
        $line = strtok($logLines, "\r\n");
        self::parseSingleLogLine($line, $response);
        
        while ($line !== false) {
            $line = strtok("\r\n");
            if (!empty(trim($line))) {
                self::parseSingleLogLine($line, $response);                
            }
        }
        
        return $response;
    }
    
    /**
     * Parses an array of log lines returned after task execution.
     * @param array $logLines Log lines to parse
     * @return VagrantResponse Parsed log entries
     */
    public static function parseLineArray(array $logLines): VagrantResponse {
        $response = new VagrantResponse();
        
        foreach ($logLines as $logLine) {
            self::parseSingleLogLine($logLine, $response);
        }

        return $response;
    }
    
    /**
     * Parses a single raw log line returned from an executed command.
     * If the log line is from Vagrant, it is uplifted into an object.
     * If it is from the shell, it is left raw and stored in the response container.
     * @param string $logLine Raw line to parse
     * @param VagrantResponse $response If a response container already exists, pass it here for population
     * @return VagrantResponse Populated Vagrant response container
     */
    public static function parseSingleLogLine(string $logLine, 
                            VagrantResponse $response = null): VagrantResponse {
        
        if (empty($response)) {
            $response = new VagrantResponse();
        }
        
        if (self::isValidVagrantLogLine($logLine)) {
            $response->addVagrantLogEntry(self::parseVagrantLogLine($logLine));
        } else if (trim($logLine) != '' || $response->hasOtherLogs()) {
            $response->addRawLogEntry($logLine);
        }            
        
        return $response;
    }
    /**
     * Uplifts a single valid Vagrant log line into a useful object
     * @param string $logLine Log line to parse
     * @return VagrantLogEntry Parsed log entry
     */
    private static function parseVagrantLogLine(string $logLine): VagrantLogEntry {
        $splitLine = explode(',', self::cleanLogMessage($logLine));
        array_walk($splitLine, function(&$value) {
            $value = trim($value);
        });
        
        return new VagrantLogEntry(
            (int) $splitLine[0],
            $splitLine[1],
            new VagrantLogType($splitLine[2]),
            array_slice($splitLine, 3)
        );
    }
    
    /**
     * Performs any required cleanup on a log
     * message parsed in from Vagrant
     * @param string $logMessage Message to clean
     * @return string Cleaned message
     */    
    private static function cleanLogMessage(string $logMessage): string {
        return trim(str_replace('%!(VAGRANT_COMMA)', ',', $logMessage));
    }
    
    /**
     * Checks if a passed log line is in a valid Vagrant --machine-readable format.
     * If the line is from Vagrant and valid, it can be uplifted.
     * Otherwise, it is likely a raw shell response caused by the task executed and
     * should be stored as-is for later reference.
     * @param string $logLine Log line to analyse
     * @return bool Whether the log line can be uplifted into a Vagrant object
     */
    private static function isValidVagrantLogLine(string $logLine): bool {
        return preg_match('/^[0-9]+,[\w\-]*,[a-z\-]+,.*$/', $logLine);
    }
}
