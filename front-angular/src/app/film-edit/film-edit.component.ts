import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {Film} from "../models/film.model";
import {FilmService} from "../services/film.service";

@Component({
  selector: 'app-film-edit',
  templateUrl: './film-edit.component.html',
  styleUrls: ['./film-edit.component.css']
})
export class FilmEditComponent implements OnInit {
    film: Film;
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