<?php

namespace App\Http\Controllers;

class GoogleController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
//
//
//        /**
//         * Get distance matrix response
//         */
//        $d['a'] = \GoogleMaps::load('distancematrix')
//
//            ->setParamByKey('origins', 'Vancouver+BC|Seattle')
//            ->setParamByKey('destinations', 'San Francisco|Victoria BC')
//            ->get();
//
//        /**
//         * Obtain elements parametrs from response
//         */
//        $d['b'] = \GoogleMaps::load('distancematrix')
//            ->setParam([
//                'origins'       => ['Vancouver BC', 'Seattle'],
//                'destinations'  => ['San Francisco','Victoria BC'],
//                'mode' => 'bicycling',
//                'language' => 'GB'
//            ])
//            ->getResponseByKey('rows.elements');
//
//        dd($d);

//        $response = \GoogleMaps::load('geocoding')
//            ->setParam (['address' =>'2910 SW 66 Ter, Miramar, FL, 33023'])
//            ->setParam (['address' =>'319 sw 11 ave apt 1 Miami, 33130'])
//            ->setParam (['address' =>'8325 ne 2 ave, miami,fl, 33138'])
//            ->get();
        //"lat" : 25.9842029802915,\n
//"lng" : -80.21676801970848\n

//"lat" : 25.851801,\n
//"lng" : -80.1925677\n

        $response = \GoogleMaps::load('distancematrix')
            ->setParam(['origins' => '25.9842029802915,-80.21676801970848'])
            ->setParam(['destinations' => '25.851801,-80.1925677'])
            ->get();

        echo $this->distanceCalculation('25.9842029802915', '-80.21676801970848', '25.851801', '-80.1925677', 'km');
        echo "</br>";
        echo $this->distance('25.9842029802915', '-80.21676801970848', '25.851801', '-80.1925677', 'k');

        dd($response);

    }

    function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2)
    {
        // Cálculo de la distancia en grados
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat)) * sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat)) * cos(deg2rad($point2_lat)) * cos(deg2rad($point1_long - $point2_long)))));

        // Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
        switch ($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
                break;
            case 'nmi':
                $distance = $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
        }
        return round($distance, $decimals);
    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}
