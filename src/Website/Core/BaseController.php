<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 17-09-2016 12:12
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Core;


use JorisRietveld\Website\ThirdParty\Weather;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use JorisRietveld\Website\Helper\TemperatureConverter;

abstract class BaseController
{
    protected $twigEnv;

    public function __construct()
    {
        $twigLoader = new \Twig_Loader_Filesystem( RESOURCES_DIR . 'twig' . DIRECTORY_SEPARATOR );
        $this->twigEnv = new \Twig_Environment( $twigLoader );
    }

    /**
     * @param $fileName
     * @return string
     */
    public function loadedTemplate( $fileName )
    {
        $templateFile = RESOURCES_DIR . 'views' . DIRECTORY_SEPARATOR . $fileName;

        if( file_exists( $templateFile ))
        {
            return file_get_contents( $templateFile );
        }
        throw new FileNotFoundException('The template file:' . $fileName . ' is not found!');
    }

    public function getConfiguration( $for )
    {
        $config = new ConfigLoader();
        return $config->get($for);
    }

    public function renderWebpage( string $webpageName, array $context = [] )
    {
        return $this->twigEnv->render( $webpageName.'.html.twig', $context );
    }

    public function getColor(  )
    {
        $weather = new Weather();
        $weatherString = $weather->getWeatherStringEmmen();

        $weatherParts = explode( ' ', trim( $weatherString ));

        $weatherCelsius = TemperatureConverter::fahrenheitToCelsius( (float)$weatherParts[1] );

        $blackBodyColors = [
            '#ff0000',
            '#FF7A00',
            '#FFE5CE',
            '#ffffff',
            '#e2e8ff',
            '#0000ff'
        ];

        switch ( true ):
            case $weatherCelsius >= 30:
                return $blackBodyColors[0];

            case $weatherCelsius >= 15 && $weatherCelsius < 30:
                return $blackBodyColors[1];

            case $weatherCelsius > 0 && $weatherCelsius < 15:
                return $blackBodyColors[2];

            case $weatherCelsius == 0:
                return $blackBodyColors[3];

            case $weatherCelsius < 0 && $weatherCelsius >= -10:
                return $blackBodyColors[4];

            case $weatherCelsius < 10:
                return $blackBodyColors[5];

            default:
                return $blackBodyColors[0];
        endswitch;
    }
}