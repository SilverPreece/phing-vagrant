<?php

namespace GregJPreece\Phing\Vagrant\Task;

require_once(__DIR__ . '/../../../../../_data/vagrant-destroy.fixtures.php');

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use phpmock\phpunit\PHPMock;
use GregJPreece\Phing\Vagrant\Task\VagrantDestroyTask;


/**
 * Unit tests for the "vagrant destroy" task
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantDestroyTaskTest extends Unit {
    
    use PHPMock;
    
    /**
     * @var VagrantDestroyTask
     */
    protected $task;
    
    protected function _after(): void {
        $this->task = null;
    }

    protected function _before(): void {
        $this->task = new VagrantDestroyTask();
    }
    
    public function testDefaultParallelFlagValue(): void {
        $this->assertEquals(null, $this->task->getParallel());
    }
    
    public function testAcceptsParallelFlag(): void {
        $this->task->setParallel(false);
        $this->assertEquals(false, $this->task->getParallel());
        $this->task->setParallel(true);
        $this->assertEquals(true, $this->task->getParallel());
    }

    public function testDefaultCommand(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant destroy --force --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('destroy.default.success');
            $return_var = 0;
        });

        $this->task->main();
    }
    
    public function testCommandWithMachineId(): void {
        $this->task->setMachineId('1a2b3c');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant destroy 1a2b3c --force --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('destroy.machine-id.success');
            $return_var = 0;
        });

        $this->task->main();
    }
        
    public function testCommandWithMachineName(): void {
        $this->task->setMachineName('one');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant destroy one --force --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('destroy.machine-name.success');
            $return_var = 0;
        });

        $this->task->main();
    }
        
    public function testCommandWithMachineNameAndId(): void {
        $this->task->setMachineId('1a2b3c');
        $this->task->setMachineName('one');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant destroy 1a2b3c --force --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('destroy.machine-id.success');
            $return_var = 0;
        });

        $this->task->main();
    }
    
    public function testDestroyInSeries(): void {
        $this->task->setParallel(false);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant destroy --force --no-parallel --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('destroy.parallel.success');
            $return_var = 0;
        });

        $this->task->main();
    }
        
    public function testDestroyInParallel(): void {
        $this->task->setParallel(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant destroy --force --parallel --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('destroy.parallel.success');
            $return_var = 0;
        });

        $this->task->main();
    }
    
    public function testCommandWithAllNonDefault(): void {
        $this->task->setMachineId('1a2b3c');
        $this->task->setMachineName('one');
        $this->task->setParallel(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant destroy 1a2b3c --force --parallel --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('destroy.parallel.success');
            $return_var = 0;
        });

        $this->task->main();
    }
    
}
