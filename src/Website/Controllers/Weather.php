<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 06-10-2016 06:42
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Controllers;


use JorisRietveld\Website\Core\BaseController;
use JorisRietveld\Website\Helper\TemperatureConverter;
use JorisRietveld\Website\Helper\Translate;
use JorisRietveld\Website\Interfaces\ControllerContract;
use Symfony\Component\HttpFoundation\Response;
use JorisRietveld\Website\ThirdParty\Weather as WeatherApi;

class Weather extends BaseController implements ControllerContract
{
    protected $weatherString;

    /**
     * Handle the request and return an response.
     * @return Response
     */
    public function index()
    {
        return new Response(
            $this->renderWebpage(
                'weather',
                $this->getWeatherCondition()
            ),
            200
        );
    }

    /**
     * Function to parse the yahoo weather api information.
     * 
     * @return array
     */
    protected function getWeatherCondition(  )
    {
        $weather = new WeatherApi();
        $this->weatherString = $weather->getWeatherStringEmmen();

        $weatherParts = explode( ' ', trim( $this->weatherString ));
        $weatherString = implode( array_slice($weatherParts, 3), ' ');
        $weatherString = ( new Translate() )->translate( $weatherString );
        
        return [
            'weather_location' => $weatherParts[0],
            'weather_farhenheit' => round( $weatherParts[1], 2),
            'weather_celcius' => TemperatureConverter::fahrenheitToCelsius( (float)$weatherParts[1], 2 ),
            'weather_kelvin' => TemperatureConverter::FahrenheitToKelvin( (float)$weatherParts[1], 2 ),
            'weather_code' => $weatherParts[2],
            'weather_type' => $weatherString,
        ];
    }


}