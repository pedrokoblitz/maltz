<?php

namespace Maltz\GeoLocation\Service;

use Maltz\Service\Curl;

class LocationConverter
{
    /**
     * /
     */
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * /
     * @param  [type] $zip [description]
     * @return [type]      [description]
     */
    public function zipCodeToCoordinates($zip)
    {

    }

    /**
     * /
     * @param  [type] $address [description]
     * @return [type]          [description]
     */
    public function addressToCoordinates($address)
    {

    }

    /**
     * /
     * @param  [type] $coordinates [description]
     * @return [type]              [description]
     */
    public function coordinatesToAdresss($coordinates)
    {

    }
}
