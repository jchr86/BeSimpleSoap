<?php

/*
 * This file is part of the BeSimpleSoapBundle.
 *
 * (c) Christian Kerl <christian-kerl@web.de>
 * (c) Francis Besset <francis.besset@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace BeSimple\Tests\SoapClient\Soap;

use BeSimple\SoapClient\Soap\SoapClient;

class SoapClientTest extends \PHPUnit_Framework_TestCase
{
    public function testSetOptions()
    {
        $soapClient = new SoapClient('foo.wsdl');
        $options = array(
            'cache_dir' => '/tmp',
            'debug'     => true,
        );
        $soapClient->setOptions($options);

        $this->assertEquals($options, $soapClient->getOptions());
    }

    public function testSetOptionsThrowsAnExceptionIfOptionsDoesNotExists()
    {
        $soapClient = new SoapClient('foo.wsdl');

        $this->setExpectedException('InvalidArgumentException');
        $soapClient->setOptions(array('bad_option' => true));
    }

    public function testSetOption()
    {
        $soapClient = new SoapClient('foo.wsdl');
        $soapClient->setOption('debug', true);

        $this->assertEquals(true, $soapClient->getOption('debug'));
    }

    public function testSetOptionThrowsAnExceptionIfOptionDoesNotExists()
    {
        $soapClient = new SoapClient('foo.wsdl');

        $this->setExpectedException('InvalidArgumentException');
        $soapClient->setOption('bad_option', 'bar');
    }

    public function testGetOptionThrowsAnExceptionIfOptionDoesNotExists()
    {
        $soapClient = new SoapClient('foo.wsdl');

        $this->setExpectedException('InvalidArgumentException');
        $soapClient->getOption('bad_option');
    }

    public function testGetSoapOptions()
    {
        $soapClient = new SoapClient('foo.wsdl', array('debug' => true));

        $this->assertEquals(array('cache_wsdl' => WSDL_CACHE_NONE, 'trace' => true), $soapClient->getSoapOptions());
    }

    public function testGetNativeSoapClient()
    {
        $soapClient = new SoapClient(__DIR__.'/Fixtures/foobar.wsdl', array('debug' => true));

        $this->assertInstanceOf('SoapClient', $soapClient->getNativeSoapClient());
    }
}