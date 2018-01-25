import {Component, OnInit} from '@angular/core';
import {Film} from "../models/film.model";
import {ActivatedRoute} from "@angular/router";
import {FilmService} from "../services/film.service";

@Component({
    selector: 'app-film',
    templateUrl: './film.component.html',
    styleUrls: ['./film.component.css']
})
export class FilmComponent implements OnInit {
    film: Film;
    id;
    private sub: any;

    constructor(private route: ActivatedRoute, private filmServ: FilmService) {
    }

    ngOnInit() {
        this.sub = this.route.params.subscribe(params => {
            this.filmServ.getFilm(+params['id']).subscribe(film => {
                this.film = film;
            });
        });

    }

}
