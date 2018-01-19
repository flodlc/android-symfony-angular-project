import {Director} from "./director.model";
import {Category} from "./category.model";
import {Character} from "./character.model";

export class Film {
    constructor(public NoFilm?, public Titre?: string, public Duree?: string, public DateSortie?: Date,
                public Budget?: number, public MontantRecette?: number, public Realisateur?: Director,
                public Categorie?: Category, public Characters?: Character) {

    }
}