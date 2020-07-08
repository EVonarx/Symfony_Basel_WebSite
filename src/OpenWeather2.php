
<?php

use Symfony\Component\HttpClient\HttpClient;

class OpenWeather2
{
    function getResult(): ?array
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://api.openweathermap.org/data/2.5/weather?q=Basel&APPID=a15539bece1d4d14d330c6e6cc4f7bad&units=metric&lang=en');

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();

        $parsed_json = json_decode($content);

        /*var_dump($parsed_json); */

        $temp = intval($parsed_json->{'main'}->{'temp'});
        $temp_min = intval($parsed_json->{'main'}->{'temp_min'});
        $temp_max = intval($parsed_json->{'main'}->{'temp_max'});
        $pressure = $parsed_json->{'main'}->{'pressure'};
        $humidity = $parsed_json->{'main'}->{'humidity'};
        $city = $parsed_json->{'name'};
        $country = $parsed_json->{'sys'}->{'country'};
        $icon = $parsed_json->{'weather'}[0]->{'icon'};
       
        $speed = $parsed_json->{'wind'}->{'speed'};
        $deg = $parsed_json->{'wind'}->{'deg'};
        setlocale(LC_ALL, 'en_US');
        $descrip = $parsed_json->{'weather'}[0]->{'description'};
        $dt = strftime('%A %d %B %Y');
        $time = strftime('%X');

        return [
            'temp' => $temp,
            'temp_min' => $temp_min,
            'temp_max' => $temp_max,
            'pressure' => $pressure,
            'humidity' => $humidity,
            'city' =>  $city,
            'country' => $country,
            'icon' => $icon,
            'descrip' => $descrip,
            'speed' => $speed,
            'deg' => $deg,
            'dt' => $dt,
            'time' => $time
        ];
    }
}
