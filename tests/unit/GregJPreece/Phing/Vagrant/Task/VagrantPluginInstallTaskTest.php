<?php

namespace GregJPreece\Phing\Vagrant\Task;

require_once(__DIR__ . '/../../../../../_data/vagrant-plugin-install.fixtures.php');

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use phpmock\phpunit\PHPMock;
use GregJPreece\Phing\Vagrant\Task\VagrantPluginInstallTask;
use Project;

/**
 * Unit tests for the "vagrant plugin install" task
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantPluginInstallTaskTest extends Unit {
    
    use PHPMock;

    /**
     * @var VagrantPluginInstallTask
     */
    protected $task;

    protected function _after(): void {
        $this->task = null;
    }

    protected function _before(): void {
        $this->task = new VagrantPluginInstallTask();
        $this->task->setProject(new Project());
    }
    
    public function testAcceptsPluginName(): void {
        $this->task->setName('oobly-doobly-doo');
        $this->assertEquals('oobly-doobly-doo', $this->task->getName());
    }
    
    public function testAcceptsVersion(): void {
        $this->task->setVersion('1.2.3');
        $this->assertEquals('1.2.3', $this->task->getVersion());
    }
    
    public function testAcceptsMinVersion(): void {
        $this->task->setMinVersion('2.3.4');
        $this->assertEquals('2.3.4', $this->task->getMinVersion());
    }
    
    public function testAcceptsMaxVersion(): void {
        $this->task->setMaxVersion('3.4.5');
        $this->assertEquals('3.4.5', $this->task->getMaxVersion());
    }

// @TODO: Figure out why I can't get an exception here    
//    public function testCommandRequiresName(): void {
//        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
//        $fakeExec->expects($this->once())->willReturnCallback(
//            function($command, &$output, &$return_var) {
//                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --machine-readable';
//                $this->assertEquals($expectedCommand, $command);
//                $output = Fixtures::get('plugin-install.success');
//                $return_var = 0;
//            }
//        );
//
//        $this->expectException(\BuildException::class);
//        $this->task->main();
//    }
    
    public function testCommandWithNameOnly(): void {
        $this->task->setName('vagrant-test-plugin');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
            function($command, &$output, &$return_var) {
                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --machine-readable';
                $this->assertEquals($expectedCommand, $command);
                $output = Fixtures::get('plugin-install.success');
                $return_var = 0;
            }
        );

        $this->task->main();                
    }
    
    public function testCommandWithVersion(): void {
        $this->task->setName('vagrant-test-plugin');
        $this->task->setVersion('1.2.3');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
            function($command, &$output, &$return_var) {
                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --plugin-version 1.2.3 --machine-readable';
                $this->assertEquals($expectedCommand, $command);
                $output = Fixtures::get('plugin-install.success');
                $return_var = 0;
            }
        );

        $this->task->main();                
    }
    
    public function testCommandWithMinVersion(): void {
        $this->task->setName('vagrant-test-plugin');
        $this->task->setMinVersion('1.2.3');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
            function($command, &$output, &$return_var) {
                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --plugin-version ">1.2.3" --machine-readable';
                $this->assertEquals($expectedCommand, $command);
                $output = Fixtures::get('plugin-install.success');
                $return_var = 0;
            }
        );

        $this->task->main();                
    }
    
    public function testCommandWithMaxVersion(): void {
        $this->task->setName('vagrant-test-plugin');
        $this->task->setMaxVersion('1.2.3');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
            function($command, &$output, &$return_var) {
                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --plugin-version "<1.2.3" --machine-readable';
                $this->assertEquals($expectedCommand, $command);
                $output = Fixtures::get('plugin-install.success');
                $return_var = 0;
            }
        );

        $this->task->main();                
    }
    
    // Until bug is fixed in Vagrant, min version beats max version
    // https://github.com/hashicorp/vagrant/issues/10877
    public function testCommandWithMinAndMaxVersion(): void {
        $this->task->setName('vagrant-test-plugin');
        $this->task->setMaxVersion('1.2.3');
        $this->task->setMinVersion('1.0.0');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
            function($command, &$output, &$return_var) {
                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --plugin-version ">1.0.0" --machine-readable';
                $this->assertEquals($expectedCommand, $command);
                $output = Fixtures::get('plugin-install.success');
                $return_var = 0;
            }
        );

        $this->task->main();                
    }
    
    public function testCommandWithAllVersionFlags(): void {
        $this->task->setName('vagrant-test-plugin');
        $this->task->setVersion('1.0.1');
        $this->task->setMaxVersion('1.2.3');
        $this->task->setMinVersion('1.0.0');
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
            function($command, &$output, &$return_var) {
                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --plugin-version 1.0.1 --machine-readable';
                $this->assertEquals($expectedCommand, $command);
                $output = Fixtures::get('plugin-install.success');
                $return_var = 0;
            }
        );

        $this->task->main();                
    }
    
    public function testCommandLocalPluginInstall(): void {
        $this->task->setName('vagrant-test-plugin');
        $this->task->setLocal(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
            function($command, &$output, &$return_var) {
                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --local --machine-readable';
                $this->assertEquals($expectedCommand, $command);
                $output = Fixtures::get('plugin-install.success');
                $return_var = 0;
            }
        );

        $this->task->main();                
    }
    
    public function testCommandGlobalPluginInstall(): void {
        $this->task->setName('vagrant-test-plugin');
        $this->task->setLocal(false);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
            function($command, &$output, &$return_var) {
                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --machine-readable';
                $this->assertEquals($expectedCommand, $command);
                $output = Fixtures::get('plugin-install.success');
                $return_var = 0;
            }
        );

        $this->task->main();                
    }
    
    public function testCommandWithEveryFlagNonDefault(): void {
        $this->task->setName('vagrant-test-plugin');
        $this->task->setVersion('1.0.1');
        $this->task->setMaxVersion('1.2.3');
        $this->task->setMinVersion('1.0.0');
        $this->task->setLocal(true);
        $fakeExec = $this->getFunctionMock('GregJPreece\\Phing\\Vagrant\\Task', "exec");
        $fakeExec->expects($this->once())->willReturnCallback(
            function($command, &$output, &$return_var) {
                $expectedCommand = 'vagrant plugin install vagrant-test-plugin --local --plugin-version 1.0.1 --machine-readable';
                $this->assertEquals($expectedCommand, $command);
                $output = Fixtures::get('plugin-install.success');
                $return_var = 0;
            }
        );

        $this->task->main();                
    }
        
    
}
