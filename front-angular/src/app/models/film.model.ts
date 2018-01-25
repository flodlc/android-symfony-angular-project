import {Director} from "./director.model";
import {Category} from "./category.model";
import {Character} from "./character.model";

export class Film {
    constructor(public id?, public title?: string, public duree?: number, public date?: String,
                public budget?: number, public montantRecette?: number, public realisateur?: Director,
                public categorie?: Category, public personnages?: Character[]) {
    }
}