import {Component, OnInit} from '@angular/core';
import {FilmService} from "../services/film.service";
import {Film} from "../models/film.model";

@Component({
    selector: 'app-films',
    templateUrl: './films.component.html',
    styleUrls: ['./films.component.css']
})
export class FilmsComponent implements OnInit {
    films: Film[];
    dataSearch: string = '';

    constructor(private filmServ: FilmService) {
    }

    ngOnInit() {
        this.filmServ.getFilms().subscribe(films => {
            this.films = films;
        });
    }

    setFilter() {

    }

}
