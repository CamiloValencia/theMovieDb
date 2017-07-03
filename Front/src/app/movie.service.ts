import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/do';
import { MovieList } from './movielist';

@Injectable()
export class MovieService {
    private _moviesurl = 'http://localhost:8000/actor/movies/';
    constructor(private _http: Http) { }

    getMovies(name: string, page: number): Observable<MovieList> {
        return this._http.get(this._moviesurl+name+'/'+page)
            .map((response: Response) => <MovieList>response.json());
    }
} 