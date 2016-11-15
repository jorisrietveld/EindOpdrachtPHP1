<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-09-2016 20:17
 */
declare(strict_types = 1);

namespace Website\tests;


use JorisRietveld\Website\Core\ParameterContainer;

class TestTest extends \PHPUnit_Framework_TestCase
{
    protected $parametherContainer;

    public function setUp()
    {
        $this->parametherContainer = new ParameterContainer(  );
    }

    public function testParameterContainerHasNot()
    {
        $this->parametherContainer->set( [ [ 'key1' => 'value1' ] ] );
        $this->assertFalse( $this->parametherContainer->has('boom'), 'Should return false' );
    }

    public function testParameterContainerHas()
    {
        $this->parametherContainer->set( [ 'key1' => 'value1' ] );
        $this->assertTrue( $this->parametherContainer->has( 'key1' ), 'Should return true' );
    }

    public function test()
    {
        
    }
}
