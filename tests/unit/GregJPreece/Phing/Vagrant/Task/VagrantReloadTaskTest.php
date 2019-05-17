<?php

namespace GregJPreece\Phing\Vagrant\Task;

require_once(__DIR__ . '/../../../../../_data/vagrant-reload.fixtures.php');

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use phpmock\phpunit\PHPMock;
use GregJPreece\Phing\Vagrant\Task\VagrantReloadTask;

/**
 * Unit tests for the "vagrant reload" task
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantReloadTaskTest extends Unit {

    use PHPMock;

    /**
     *
     * @var VagrantReloadTask
     */
    protected $task;

    protected function _after() {
        $this->task = null;
    }

    protected function _before() {
        $this->task = new VagrantReloadTask();
    }

    public function testDefaultProvisionersValue(): void {
        $this->assertEquals(false, $this->task->hasProvisioners());
        $this->assertEquals([], $this->task->getProvisioners());
    }

    public function testAcceptsProvisioners(): void {
        $this->task->setProvisioners('spike,jet,faye,ed,ein');
        $this->assertContains('spike', $this->task->getProvisioners());
        $this->assertContains('jet', $this->task->getProvisioners());
        $this->assertContains('faye', $this->task->getProvisioners());
        $this->assertContains('ed', $this->task->getProvisioners());
        $this->assertContains('ein', $this->task->getProvisioners());
    }

    public function testDefaultCommand(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant reload --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('reload.default.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithMachineId(): void {
        $this->task->setMachineId('1a2b3c');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant reload 1a2b3c --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('reload.machine-id.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithMachineName(): void {
        $this->task->setMachineName('one');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant reload one --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('reload.machine-name.success');
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
            $expectedCommand = 'vagrant reload 1a2b3c --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('reload.machine-id.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithForceProvisionFlagTrue(): void {
        $this->task->setProvision(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant reload --provision --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('reload.provision.success');
            $return_var = 0;
        });

        $this->task->main();
    }

    public function testCommandWithForceProvisionFlagFalse(): void {
        $this->task->setProvision(false);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant reload --no-provision --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('reload.provision.success');
            $return_var = 0;
        });

        $this->task->main();
    }
    
    public function testCommandWithProvisioners(): void {
        $this->task->setProvisioners('spike,faye,jet,ed,ein');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant reload --provision-with spike,faye,jet,ed,ein --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('reload.provisioners.success');
            $return_var = 0;
        });

        $this->task->main();
    }
    
    public function testCommandWithEverythingNonDefault(): void {
        $this->task->setMachineId('1a2b3c');
        $this->task->setMachineName('one');
        $this->task->setProvision(true);
        $this->task->setProvisioners('spike,faye,jet,ed,ein');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant reload 1a2b3c --provision --provision-with spike,faye,jet,ed,ein --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('reload.provisioners.success');
            $return_var = 0;
        });

        $this->task->main();
    }
    
}
