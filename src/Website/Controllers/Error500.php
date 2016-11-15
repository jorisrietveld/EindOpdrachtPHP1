<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 21-10-2016 23:52
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */

namespace JorisRietveld\Website\Controllers;


use JorisRietveld\Website\Core\BaseController;
use JorisRietveld\Website\Interfaces\ControllerContract;
use Symfony\Component\HttpFoundation\Response;

class Error500 extends BaseController implements ControllerContract 
{
    public function index()
    {
        return new Response(
            $this->renderWebpage( 'error500' ),
            500
        );
    }

}