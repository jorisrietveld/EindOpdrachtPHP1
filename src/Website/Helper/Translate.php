<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 08-10-2016 23:03
 * Licence: GNU General Public Licence version 3 <https://www.gnu.org/licenses/gpl-3.0.html>
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Helper;


use JorisRietveld\Website\Core\ConfigLoader;

class Translate
{
    protected $config;
    protected $sentence;
    protected $translateFromTo;

    public function __construct()
    {
        $this->config = ( new ConfigLoader() )->get( 'translate' );
        $this->translateFromTo = 'en-nl';
    }

    /**
     * Make an call to the api to translate the sentence
     *
     * @param string $sentence
     * @return mixed
     */
    protected function makeCall( )
    {
        $handle = curl_init( $this->generateUrl() );

        // Set the return transfer to output to an variable.
        curl_setopt( $handle, CURLOPT_RETURNTRANSFER, TRUE );

        // Execute the call.
        $result = curl_exec( $handle );
        curl_close( $handle );

        return json_decode( $result, TRUE );
    }

    /**
     * Generate the url that will be called.
     *
     * @param string $translateSentence
     * @return string
     */
    protected function generateUrl( )
    {
        return $this->config->{'url'} . '?'.
            'key=' . $this->config->{'api-key'} .
            '&text=' . $this->getSentence() .
            '&lang=' . $this->getTranslateFromTo();
    }

    /**
     * Trans late an sentence from english to dutch.
     *
     * @param string $sentence
     * @return string
     */
    public function translate( string $sentence, string $fromLang = 'en', string $toLang = 'nl' )
    {
        $this->setTranslateFromTo( $fromLang, $toLang );
        $this->setSentence( $sentence );

        $response = $this->makeCall( $sentence );
        return ($response) ? $response['text'][0] : '';
    }

    /**
     * @return mixed
     */
    public function getSentence()
    {
        return $this->sentence;
    }

    /**
     * @param mixed $sentence
     * @return Translate
     */
    public function setSentence($sentence)
    {
        $this->sentence = $sentence;
        return $this;
    }

    /**
     * @return string
     */
    public function getTranslateFromTo()
    {
        return $this->translateFromTo;
    }

    /**
     * @param string $translateFromTo
     * @return Translate
     */
    public function setTranslateFromTo( string $from, string $to )
    {
        $this->translateFromTo = $from . '-' . $to;
        return $this;
    }


}