<?php
use App\SecurityFactory;
class SecurityTest extends \PHPUnit\Framework\TestCase
{
    public function testSecurity()
    {
        $encryption_decryption = SecurityFactory::create();
        $this->assertEquals('PMPMGg==',$encryption_decryption->cn_encryption("Test"));
    }
}