<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-09-2016 14:19
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Core;


class HttpResponse
{

    const HTTP_CODE_OK = 200;
    const HTTP_CODE_NOT_FOUND = 404;
    const HTTP_CODE_INTERNAL_SERVER_ERROR = 500;
    const HTTP_CODE_I_AM_AN_TEAPOT = 418;

    private $queryContainer;
    private $postContainer;
    private $cookieContainer;
    private $headerContainer;
    private $body;

    public function __construct( $body = '', $httpCode = self::HTTP_CODE_OK, $headers = [] )
    {
        // todo: implement an header wrapper class.
        $this->body = $body;
    }

    public function prepare( HttpRequest $request )
    {
        
    }

    public function sendHeaders()
    {
        
    }

    public function sendBody()
    {
        echo $this->body;
        return $this;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendBody();
    }
}