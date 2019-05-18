<?php

namespace GregJPreece\Phing\Vagrant\Task;

require_once(__DIR__ . '/../../../../../_data/vagrant-status.fixtures.php');

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use phpmock\phpunit\PHPMock;
use GregJPreece\Phing\Vagrant\Task\VagrantStatusTask;
use Project;

/**
 * Unit tests for the "vagrant status" task
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantStatusTaskTest extends Unit {
    use PHPMock;

    /**
     * @var VagrantStatusTask
     */
    protected $task;

    protected function _after() {
        $this->task = null;
    }

    protected function _before() {
        $this->task = new VagrantStatusTask();
        $this->task->setProject(new Project());
    }

    public function testMachineStateNotCreated(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->at(1))->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant status --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('status.not-created');
            $return_var = 0;
        });

        $this->task->main();
        $this->assertEquals('not_created', $this->task->getProject()->getProperty('vagrant.one.state'));
    }
    
    public function testMachineStateRunning(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->at(1))->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant status --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('status.running');
            $return_var = 0;
        });

        $this->task->main();
        $this->assertEquals('running', $this->task->getProject()->getProperty('vagrant.one.state'));
    }
    
    public function testMachineStatePoweredOff(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->at(1))->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant status --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('status.powered-off');
            $return_var = 0;
        });

        $this->task->main();
        $this->assertEquals('poweroff', $this->task->getProject()->getProperty('vagrant.one.state'));
    }
    
    public function testMachineStateSaved(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->at(1))->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant status --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('status.saved');
            $return_var = 0;
        });

        $this->task->main();        
        $this->assertEquals('saved', $this->task->getProject()->getProperty('vagrant.one.state'));
    }
    
    public function testVersionCurrent(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->at(0))->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant version --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('version.current');
            $return_var = 0;
        });

        $this->task->main();        
        $this->assertEquals(
            Fixtures::get('version.current.expected'), 
            $this->task->getProject()->getProperty('vagrant.version')
        );
    }
    
    public function testVersionOld(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->at(0))->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant version --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('version.old');
            $return_var = 0;
        });

        $this->task->main();        
        $this->assertEquals(
            Fixtures::get('version.old.expected'), 
            $this->task->getProject()->getProperty('vagrant.version')
        );
    }
    
}
