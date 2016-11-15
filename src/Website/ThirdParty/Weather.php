<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-09-2016 14:11
 */

namespace JorisRietveld\Website\ThirdParty;

class Weather
{
    public function getWeatherStringEmmen()
    {
        $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
        $yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="Emmen, NL")';
        $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=xml";

        $reader = new \XMLReader();
        $tempLocation = 0;
        $tempText = '';
        $tempCode = '';
        $location = '';

        if (!$reader->open($yql_query_url)) {
            print "can't read link";
        }

        while ($reader->read()) {
            if ($reader->nodeType == \XMLReader::ELEMENT) {
                $name = $reader->name;

                if ($name == 'yweather:location') {
                    $location = $reader->getAttribute('city');
                }

                if ($name == 'yweather:condition') {
                    $tempText = $reader->getAttribute('text');
                    $tempCode = $reader->getAttribute('code');
                    $tempLocation = $reader->getAttribute('temp');
                }
            }

            if (in_array($reader->nodeType, array(
                    \XMLReader::TEXT,
                    \XMLReader::CDATA,
                    \XMLReader::WHITESPACE,
                    \XMLReader::SIGNIFICANT_WHITESPACE
                )) && $name != ''
            ) {
                $value = $reader->value;
            }
        }
        $tempCode =36;
        $tempText  = "Trolo LOL";
        return $location . " " . $tempLocation . " " . $tempCode . " " . $tempText;
    }
}