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

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;

/**
 * Actor controller
 */
class ActorController extends Controller {

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search($name, $page) {
        return response()->json(Actor::search($name, $page));
    }
    
    public function movies($actor_id){
        return response()->json(Actor::find($actor_id)->getMovies());        
    }

}
