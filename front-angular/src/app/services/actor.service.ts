import {Injectable} from '@angular/core';
import {Observable} from 'rxjs/Rx';
import 'rxjs/add/operator/map';
import {HttpClient} from "@angular/common/http";
import {Actor} from "../models/actor.model";
import {environment} from "../../environments/environment";
import {Film} from "../models/film.model";

@Injectable()
export class ActorService {

    constructor(private http: HttpClient) {}

    getActors(): Observable<Actor[]> {
        const url = environment.apiUrl + 'acteurs';
        return this.http.get(url).map(actors => actors as Actor[]);
    }

    getActor(id: number): Observable<Actor> {
        const url = environment.apiUrl + 'acteur/' + id;
        return this.http.get(url).map(actor => actor as Actor);
    }

    getActorFilms(id: number): Observable<Film[]> {
        const url = environment.apiUrl + 'acteur/' + id + '/films';
        return this.http.get(url).map(films => films as Film[]);
    }

    delete(id: number) {
        const url = environment.apiUrl + 'acteur/' + id;
        return this.http.delete(url);
    }

    postActor(actor: Actor): Observable<Actor> {
        if (actor.dateDeces == null)
            actor.dateDeces = "null";
        const url = environment.apiUrl + 'acteur';
        return this.http.post(url, actor);
    }
}