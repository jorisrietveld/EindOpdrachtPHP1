<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 06-10-2016 06:38
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Controllers;


use JorisRietveld\Website\Core\BaseController;
use JorisRietveld\Website\Interfaces\ControllerContract;
use Symfony\Component\HttpFoundation\Response;

class Contact extends BaseController implements ControllerContract
{
    protected $messageArchive = '/dev/null';

    public function index( $messages = '' )
    {
        return new Response(
            $this->renderWebpage( 'contact', [
                'message' => $messages,
                'color' => $this->getColor(),
            ]),
            200
        );
    }

    public function handle()
    {
        $message = implode( ',', $_POST );
        $this->archiveMessage( $message );
        return $this->index( '<h3 style="color: green">Je bericht is gearchiveerd in <code>/dev/null</code></h3>' );
    }

    public function archiveMessage( string $message ): bool
    {
        if ( ($filePointer = fopen( $this->messageArchive, "w") ) == TRUE )
        {
            fwrite( $filePointer, $message );
            fclose($filePointer);
            return TRUE;
        }
        return FALSE;
    }
}