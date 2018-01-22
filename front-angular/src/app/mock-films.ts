import {Film} from "./models/film.model";
import {Director} from "./models/director.model";
import {Category} from "./models/category.model";

export const FILMS: Film[] = [
    {NoFilm: 1, Titre: 'LÃ©on', Duree: 110, DateSortie: '1994-04-14', Budget: 17531000, MontantRecette: 69250000,
        Realisateur: new Director(3, 'Besson', 'Luc'), Categorie: new Category('PO', 'Policier')},

    {NoFilm: 2, Titre: 'Cash', Duree: 100, DateSortie: '2008-04-23', Budget: 18340000, MontantRecette: 60340000,
        Realisateur: new Director(4, 'Besnard', 'Eric'), Categorie: new Category('PO', 'Policier')},

    {NoFilm: 3, Titre: 'La grande vadrouille', Duree: 132, DateSortie: '1966-12-01', Budget: 7227000, MontantRecette: 51258000,
        Realisateur: new Director(2, 'Chabrol', 'Claude'), Categorie: new Category('AC', 'Action')},

    {NoFilm: 4, Titre: 'Subway', Duree: 104, DateSortie: '1985-04-10', Budget: 10567000, MontantRecette: 70500000,
        Realisateur: new Director(3, 'Besson', 'Luc'), Categorie: new Category('PO', 'Policier')}
];