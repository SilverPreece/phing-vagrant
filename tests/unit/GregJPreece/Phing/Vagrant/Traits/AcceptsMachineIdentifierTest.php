<?php

namespace GregJPreece\Phing\Vagrant\Traits;

use Codeception\Test\Unit;

/**
 * Test cases for the trait allowing a
 * task to accept machine identifiers
 * @author Greg J Preece <greg@preece.ca>
 */
class AcceptsMachineIdentifierTest extends Unit {

    /**
     *
     * @var PHPUnit\Framework\MockObject
     */
    protected $traitMock;

    protected function _before(): void {
        $this->traitMock = $this->getMockForTrait(
                'GregJPreece\Phing\Vagrant\Traits\AcceptsMachineIdentifier'
        );
    }

    protected function _after(): void {
        $this->traitMock = null;
    }

    public function testAcceptMachineId(): void {
        $this->traitMock->setMachineId('4611bf6');
        $this->assertEquals('4611bf6', $this->traitMock->getMachineId());
    }

    public function testAcceptMachineName(): void {
        $this->traitMock->setMachineName('one');
        $this->assertEquals('one', $this->traitMock->getMachineName());
    }

    public function testMachineIdentifierWithNothingSet(): void {
        $this->assertEquals(null, $this->traitMock->getMachineIdentifier());
    }

    public function testMachineIdentifierWithIdSet(): void {
        $this->traitMock->setMachineId('4611bf6');
        $this->assertEquals('4611bf6', $this->traitMock->getMachineIdentifier());
    }

    public function testMachineIdentifierWithNameSet(): void {
        $this->traitMock->setMachineName('one');
        $this->assertEquals('one', $this->traitMock->getMachineIdentifier());
    }

    public function testMachineIdentifierWithBothSet(): void {
        $this->traitMock->setMachineId('4611bf6');
        $this->traitMock->setMachineName('one');
        $this->assertEquals('4611bf6', $this->traitMock->getMachineIdentifier());
    }

}
