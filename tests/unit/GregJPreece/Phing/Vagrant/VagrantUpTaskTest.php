<?php 

namespace GregJPreece\Phing\Vagrant;

require_once(__DIR__ . '/../../../../_data/vagrant-up.fixtures.php');

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use phpmock\phpunit\PHPMock;
use GregJPreece\Phing\Vagrant\Task\VagrantUpTask;

class VagrantUpTaskTest extends Unit {
    
    use PHPMock;
    
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    /**
     * @var VagrantUpTask
     */
    protected $task;
    
    protected function _before() {
        $this->task = new VagrantUpTask();
    }

    protected function _after() {
        $this->task = null;
    }
    
    public function testDefaultDestroyFlagValue() {
        $this->assertEquals(true, $this->task->getDestroyOnError());
    }
    
    public function testAcceptDestroyFlag() {
        $this->task->setDestroyOnError(false);
        $this->assertEquals(false, $this->task->getDestroyOnError());
        $this->task->setDestroyOnError(true);
        $this->assertEquals(true, $this->task->getDestroyOnError());
    }
    
    public function testDefaultProviderSetting() {
        $this->assertEquals('virtualbox', $this->task->getProvider());
    }
    
    public function testAcceptProviderSetting() {
        $this->task->setProvider('vmware');
        $this->assertEquals('vmware', $this->task->getProvider());
    }
    
    public function testDefaultInstallProviderFlagValue() {
        $this->assertEquals(true, $this->task->getInstallProvider());
    }
    
    public function testAcceptInstallProviderFlag() {
        $this->task->setInstallProvider(false);
        $this->assertEquals(false, $this->task->getInstallProvider());
        $this->task->setInstallProvider(true);
        $this->assertEquals(true, $this->task->getInstallProvider());
    }
    
    public function testDefaultCommand() {
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
    
    public function testCommandWithMachineId() {
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
   
    public function testCommandWithMachineName() {
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

    public function testCommandWithMachineNameAndId() {
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
    
    public function testCommandWithDestroyEnabled() {
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
    
    public function testCommandWithDestroyDisabled() {
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
    
    public function testCommandWithInstallProviderEnabled() {
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
    
    public function testCommandWithInstallProviderDisabled() {
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
    
    public function testCommandWithForceProvisionEnabled() {
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
    
    public function testCommandWithForceProvisionDisabled() {
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
    
    public function testCommandWithAllFlagsNonDefault() {
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
