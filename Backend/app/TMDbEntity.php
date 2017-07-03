<?php

/*
 * Copyright (C) 2017 k_mil
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App;

/**
 * Class to connect TMDb API and get JSON result
 *
 * @author k_mil
 */
class TMDbEntity {

    /**
     * API KEY to connect TMDb API
     */
    const API_KEY = '7cc62f880c5c14600382226b13b27b0c';

    /**
     * API URL
     */
    const API_URL = 'http://api.themoviedb.org/3';

    /**
     * Get data from The Movies Data Base 
     * @param string $path path to get the info
     * @param array $parameters 
     * @return type
     */
    public static function getData($path, $parameters = []) {
        $url = self::API_URL . '/' . $path . '?api_key=' . self::API_KEY . '&' . implode('&', $parameters);
        $json = file_get_contents($url);
        $result = json_decode($json);
        return $result;
    }

}
