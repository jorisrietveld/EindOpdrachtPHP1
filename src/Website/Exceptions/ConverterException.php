<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 23-09-2016 12:45
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Exceptions;


class ConverterException extends \Exception
{
    public function __construct($message, $code, \Exception $previous, $data = '' )
    {
        parent::__construct($message, $code, $previous);
    }
}