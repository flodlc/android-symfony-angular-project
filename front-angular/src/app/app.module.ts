import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {Routing} from './app.routing';


import {AppComponent} from './app.component';
import {FilmsComponent} from './films/films.component';
import {ActorsComponent} from './actors/actors.component';
import {FilmComponent} from './film/film.component';
import {ActorComponent} from './actor/actor.component';
import { IndexComponent } from './index/index.component';
import {FilmService} from "./services/film.service";
import {ActorService} from "./services/actor.service";
import {HttpClientModule} from "@angular/common/http";


@NgModule({
    declarations: [
        AppComponent,
        FilmsComponent,
        ActorsComponent,
        FilmComponent,
        ActorComponent,
        IndexComponent
    ],
    imports: [
        BrowserModule,
        Routing,
        HttpClientModule
    ],
    providers: [FilmService, ActorService],
    bootstrap: [AppComponent]
})
export class AppModule {
}
