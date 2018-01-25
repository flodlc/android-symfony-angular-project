import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {Actor} from "../models/actor.model";
import {ActorService} from "../services/actor.service";
import {Film} from "../models/film.model";

@Component({
    selector: 'app-actor',
    templateUrl: './actor.component.html',
    styleUrls: ['./actor.component.css']
})
export class ActorComponent implements OnInit {
    actor: Actor;
    films: Film[];
    id;
    private sub: any;

    constructor(private route: ActivatedRoute, private actorServ: ActorService) {
    }

    ngOnInit() {
        this.sub = this.route.params.subscribe(params => {
            this.actorServ.getActor(+params['id']).subscribe(actor => {
                this.actor = actor;
                if (this.actor.dateDeces == "30/11/-1" || this.actor.dateDeces == "30/11/-0001") {
                    this.actor.dateDeces = "";
                }
                this.actorServ.getActorFilms(+params['id']).subscribe(films => {
                        this.films = films;
                    }
                )
            });
        });

    }

}