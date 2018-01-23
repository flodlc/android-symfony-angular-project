import {Component, Input, OnInit} from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";
import {Actor} from "../models/actor.model";
import {Router} from "@angular/router";
import {ActorService} from "../services/actor.service";
import {Film} from "../models/film.model";
import {FilmService} from "../services/film.service";

@Component({
  selector: 'app-film-form',
  templateUrl: './film-form.component.html',
  styleUrls: ['./film-form.component.css']
})
export class FilmFormComponent implements OnInit {
    FilmForm: FormGroup;
    @Input() film?: Film;

    constructor(private fb: FormBuilder, private filmServ: FilmService, private router: Router) {
    }

    ngOnInit() {
        this.createForm(this.film);
    }

    createForm(actor?: Actor) {
        if (actor)
            this.FilmForm = this.fb.group(actor);
        else
            this.FilmForm = this.fb.group(new Film());
    }

    submit() {
        if (this.FilmForm.get('nom').status == 'VALID') {
            this.filmServ.postFilm(this.FilmForm.getRawValue()).subscribe(film => {
                this.router.navigate(['/film/' + film.id]);
            });
        }
    }
}