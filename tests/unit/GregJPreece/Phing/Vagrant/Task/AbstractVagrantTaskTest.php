<?php

namespace GregJPreece\Phing\Vagrant\Task;

// Let's use the "vagrant up" fixtures for testing the abstract
require_once(__DIR__ . '/../../../../../_data/vagrant-up.fixtures.php');

use Codeception\Test\Unit;
use phpmock\phpunit\PHPMock;
use GregJPreece\Phing\Vagrant\Run\VagrantLogEntry;
use GregJPreece\Phing\Vagrant\Run\VagrantLogType;
use Project;

/**
 * Test cases for the abstract Vagrant task
 * from which all other tasks derive
 * @author Greg J Preece <greg@preece.ca>
 */
class AbstractVagrantTaskTest extends Unit {

    use PHPMock;
    
    /**
     *
     * @var MockObject
     */
    protected $task;
        
    protected function _after() {
        $this->task = null;
    }

    protected function _before() {
        $this->task = $this->getMockForAbstractClass(
            'GregJPreece\Phing\Vagrant\Task\AbstractVagrantTask'
        );
        $this->task->setProject(new Project());
    }
    
    protected function getMethodAsPublic(string $method): \ReflectionMethod {
        $reflection = new \ReflectionClass($this->task);
        $method = $reflection->getMethod($method);
        $method->setAccessible(true);
        return $method;
    }
    
    // I wouldn't normally bother testing private/protected methods,
    // but this is the big abstract task from which all tasks derive,
    // so I feel like testing its internals is worth my time
    
    public function testVagrantBinaryCallWithNothingSet(): void {
        $method = $this->getMethodAsPublic('getPathedVagrantExecutable');
        $this->assertEquals('vagrant', $method->invoke($this->task, []));
    }
    
    public function testVagrantBinaryCallWithPropertySet(): void {
        $this->task->getProject()->setProperty('vagrant.path', '/usr/bin/vagrant');
        $method = $this->getMethodAsPublic('getPathedVagrantExecutable');
        $this->assertEquals('/usr/bin/vagrant', $method->invoke($this->task));
    }
    
    public function testVagrantBinaryCallWithAttributeSet(): void {
        $this->task->setVagrantPath('/usr/local/bin/vagrant');
        $method = $this->getMethodAsPublic('getPathedVagrantExecutable');
        $this->assertEquals('/usr/local/bin/vagrant', $method->invoke($this->task));
    }
    
    public function testVagrantBinaryCallWithPropertyAndAttributeSet(): void {
        $this->task->setVagrantPath('/usr/local/bin/vagrant');
        $this->task->getProject()->setProperty('vagrant.path', '/usr/bin/vagrant');
        $method = $this->getMethodAsPublic('getPathedVagrantExecutable');
        $this->assertEquals('/usr/local/bin/vagrant', $method->invoke($this->task));
    }
    
    public function testSetNamespacedProjectProperty(): void {
        $method = $this->getMethodAsPublic('setNamespacedProperty');
        $method->invoke($this->task, 'cheese', 'whiz');
        $this->assertEquals(null, $this->task->getProject()->getProperty('cheese'));
        $this->assertEquals('whiz', $this->task->getProject()->getProperty('vagrant.cheese'));
    }
    
    public function testGetNamespacedProjectProperty(): void {
        $getMethod = $this->getMethodAsPublic('getNamespacedProperty');
        $setMethod = $this->getMethodAsPublic('setNamespacedProperty');
        $this->task->getProject()->setProperty('vagrant.cheese', 'whiz');
        $this->assertEquals('whiz', $getMethod->invoke($this->task, 'cheese'));
        $setMethod->invoke($this->task, 'cheese', 'curds');
        $this->assertEquals('curds', $getMethod->invoke($this->task, 'cheese'));
    }
    
    public function testLogLineFormatting(): void {
        $formatMethod = $this->getMethodAsPublic('formatLogLine');
        
        $logLine = new VagrantLogEntry(
            1560567000, 
            'default', 
            VagrantLogType::ACTION(), 
            [
                'spike',
                'jet',
                'faye',
                'ed',
                'ein'
            ]
        );
        $this->assertEquals(
            '[2019-06-14 19:50:00][DEFAULT][ACTION] spike, jet, faye, ed, ein',
            $formatMethod->invoke($this->task, $logLine)
        );
    }
    
}
