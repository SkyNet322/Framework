<?php
use Zend\Diactoros\ServerRequestFactory;

class ResponseSenderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSend()
    {
        $string = "TEST->OK";
        $streamString = fopen('data://text/plain,' . $string,'r');
        $streamObj = new \Zend\Diactoros\Stream($streamString);

        $response = (new \Zend\Diactoros\Response(
            $body = 'php://memory',
            $status = 200,
            $headers = ['X-Developer' => 'Ar']
        )) -> withBody($streamObj);

        ob_start();
        (new \Framework\Http\ResponseSender())->send($response);
        $answer = ob_get_clean();

        $this->assertEquals($answer, $string);
    }
}