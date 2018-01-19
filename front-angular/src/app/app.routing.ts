import {Routes, RouterModule} from '@angular/router';
import {FilmsComponent} from "./films/films.component";
import {ActorsComponent} from "./actors/actors.component";
import {FilmComponent} from "./film/film.component";
import {ActorComponent} from "./actor/actor.component";
import {IndexComponent} from "./index/index.component";

const APP_ROUTES: Routes = [
    {path: 'index', component: IndexComponent},
    {path: 'films', component: FilmsComponent},
    {path: 'actors', component: ActorsComponent},
    {path: 'film/:id', component: FilmComponent},
    {path: 'actor/:id', component: ActorComponent},
    {path: '**', redirectTo: 'index'}
];

export const Routing = RouterModule.forRoot(APP_ROUTES, {useHash: true});