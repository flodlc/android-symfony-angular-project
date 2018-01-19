import {Injectable} from '@angular/core';
import {Observable} from 'rxjs/Rx';
import 'rxjs/add/operator/map';
import {HttpClient} from "@angular/common/http";
import {Film} from "../models/film.model";

@Injectable()
export class FilmService {

    constructor(private http: HttpClient) {}

    getFilms(): Observable<Film[]> {
        const url = `/films/`;
        return this.http.get(url).map(films => films as Film[]);
    }

    getFilm(id: number): Observable<Film> {
        const url = `/film/` + id;
        return this.http.get(url).map(film => film as Film);
    }
}