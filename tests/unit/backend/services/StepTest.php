<?php

if (!defined('PATH_SEP')) {
    define('PATH_SEP',		'/');
}

require_once PATH_HOME . 'engine/services/rest/crud/Step.php';
require_once("Rest/JsonMessage.php");
require_once("Rest/XmlMessage.php");
require_once("Rest/RestMessage.php");

class StepTest extends PHPUnit_Extensions_Database_TestCase
{
    public function setup()
    {
    }

    protected function getTearDownOperation()
    {
        return PHPUnit_Extensions_Database_Operation_Factory::DELETE_ALL();
    }

    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */

    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;
    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;

    public function getConnection()
    {
        if ($this->conn === null) {
            $dsn = 'mysql:dbname=' . $_SERVER['PM_UNIT_DB_NAME'] . ';host='. $_SERVER['PM_UNIT_DB_HOST'];
            if (self::$pdo == null) {
                self::$pdo = new PDO(
                    $dsn,
                    $_SERVER['PM_UNIT_DB_USER'],
                    $_SERVER['PM_UNIT_DB_PASS'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $_SERVER['PM_UNIT_DB_NAME']);
        }
        return $this->conn;
    }

    /**
     *@return PHPUnit_Extensions_Database_DataSet_IDataSet
     */

    public function getDataSet()
    {
        return $this->createXMLDataSet('tests/unit/backend/services/Rest/fixtures/application.xml');
    }

    public function testGet()
    {
        $msg = array( 'user'=>'admin' , 'password'=>'admin');
        $method = "login";

        $jsonm = new JsonMessage();
        $jsonm->send($method,$msg);
        //$jsonm->displayResponse();

        $xmlm = new XmlMessage();
        $xmlm->send($method, $msg);
        //$xmlm->displayResponse();

        $key = array( "440848627503b77c71a9637072432170");
        $table = "STEP";

        $rest = new RestMessage();
        $resp = $rest->sendGET($table,$key);
        //$rest->displayResponse();

        $queryTable = $this->getConnection()->createQueryTable(
            'STEP', 'SELECT * FROM STEP WHERE STEP_UID = "440848627503b77c71a9637072432170"'
        );

        $key2 = array("741973");
        $rest->sendGET($table,$key2);

        //$this->assertEquals($resp, $queryTable, "ERROR getting data");
    }

    public function testPost()
    {
        $msg = array( 'user'=>'admin' , 'password'=>'admin');
        $method = "login";

        $jsonm = new JsonMessage();
        $jsonm->send($method,$msg);
        //$jsonm->displayResponse();

        $xmlm = new XmlMessage();
        $xmlm->send($method, $msg);
        //$xmlm->displayResponse();

        $key = array( "440848627503b77c71a9637074444444", "359728002502a792a568a54012111111", "499115418502a795a0cfb43043666666", "SAMPLE", "913768259503b76894536b2095222222", "", "1", "EDIT");
        $table = "STEP";

        $rest = new RestMessage();
        $rest->sendPOST($table,$key);
        //$rest->displayResponse();

        $key1 = array("440848627503b77c71a9637074444444");
        $resp = $rest->sendGET($table,$key1);

        $queryTable = $this->getConnection()->createQueryTable(
            'STEP', 'SELECT * FROM STEP WHERE STEP_UID = "440848627503b77c71a9637074444444"'
        );

        $key2 = array();
        $rest->sendPOST($table,$key2);

        //$this->assertEquals($queryTable, $resp, "ERROR inserting data");
    }

    public function testPut()
    {
        $msg = array( 'user'=>'admin' , 'password'=>'admin');
        $method = "login";

        $jsonm = new JsonMessage();
        $jsonm->send($method,$msg);
        //$jsonm->displayResponse();

        $xmlm = new XmlMessage();
        $xmlm->send($method, $msg);
        //$xmlm->displayResponse();

        $key = array( "440848627503b77c71a9637074444444", "359728002502a792a568a54012111111", "499115418502a795a0cfb43043666666", "XAMPLE", "913768259503b76894536b2095222222", "", "1", "VIEW");
        $table = "STEP";

        $rest = new RestMessage();
        $rest->sendPUT($table,$key);
        //$rest->displayResponse();

        $key1 = array("440848627503b77c71a9637074444444");
        $resp = $rest->sendGET($table,$key1);

        $queryTable = $this->getConnection()->createQueryTable(
            'STEP', 'SELECT * FROM STEP WHERE STEP_UID = "440848627503b77c71a9637074444444"'
        );

        $key2 = array("741973");
        $rest->sendGET($table,$key2);

        //$this->assertEquals($queryTable, $resp, "ERROR updating data");
    }

    public function testDelete()
    {
        $msg = array( 'user'=>'admin' , 'password'=>'admin');
        $method = "login";

        $jsonm = new JsonMessage();
        $jsonm->send($method,$msg);
        //$jsonm->displayResponse();

        $xmlm = new XmlMessage();
        $xmlm->send($method, $msg);
        //$xmlm->displayResponse();

        $key = array("440848627503b77c71a9637074444444");
        $table = "STEP";

        $rest = new RestMessage();
        $rest->sendDELETE($table,$key);
        //$rest->displayResponse();
        $resp = $rest->sendGET($table,$key);

        $queryTable = $this->getConnection()->createQueryTable(
            'STEP', 'SELECT * FROM STEP WHERE STEP_UID = "440848627503b77c71a9637074444444"'
        );

        $key2 = array("741973");
        $rest->sendGET($table,$key2);

        //$this->assertEquals($queryTable, $resp, "ERROR getting data");
    }
}

