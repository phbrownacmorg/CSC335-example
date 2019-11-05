<?php
use PHPUnit\Framework\TestCase;

require_once('formecho.php');

class FormEchoTest extends TestCase {

    // Avoid dependencies between tests.
    protected function tearDown(): void {
        // Maybe nice, but not all that big a deal
        unset($str);
        unset($data);
        // Truly important stuff
        $_GET = array();
        $_POST = array();
    }

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

    public function testInputFeedGET(): void {
        $_GET = array();
        $_GET['value'] = 'get_stuff';
        $data = inputData();
        $this->assertSame($data['_phb_form_method'], 'GET');
        $this->assertSame($data['value'], 'get_stuff');
    }

    public function testInputFeedPOST(): void {
        $_POST = array();
        $_POST['value'] = 'post_stuff';
        $data = inputData();
        $this->assertSame($data['_phb_form_method'], 'POST');
        $this->assertSame($data['value'], 'post_stuff');
    }
 
    public function testArrayAsTableBody(): void {
        $_GET = array();
        $_GET['value'] = 'get_stuff';
        $_GET['value2'] = 'more stuff';
        $data = inputData();
        $this->assertSame($data['_phb_form_method'], 'GET');
        $this->assertSame(array_as_table_body($data),
            '<tr><td class="key">value</td><td class="value">get&lowbar;stuff</td></tr>\n'
            . '<tr><td class="key">value2</td><td class="value">more stuff</td></tr>\n');
    }

}