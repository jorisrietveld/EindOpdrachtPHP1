<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 28-09-2016 13:49
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Controllers;


use JorisRietveld\Website\Interfaces\ControllerContract;
use Symfony\Component\HttpFoundation\Response;
use JorisRietveld\Website\Core\BaseController;

class Home extends BaseController implements ControllerContract
{
    public function index() : Response
    {
        $response = new Response();

        $response->setContent(
            $this->renderWebpage( 'home', [
                'hostname' => $_SERVER['REMOTE_ADDR'],
                'port' => $_SERVER['SERVER_PORT'],
                'color' => $this->getColor(),
            ]),
            200
        );

        return $response;
    }
}