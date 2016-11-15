<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 01-10-2016 01:00
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Exceptions;


class DirectoryNotFoundException extends \Exception
{
    public function __construct( $message = '', $code = 0, \Exception $previous = NULL )
    {
        parent::__construct( $message, $code, $previous );
    }
}