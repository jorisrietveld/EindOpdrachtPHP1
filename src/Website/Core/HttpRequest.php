<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-09-2016 14:19
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Core;


class HttpRequest
{
    private $query;
    private $post;
    private $attributes;
    private $cookies;
    private $server;
    private $headers;
    private $files;
    private $body;

    private $requestMethod;
    private $requestUrl;


    public function __construct( array $query = [], array $post = [], $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = NULL  )
    {
        $this->initialize( $query, $post, $attributes, $cookies, $files, $server, $content );
    }

    public function initialize( array $query = [], array $post = [], $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = NULL  )
    {
        $this->query = new ParameterContainer( $query );
        $this->post = new ParameterContainer( $post );
        $this->attributes = new ParameterContainer( $attributes );
        $this->cookies = new ParameterContainer( $cookies ); // todo: write an wrapper for the cookies and sessions.
        $this->server = new ParameterContainer( $server ); // todo: write an wrapper for the server.
        $this->body = $content;
        $this->headers; // todo write header wrapper;
        $this->files = new ParameterContainer( $files ); // todo: write an wrapper for the files.

        $this->requestMethod;

    }

    public static function createFromGlobals() : self
    {
        return new self( $_GET, $_POST, $_REQUEST, $_COOKIE, $_FILES, $_SERVER, ob_get_contents());
    }

}