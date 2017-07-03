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
 * Actor class define an actor entitiy 
 *
 * @author k_mil
 */
class Actor extends TMDbEntity {

    /**
     * Actor's id
     * @var int 
     */
    private $id;

    /**
     * Actor's name
     * @var string
     */
    private $name;

    /**
     * Constructor for class
     * @param int $id
     * @param string $name
     */
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        return $this;
    }

    /**
     * Return actor's id
     * @return int
     */
    function getId() {
        return $this->id;
    }

    /**
     * Returns actor's name
     * @return string
     */
    function getName() {
        return $this->name;
    }

    /**
     * set actor's id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * set actor's name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Find an actor by id
     * @param type $actor_id
     * @return boolean|\App\Actor
     */
    public static function find($actor_id) {
        $result = parent::getData('person/' . $actor_id);
        if (isset($result->status_code) && $result->status_code == 34) {
            return false;
        }
        return new Actor($result->id, $result->name);
    }

    /**
     * Get movies that actor appear
     * @param type $page
     * @return type
     */
    public function getMovies($page = 1) {
        $result = parent::getData('discover/movie', ["with_cast=$this->id", "page=$page", "sort_by=primary_release_date.asc"]);
        return $result;
    }

    /**
     * Return array representation of object
     * @return array
     */
    public function toArray() {
        return ['id' => $this->id, 'name' => $this->name];
    }

    /**
     * Search for an actor by actor's name
     * @param string $name
     * @param int $page
     * @return array
     */
    public static function search($name, $page = 1) {
        $result = parent::getData('search/person', ["query=$name", "page=$page"]);
        $actors = [];
        $actors_ids = [];
        foreach ($result->results as $actor) {
            if (!in_array($actor->id, $actors_ids)) {
                $actor = new Actor($actor->id, $actor->name);
                $actors[] = $actor->toArray();
                $actors_ids[] = $actor->id;
            }
        }
        return ['pages' => $result->total_pages, 'actors' => $actors];
    }

}
