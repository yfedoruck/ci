<?php

/**
 * Class EgtControllerTest
 *
 * @property Egt_api $egt_api
 * @property SourceXml $Source
 */
class EgtTest extends CITestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->CI->load->model('egt/online/egt_api');
        $this->CI->load->model('common/sourcexml', 'Source');
        $this->egt_api = $this->CI->egt_api;
    }

    public function estAuthenticate()
    {
        $src = new SourceXml();
        $src->setXml($this->request('Auth'));
        $this->egt_api->setEgtData($src->parseXmlInt());
        $this->egt_api->run();
        $xml = $this->egt_api->getResponse()->asXml();
        $obj = new SimpleXMLElement($xml);
        $this->assertEquals((string)$obj->getName(), 'AuthResponse');
        $this->assertEquals((string)$obj->ErrorCode, '1000');
        $this->assertEquals((string)$obj->ErrorMessage, 'OK');
    }

    public function testGetPlayerBalance()
    {
        $src = new SourceXml();
        $src->setXml($this->request('GetPlayerBalance'));
        $this->egt_api->setEgtData($src->parseXmlInt());
        $this->egt_api->run();
        $xml = $this->egt_api->getResponse()->asXml();
        $obj = new SimpleXMLElement($xml);
        $this->assertEquals((string)$obj->getName(), 'GetPlayerBalanceResponse');
        $this->assertEquals((string)$obj->Balance, '251.01');
        $this->assertEquals((string)$obj->ErrorCode, '1000');
        $this->assertEquals((string)$obj->ErrorMessage, 'OK');
    }

    public function estWithdraw()
    {
        $src = new SourceXml();
//        $src->setXml($this->request('Withdraw'));
        $src->setXml($this->requestWithdraw());
        $this->egt_api->setEgtData($src->parseXmlInt());
        $this->egt_api->run();
        $xml = $this->egt_api->getResponse()->asXml();
//        var_dump($xml); die('qwe');
        $obj = new SimpleXMLElement($xml);
        $this->assertEquals((string)$obj->getName(), 'WithdrawResponse');
        $this->assertEquals((string)$obj->Balance, '251.01');
        $this->assertEquals((string)$obj->ErrorCode, '1000');
        $this->assertEquals((string)$obj->ErrorMessage, 'OK');
    }

    public function request($name)
    {
        // if change PlayerId, then generate and change DefenceCode too.
//        $playerId = 1452985; // my
//        $playerId = 1452325;
        $playerId = 1452325; // 1452324 : aa0ce403c5b1b9eeea9395afcd8b9170-1465466123
        $func = new Egt_func();
        $defenceCode = $func->generateDefenceCode($playerId);
        return
            '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
                    <'.$name.'Request>
                        <UserName>test_user</UserName>
                        <Password>test_pass</Password>
                        <PlayerId>'.$playerId.'</PlayerId>
                        <DefenceCode>'.$defenceCode.'</DefenceCode>
                        <PortalCode>SomeOperatorId_EUR</PortalCode>
                        <SessionId>364e6b3945a0a5614867b6556d791cb0</SessionId>
                    </'.$name.'Request>';
    }

    public function requestWithdraw()
    {
        // if change PlayerId, then generate and change DefenceCode too.
        $playerId = 1452325; // 1452325; 1452985;
        $amount = 1;
        $currency = 'UAH';
        return
            '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'.'
                <WithdrawRequest>
                    <UserName>test_user</UserName>
                    <Password>test_pass</Password>
                    <PlayerId>'.$playerId.'</PlayerId>
                    <TransferId>3cd60e3d-39ae-433f-9f27-348221bf0641</TransferId>
                    <GameId>801</GameId>
                    <GameNumber>1156498407425</GameNumber>
                    <SessionId>364e6b3945a0a5614867b6556d791cb0</SessionId>
                    <Amount>'.$amount.'</Amount>
                    <Currency>'.$currency.'</Currency>
                    <Reason>ROUND_BEGIN</Reason>
                    <PortalCode>SomeOperatorId_EUR</PortalCode>
                </WithdrawRequest>';
    }
}