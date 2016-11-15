<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 06-10-2016 06:37
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Controllers;


use JorisRietveld\Website\Core\BaseController;
use JorisRietveld\Website\Interfaces\ControllerContract;
use Symfony\Component\HttpFoundation\Response;

class Interests extends BaseController implements ControllerContract
{
    public function index()
    {
        return new Response(
            $this->renderWebpage( 'intrests', [
                'color' => $this->getColor(),
            ]),
            200
        );
    }
}