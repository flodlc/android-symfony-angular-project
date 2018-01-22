import {Component, Input, OnInit} from '@angular/core';
import {Film} from "../models/film.model";
import {ActivatedRoute, ParamMap} from "@angular/router";
import {FilmService} from "../services/film.service";

@Component({
  selector: 'app-film',
  templateUrl: './film.component.html',
  styleUrls: ['./film.component.css']
})
export class FilmComponent implements OnInit {
  film: Film;
  constructor(private route: ActivatedRoute, private filmServ: FilmService) { }

  ngOnInit() {
      this.route.paramMap
          .switchMap((params: ParamMap) => this.filmServ.getFilm(+params.get('id')))
          .subscribe(film => {
            this.film = film;
          })
  }

}
