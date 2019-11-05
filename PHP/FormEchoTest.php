<?php
use PHPUnit\Framework\TestCase;

require_once('formecho.php');

class FormEchoTest extends TestCase {
    public function testCleanActuallyClean(): void {
        $str = 'ABC';
        $this->assertSame($str, phb_clean_string($str));
    }

    public function testCleanHTMLTag(): void {
        $str = '<html>';
        $this->assertSame('&lt;html&gt;', phb_clean_string($str));
    }

    public function testCleanQuotes(): void {
        $str = '\'html"';
        $this->assertSame('&apos;html&quot;', phb_clean_string($str));
    }
}