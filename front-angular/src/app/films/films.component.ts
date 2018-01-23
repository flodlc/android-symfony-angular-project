import {Component, OnInit} from '@angular/core';
import {FilmService} from "../services/film.service";
import {Film} from "../models/film.model";
import * as _ from "lodash";

@Component({
    selector: 'app-films',
    templateUrl: './films.component.html',
    styleUrls: ['./films.component.css']
})
export class FilmsComponent implements OnInit {
    films_all: Film[];
    films: Film[];
    dataSearch: string = '';

    constructor(private filmServ: FilmService) {
    }

    ngOnInit() {
        this.filmServ.getFilms().subscribe(films => {
            this.films_all = films;
            this.films = films;
        });
    }

    setFilter() {
        this.films = _.filter(this.films_all, function (o) {
            let reg = new RegExp(this.dataSearch, "i");
            return (reg.test(o.title) || reg.test(o.categorie.libelleCat) || reg.test(o.realisateur.prenom) || reg.test(o.realisateur.name));
        }.bind(this));
    }

    delete(id) {
        this.filmServ.delete(id).subscribe(data => {
            this.films_all = _.filter(this.films_all, function (o) {
                let reg = new RegExp(id, "i");
                return (!reg.test(o.id));
            }.bind(this));
            this.films = this.films_all;
            this.dataSearch = "";
        })
    }

}
