<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 30-09-2016 21:13
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Controllers;


use JorisRietveld\Website\Core\BaseController;
use JorisRietveld\Website\Interfaces\ControllerContract;
use Symfony\Component\HttpFoundation\Response;

class Error404 extends BaseController implements ControllerContract
{
    public function index()
    {
        return new Response(
            $this->renderWebpage( 'error404' ),
            404
        );
    }
}