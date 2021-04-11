<?php
    class ConfigTests extends \PHPUnit\Framework\TestCase{
        function testConnectionOk(){
            include "app\config.php";
            $this->assertEquals(is_object($db),true);
        }
    }
?>