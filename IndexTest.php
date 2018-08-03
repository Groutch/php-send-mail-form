<?php
use PHPUnit\Framework\TestCase;
require "index.php";
class IndexTest extends TestCase
{
    public function testIsValidMail()
    {
        // un mail correct
        $this->assertTrue(isValidMail(["exemple@truc.com"]));
        // un mail sans le .com
        $this->assertFalse(isValidMail(["exemple@truc"]));
        // 2 mails corrects
        $this->assertTrue(isValidMail(["exemple@truc.com","toto@machin.fr"]));
        // 2 mails dont un incorrect
        $this->assertFalse(isValidMail(["exemple@truc.com","toto@machin"]));
    }
}