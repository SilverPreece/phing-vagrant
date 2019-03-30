<?php

namespace GregJPreece\Phing\Vagrant;

/**
 * Base task class from which other tasks derive
 * @author Greg J Preece <greg@preece.ca>
 */
abstract class VagrantTask extends \Task {

    protected function runCommand(string $command): int {
        $response = null;
        passthru('vagrant ' . $command, $response);
        return $response;
    }
        
}
