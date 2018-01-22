import { Component, OnInit } from '@angular/core';
import {ActorService} from "../services/actor.service";
import {Actor} from "../models/actor.model";
import {ACTORS} from "../mock-actors";

@Component({
  selector: 'app-actors',
  templateUrl: './actors.component.html',
  styleUrls: ['./actors.component.css']
})
export class ActorsComponent implements OnInit {
    actors: Actor[];
    dataSearch: string = '';

    constructor(private actorServ: ActorService) {
    }

    ngOnInit() {
        /*this.actorServ.getActors().subscribe(actors => {
            this.actors = actors;
        });*/
        this.actors = ACTORS;
    }

    setFilter() {

    }

}