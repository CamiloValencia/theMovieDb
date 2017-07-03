import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/do';
import { Actor } from './actor';

@Injectable()
export class ActorService {
    private _actorsurl = 'http://localhost:8000/actor/search/';
    constructor(private _http: Http) { }

    getactors(name: string, page: number): Observable<Actor[]> {
        return this._http.get(this._actorsurl+name+'/'+page)
            .map((response: Response) => <Actor[]>response.json().actors);
    }
} 