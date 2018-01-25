import {Injectable} from '@angular/core';
import {Observable} from 'rxjs/Rx';
import 'rxjs/add/operator/map';
import {HttpClient} from "@angular/common/http";
import {Film} from "../models/film.model";
import {environment} from "../../environments/environment";
import {Category} from "../models/category.model";
import {Director} from "../models/director.model";

@Injectable()
export class FilmService {

    constructor(private http: HttpClient) {}

    getFilms(): Observable<Film[]> {
        const url = environment.apiUrl + 'films';
        return this.http.get(url).map(films => films as Film[]);
    }

    getCategories(): Observable<Category[]> {
        const url = environment.apiUrl + 'categories';
        return this.http.get(url).map(categories => categories as Category[]);
    }

    getDirectors(): Observable<Director[]> {
        const url = environment.apiUrl + 'realisateurs';
        return this.http.get(url).map(directors => directors as Director[]);
    }

    getFilm(id: number): Observable<Film> {
        const url = environment.apiUrl + 'film/' + id;
        return this.http.get(url).map(film => film as Film);
    }

    delete(id: number) {
        const url = environment.apiUrl + 'film/' + id;
        return this.http.delete(url);
    }

    postFilm(film: Film): Observable<Film> {
        const url = environment.apiUrl + 'film';
        if (film.personnages === null)
            film.personnages = [];
        if (film.personnages.length === undefined)
            film.personnages = [film.personnages];
        return this.http.post(url, film);
    }
}