<?php

namespace GregJPreece\Phing\Vagrant\Task;

require_once(__DIR__ . '/../../../../../_data/vagrant-halt.fixtures.php');

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use phpmock\phpunit\PHPMock;
use GregJPreece\Phing\Vagrant\Task\VagrantHaltTask;
use Project;

/**
 * Unit tests for "vagrant halt" task
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantHaltTaskTest extends Unit {

    use PHPMock;

    /**
     *
     * @var VagrantHaltTask
     */
    protected $task;

    protected function _after() {
        $this->task = null;
    }

    protected function _before() {
        $this->task = new VagrantHaltTask();
        $this->task->setProject(new Project());
    }

    public function testDefaultForceFlagValue(): void {
        $this->assertEquals(null, $this->task->getForce());
    }

    public function testAcceptsForceFlag(): void {
        $this->task->setForce(true);
        $this->assertEquals(true, $this->task->getForce());
        $this->task->setForce(false);
        $this->assertEquals(false, $this->task->getForce());
    }

    public function testDefaultCommand(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant halt --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('halt.default.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithMachineId(): void {
        $this->task->setMachineId('1a2b3c');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant halt 1a2b3c --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('halt.machine-id.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithMachineName(): void {
        $this->task->setMachineName('one');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant halt one --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('halt.machine-name.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithMachineIdAndName(): void {
        $this->task->setMachineId('1a2b3c');
        $this->task->setMachineName('one');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant halt 1a2b3c --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('halt.machine-id.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithForceFlagTrue(): void {
        $this->task->setForce(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant halt --force --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('halt.force.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithForceFlagFalse(): void {
        $this->task->setForce(false);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant halt --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('halt.force.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithMachineIdAndForceFlag(): void {
        $this->task->setMachineId('1a2b3c');
        $this->task->setForce(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant halt 1a2b3c --force --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('halt.force.success');
            $return_var = 0;
        });

        $this->task->main();
    }

}
