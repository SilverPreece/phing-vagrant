<?php

namespace GregJPreece\Phing\Vagrant\Task;

require_once(__DIR__ . '/../../../../../_data/vagrant-up.fixtures.php');

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use phpmock\phpunit\PHPMock;
use GregJPreece\Phing\Vagrant\Task\VagrantUpTask;

class VagrantUpTaskTest extends Unit {

    use PHPMock;

    /**
     * @var VagrantUpTask
     */
    protected $task;

    protected function _before(): void {
        $this->task = new VagrantUpTask();
    }

    protected function _after(): void {
        $this->task = null;
    }

    public function testDefaultDestroyFlagValue(): void {
        $this->assertEquals(true, $this->task->getDestroyOnError());
    }

    public function testAcceptDestroyFlag(): void {
        $this->task->setDestroyOnError(false);
        $this->assertEquals(false, $this->task->getDestroyOnError());
        $this->task->setDestroyOnError(true);
        $this->assertEquals(true, $this->task->getDestroyOnError());
    }

    public function testDefaultProviderSetting(): void {
        $this->assertEquals('virtualbox', $this->task->getProvider());
    }

    public function testAcceptProviderSetting(): void {
        $this->task->setProvider('vmware');
        $this->assertEquals('vmware', $this->task->getProvider());
    }

    public function testDefaultInstallProviderFlagValue(): void {
        $this->assertEquals(true, $this->task->getInstallProvider());
    }

    public function testAcceptInstallProviderFlag(): void {
        $this->task->setInstallProvider(false);
        $this->assertEquals(false, $this->task->getInstallProvider());
        $this->task->setInstallProvider(true);
        $this->assertEquals(true, $this->task->getInstallProvider());
    }

    public function testDefaultCommand(): void {
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up --destroy-on-error --install-provider --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.default.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithMachineId(): void {
        $this->task->setMachineId('4611bf6');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up 4611bf6 --destroy-on-error --install-provider --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.machine-id.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithMachineName(): void {
        $this->task->setMachineName('one');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up one --destroy-on-error --install-provider --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.machine-id.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithMachineNameAndId(): void {
        $this->task->setMachineId('4611bf6');
        $this->task->setMachineName('one');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up 4611bf6 --destroy-on-error --install-provider --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.machine-id.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithDestroyEnabled(): void {
        $this->task->setDestroyOnError(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up --destroy-on-error --install-provider --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.destroy.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithDestroyDisabled(): void {
        $this->task->setDestroyOnError(false);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up --no-destroy-on-error --install-provider --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.destroy.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithInstallProviderEnabled(): void {
        $this->task->setInstallProvider(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up --destroy-on-error --install-provider --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.install.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithInstallProviderDisabled(): void {
        $this->task->setInstallProvider(false);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up --destroy-on-error --no-install-provider --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.install.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithForceProvisionEnabled(): void {
        $this->task->setProvision(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up --destroy-on-error --install-provider --provision --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.force-provision.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithForceProvisionDisabled(): void {
        $this->task->setProvision(false);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up --destroy-on-error --install-provider --no-provision --provider virtualbox --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.force-provision.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

    public function testCommandWithAllFlagsNonDefault(): void {
        $this->task->setMachineId('4611bf6');
        $this->task->setMachineName('one');
        $this->task->setDestroyOnError(false);
        $this->task->setInstallProvider(false);
        $this->task->setProvider('vmware');
        $this->task->setProvision(false);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
                function($command, &$output, &$return_var) {
            $expectedCommand = 'vagrant up 4611bf6 --no-destroy-on-error --no-install-provider --no-provision --provider vmware --machine-readable';
            $this->assertEquals($expectedCommand, $command);
            $output = Fixtures::get('up.force-provision.success');
            $return_var = 0;
        }
        );

        $this->task->main();
    }

}
