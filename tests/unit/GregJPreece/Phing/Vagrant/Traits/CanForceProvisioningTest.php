<?php

namespace GregJPreece\Phing\Vagrant\Traits;

use Codeception\Test\Unit;

/**
 * Test cases for the trait allowing a
 * task to accept the "force provisioning"
 * flag.
 * @author Greg J Preece <greg@preece.ca>
 */
class CanForceProvisioningTest extends Unit {

    /**
     *
     * @var PHPUnit\Framework\MockObject
     */
    protected $mockTrait;

    protected function _after(): void {
        $this->mockTrait = null;
    }

    protected function _before(): void {
        $this->mockTrait = $this->getObjectForTrait(
                'GregJPreece\Phing\Vagrant\Traits\CanForceProvisioning'
        );
    }

    /**
     * Not normally a good idea, but I think there's a reasonable
     * exception to be made in the case of a trait like this.
     * The method should not normally be public inside the class
     * it is applied to, but testing it here requires it to be -
     * there is no other public API to test.
     * @return void
     */
    protected function makeProvisionFlagPublic(): \ReflectionMethod {
        $method = new \ReflectionMethod(
                get_class($this->mockTrait),
                'getProvisioningFlag'
        );
        $method->setAccessible(true);
        return $method;
    }

    public function testProvisioningFlagWhenNotSet(): void {
        $this->assertEquals(null, $this->mockTrait->getProvision());
    }

    public function testAcceptsProvisioningFlag(): void {
        $this->mockTrait->setProvision(true);
        $this->assertEquals(true, $this->mockTrait->getProvision());
        $this->mockTrait->setProvision(false);
        $this->assertEquals(false, $this->mockTrait->getProvision());
    }

    public function testProvisioningFlagExistenceWhenSetFalse(): void {
        $this->assertEquals(false, $this->mockTrait->hasProvisioningOption());
        $this->mockTrait->setProvision(false);
        $this->assertEquals(true, $this->mockTrait->hasProvisioningOption());
    }

    public function testProvisioningFlagExistenceWhenSetTrue(): void {
        $this->assertEquals(false, $this->mockTrait->hasProvisioningOption());
        $this->mockTrait->setProvision(true);
        $this->assertEquals(true, $this->mockTrait->hasProvisioningOption());
    }

    public function testProvisioningCommandFlagWhenNotSet(): void {
        $flagMethod = $this->makeProvisionFlagPublic();
        $this->assertEquals(null, $flagMethod->invoke($this->mockTrait));
    }

    public function testProvisioningCommandFlagWhenSetFalse(): void {
        $flagMethod = $this->makeProvisionFlagPublic();
        $this->mockTrait->setProvision(false);
        $this->assertEquals('--no-provision', $flagMethod->invoke($this->mockTrait));
    }

    public function testProvisioningCommandFlagWhenSetTrue(): void {
        $flagMethod = $this->makeProvisionFlagPublic();
        $this->mockTrait->setProvision(true);
        $this->assertEquals('--provision', $flagMethod->invoke($this->mockTrait));
    }

}
