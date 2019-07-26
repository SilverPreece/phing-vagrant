<?php

namespace GregJPreece\Phing\Vagrant\Run;

require_once(__DIR__ . '/../../../../../_data/vagrant-parser.fixtures.php');

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use GregJPreece\Phing\Vagrant\Data\VagrantLogType;
use GregJPreece\Phing\Vagrant\Data\VagrantErrorType;

/**
 * Unit tests for the parser that reads back Vagrant log info
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantOutputParserTest extends Unit {
    
    public function testParseSingleVagrantLog(): void {
        $logLine = Fixtures::get('parser.single.vagrant');
        $response = VagrantOutputParser::parseSingleLogLine($logLine);
        $this->assertFalse($response->hasOtherLogs());
        $this->assertTrue($response->hasVagrantLogs());
        
        $responseSet = $response->getVagrantLogs();
        $this->assertEquals(1, count($responseSet));
        
        $upliftedLogLine = array_pop($responseSet);
        $this->assertEquals(1558142346, $upliftedLogLine->getTimestamp());
        $this->assertEquals('one', $upliftedLogLine->getTarget());
        $this->assertTrue(VagrantLogType::STATE()->equals($upliftedLogLine->getType()));
        $this->assertEquals(['running'], $upliftedLogLine->getData());
    }
    
    public function testVagrantOnlySuccessLogs(): void {
        $logLine = Fixtures::get('parser.single.non-vagrant');
        $response = VagrantOutputParser::parseSingleLogLine($logLine);
        $this->assertTrue($response->hasOtherLogs());
        $this->assertFalse($response->hasVagrantLogs());
        
        $responseSet = $response->getOtherLogs();
        $this->assertEquals(1, count($responseSet));
        $this->assertEquals($logLine, array_pop($responseSet));
    }
    
    public function testVagrantLogLineCleaning(): void {
        $logLine = Fixtures::get('parser.single.comma-cleaning');
        $response = VagrantOutputParser::parseSingleLogLine($logLine);
        $this->assertFalse($response->hasOtherLogs());
        $this->assertTrue($response->hasVagrantLogs());
        
        $responseSet = $response->getVagrantLogs();
        $this->assertEquals(1, count($responseSet));
        
        $upliftedLogLine = array_pop($responseSet);
        $this->assertEquals(1558455471, $upliftedLogLine->getTimestamp());
        $this->assertEquals('vagrant-hostmanager', $upliftedLogLine->getTarget());
        $this->assertTrue(VagrantLogType::PLUGIN_VERSION()->equals($upliftedLogLine->getType()));
        $this->assertEquals(['1.8.9', 'global'], $upliftedLogLine->getData());
    }
    
    public function testLineArrayVagrantSuccess(): void {
        $logLines = Fixtures::get('parser.array.vagrant-success');
        $response = VagrantOutputParser::parseLineArray($logLines);
        $this->assessVagrantSuccessResponse($response);
    }
    
    public function testLineArrayVagrantFailure(): void {
        $logLines = Fixtures::get('parser.array.vagrant-failure');
        $response = VagrantOutputParser::parseLineArray($logLines);
        $this->assessVagrantFailureResponse($response);
    }
    
    public function testLineArrayMixedSuccess(): void {
        $logLines = Fixtures::get('parser.array.mixed-success');
        $response = VagrantOutputParser::parseLineArray($logLines);
        $this->assessMixedSuccessResponse($response);
    }
    
    public function testLineArrayMixedFailure(): void {
        // Can't actually find examples of this yet!
    }
    
    public function testRawLinesVagrantSuccess(): void {
        $logLines = Fixtures::get('parser.raw.vagrant-success');
        $response = VagrantOutputParser::parseRawLines($logLines);
        $this->assessVagrantSuccessResponse($response);
    }
    
    public function testRawLinesVagrantFailure(): void {
        $logLines = Fixtures::get('parser.raw.vagrant-failure');
        $response = VagrantOutputParser::parseRawLines($logLines);
        $this->assessVagrantFailureResponse($response);
    }
    
    public function testRawLinesMixedSuccess(): void {
        $logLines = Fixtures::get('parser.raw.mixed-success');
        $response = VagrantOutputParser::parseRawLines($logLines);
        $this->assessMixedSuccessResponse($response);
    }
    
    protected function assessVagrantSuccessResponse($response): void {
        $this->assertFalse($response->hasOtherLogs());
        $this->assertTrue($response->hasVagrantLogs());
        
        $responseSet = $response->getVagrantLogs();
        $this->assertEquals(11, count($responseSet));
        
        $machineOneState = array_reduce($responseSet,
            function($carry, $item) {
                if ($item->getTarget() === 'one' && 
                        VagrantLogType::STATE()->equals($item->getType())) {
                    $carry = $item;
                }
                return $carry;
            }
        );
        
        $machineTwoHumanShort = array_reduce($responseSet,
            function($carry, $item) {
                if ($item->getTarget() === 'two' && 
                        VagrantLogType::STATE_HUMAN_SHORT()->equals($item->getType())) {
                    $carry = $item;
                }
                return $carry;
            }
        );
        
        $this->assertNotNull($machineOneState);
        $this->assertNotNull($machineTwoHumanShort);
    }
    
    protected function assessVagrantFailureResponse($response): void {
        $this->assertFalse($response->hasOtherLogs());
        $this->assertTrue($response->hasVagrantLogs());
        
        $responseSet = $response->getVagrantLogs();
        $this->assertEquals(4, count($responseSet));
        
        $errorExit = array_reduce($responseSet,
            function($carry, $item) {
                if (VagrantLogType::ERROR_EXIT()->equals($item->getType())) {
                    $carry = $item;
                }
                return $carry;
            }
        );
        
        $this->assertNotNull($errorExit);
        $this->assertTrue(VagrantErrorType::MULTI_VM_TARGET_REQUIRED()->equals($errorExit->getError()));        
    }
    
    protected function assessMixedSuccessResponse($response): void {
        $this->assertTrue($response->hasOtherLogs());
        $this->assertTrue($response->hasVagrantLogs());
        
        $vagrantLogs = $response->getVagrantLogs();
        $otherLogs = $response->getOtherLogs();
                
        $this->assertEquals(3, count($vagrantLogs));
        $this->assertEquals(11, count($otherLogs));
        
        $sshStart = array_reduce($vagrantLogs,
            function($carry, $item) {
                if (VagrantLogType::ACTION()->equals($item->getType()) &&
                        $item->getData() == ['ssh_run', 'start']) {
                    $carry = $item;
                }
                return $carry;
            }
        );
        
        $sshEnd = array_reduce($vagrantLogs,
            function($carry, $item) {
                if (VagrantLogType::ACTION()->equals($item->getType()) &&
                        $item->getData() == ['ssh_run', 'end']) {
                    $carry = $item;
                }
                return $carry;
            }
        );
        
        $this->assertNotNull($sshStart);
        $this->assertNotNull($sshEnd);

        $logLines = Fixtures::get('parser.array.mixed-success');
        $rawLogSection = array_slice($logLines, 2, 11);
        $this->assertEquals($rawLogSection, $otherLogs);     
    }
}
