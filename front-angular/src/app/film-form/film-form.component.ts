import {Component, Input, OnInit} from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";
import {Actor} from "../models/actor.model";
import {Router} from "@angular/router";
import {ActorService} from "../services/actor.service";
import {Film} from "../models/film.model";
import {FilmService} from "../services/film.service";
import {Category} from "../models/category.model";
import {Director} from "../models/director.model";
import {Character} from "../models/character.model";

@Component({
    selector: 'app-film-form',
    templateUrl: './film-form.component.html',
    styleUrls: ['./film-form.component.css']
})
export class FilmFormComponent implements OnInit {
    FilmForm: FormGroup;
    @Input() film?: Film;
    categories: Category[];
    directors: Director[];

    constructor(private fb: FormBuilder, private filmServ: FilmService, private router: Router) {
    }

    ngOnInit() {
        this.filmServ.getCategories().subscribe(categories => {
            this.categories = categories;
        });
        this.filmServ.getDirectors().subscribe(directors => {
            this.directors = directors;
        });
        this.createForm(this.film);
        console.log(this.film.personnages);
    }

    createForm(film?: Film) {
        if (film)
            this.FilmForm = this.fb.group(film);
        else
            this.FilmForm = this.fb.group(new Film());
    }

    submit() {
        if (this.FilmForm.get('title').status == 'VALID' &&
            this.FilmForm.get('duree').status == 'VALID' &&
            this.FilmForm.get('budget').status == 'VALID' &&
            this.FilmForm.get('date').status == 'VALID' &&
            this.FilmForm.get('montantRecette').status == 'VALID' &&
            this.FilmForm.get('realisateur').status == 'VALID' &&
            this.FilmForm.get('categorie').status == 'VALID' &&
            this.FilmForm.get('personnages').status == 'VALID') {
            this.filmServ.postFilm(this.FilmForm.getRawValue()).subscribe(film => {
                this.router.navigate(['/film/' + film.id]);
            });
        }
    }

    whichOne(item1, item2){
        return item1.id == item2.id;
    }
}