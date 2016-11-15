<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-09-2016 14:19
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Core;


class ParameterContainer implements \IteratorAggregate, \Countable
{
    private $parameters;

    /**
     * ParameterContainer constructor.
     * @param array $array
     */
    public function __construct( array $array = [] )
    {
        $this->parameters = $array;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has( $key )
    {
        return array_key_exists( $key, $this->parameters );
    }

    /**
     * This method returns an parameter if is exists otherwise it returns the default value.
     *
     * @param $key
     * @param null $default
     * @return array|null
     */
    public function get( $key, $default = null )
    {
        return array_key_exists( $key, $this->parameters ) ? $this->parameters[ $key ] : $default;
    }


    public function set( array $parameters = [] )
    {
        $this->parameters = $parameters;
    }

    public function add( array $parameters = [] )
    {
        $this->parameters = array_replace( $this->parameters, $parameters );
    }

    /**
     * This method deletes an parameter
     *
     * @param $key
     */
    public function delete( $key )
    {
        unset( $this->parameters[$key] );
    }

    /**
     * Return all parameters
     *
     * @return array
     */
    public function all()
    {
        return $this->parameters;
    }

    /**
     * Method for using this class in an foreach loop.
     *
     * @return \ArrayIterator
     */
    public function getIterator(  )
    {
        return new \ArrayIterator( $this->parameters );
    }

    /**
     * @return int
     */
    public function count()
    {
        return count( $this->parameters );
    }
}