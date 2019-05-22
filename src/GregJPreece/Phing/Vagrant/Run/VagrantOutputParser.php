<?php

namespace GregJPreece\Phing\Vagrant\Run;

use GregJPreece\Phing\Vagrant\Run\VagrantLogEntry;

/**
 * Parses the output from Vagrant's --machine-readable mode
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantOutputParser {

    /**
     * Parses a raw string set of Vagrant log lines into objects
     * @param string $logLines Raw logs to parse
     * @return VagrantLogEntry[] Parsed log entries
     */
    public static function parseRawLines(string $logLines): array {
        $parsedLines = [];
        
        // strtok is more performant than preg_split
        $line = strtok($logLines, "\r\n");
        $parsedLines[] = self::parseLine($line);
        
        while ($line !== false) {
            $line = strtok($logLines, "\r\n");
            $parsedLines[] = self::parseLine($line);
        }
        
        return $parsedLines;
    }
    
    /**
     * Parses an array of Vagrant log lines into objects
     * @param array $logLines Log lines to parse
     * @return VagrantLogEntry[] Parsed log entries
     */
    public static function parseLineArray(array $logLines): array {
        $parsedLines = [];
        
        foreach ($logLines as $logLine) {
            $parsedLines[] = self::parseLine($logLine);
        }

        return $parsedLines;
    }
    
    /**
     * Parses a single Vagrant log line into a log entry object
     * @param string $logLine Log line to parse
     * @return VagrantLogEntry Parsed log entry
     */
    public static function parseLine(string $logLine): VagrantLogEntry {
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
}
