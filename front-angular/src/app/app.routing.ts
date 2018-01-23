import {Routes, RouterModule} from '@angular/router';
import {FilmsComponent} from "./films/films.component";
import {ActorsComponent} from "./actors/actors.component";
import {FilmComponent} from "./film/film.component";
import {ActorComponent} from "./actor/actor.component";
import {IndexComponent} from "./index/index.component";
import {ActorEditComponent} from "./actor-edit/actor-edit.component";
import {ActorAddComponent} from "./actor-add/actor-add.component";
import {FilmAddComponent} from "./film-add/film-add.component";
import {FilmEditComponent} from "./film-edit/film-edit.component";

const APP_ROUTES: Routes = [
    {path: 'index', component: IndexComponent},
    {path: 'films', component: FilmsComponent},
    {path: 'actors', component: ActorsComponent},
    {path: 'film/add', component: FilmAddComponent},
    {path: 'film/edit/:id', component: FilmEditComponent},
    {path: 'film/:id', component: FilmComponent},
    {path: 'actor/add', component: ActorAddComponent},
    {path: 'actor/edit/:id', component: ActorEditComponent},
    {path: 'actor/:id', component: ActorComponent},
    {path: '**', redirectTo: 'index'}
];

export const Routing = RouterModule.forRoot(APP_ROUTES, {useHash: true});