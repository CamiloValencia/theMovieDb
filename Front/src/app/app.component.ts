import { Component, Output} from '@angular/core';
import { Actor } from './actor';
import { Movie } from './movie';
import { MovieList } from './movielist';
import { ActorService } from './actor.service';
import { MovieService } from './movie.service';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';

@Component({
    selector: 'my-app',
    templateUrl: 'app/app.component.html',
    providers: [ActorService]
})
export class AppComponent {     
    appTitle: string = 'Movies searching by Actor';
    searchVal: string = '';
    currentActor: number = 0;
    currentMoviesPage: number = 1;
    moviesPages: number = 0;
    actors: Actor[];
    movies: Movie[];
    constructor(private _actor: ActorService, private _movie: ActorService) {
    }
    actorSearch(event: any): void {
        this._actor.getactors(this.searchVal, 1)
            .subscribe(actors => this.actors = actors);
    }
    loadMovies(event: any): void {
        event.preventDefault();
        this._movie.getMovies(event.target.getAttribute("href"), this.currentMoviesPage)
            .subscribe(movieList => { this.movies = movieList.results, this.moviesPages = movieList.total_pages });
    }
}
