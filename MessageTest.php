<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;
use TestDrom\ClientCommentService;


class IntegrationTest extends TestCase
{
    private static $process;

    //PHP сервер
    public static function setUpBeforeClass()
    {
        self::$process = new Process("php -S localhost:8080 -t .");
        self::$process->start();
        usleep(100000);
    }

    public static function tearDownAfterClass()
    {
        self::$process->stop();
    }

    //Проверка кода 404
    public function test_getComments404()
    {
        $client = new ClientCommentService("http://localhost:8080/test404");

        $this->assertEquals(404, $client->getComments()[0]);
    }

    //Тестирования запроса get
    public function test_getComments()
    {
        $client = new ClientCommentService("http://localhost:8080");
        $data = array('name' => 'name', 'text' => 'comment');
        $data_string = json_encode($data);
        $s = $client->getComments();
        $this->assertEquals(200, $client->getComments()[0]);
        $this->assertEquals($data_string, $s[1]);
    }

    //Тестирование post
    public function test_addComment()
    {
        $client = new ClientCommentService("http://localhost:8080");
        $s = $client->addComment('Alex', 'Good');
        $this->assertEquals(200, $s[0]);
        $this->assertEquals("ok", $s[1]);
    }

    //Тестирование put
    public function test_updateComment()
    {
        $client = new ClientCommentService("http://localhost:8080");

        $s = $client->updateComment(1, 'alex', 'nice');
        $this->assertEquals(200, $s[0]);
        $p = 1;
        $this->assertEquals($p, $s[1]);
    }
}

?>
