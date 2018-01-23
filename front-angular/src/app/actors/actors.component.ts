import { Component, OnInit } from '@angular/core';
import {ActorService} from "../services/actor.service";
import {Actor} from "../models/actor.model";
import * as _ from "lodash";

@Component({
  selector: 'app-actors',
  templateUrl: './actors.component.html',
  styleUrls: ['./actors.component.css']
})
export class ActorsComponent implements OnInit {
    actors: Actor[];
    actors_all: Actor[];
    dataSearch: string = '';

    constructor(private actorServ: ActorService) {
    }

    ngOnInit() {
        this.actorServ.getActors().subscribe(actors => {
            this.actors = actors;
            this.actors_all = actors;
        });
    }

    setFilter() {
        this.actors = _.filter(this.actors_all, function (o) {
            let reg = new RegExp(this.dataSearch, "i");
            return (reg.test(o.nom) || reg.test(o.prenom));
        }.bind(this));
    }

    delete(id) {
        this.actorServ.delete(id).subscribe(data => {
            this.actors_all = _.filter(this.actors_all, function (o) {
                let reg = new RegExp(id, "i");
                return (!reg.test(o.id));
            }.bind(this));
            this.actors = this.actors_all;
            this.dataSearch = "";
        })
    }

}