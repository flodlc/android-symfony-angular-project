import {Component, OnInit} from '@angular/core';
import {Actor} from "../models/actor.model";
import {ActivatedRoute} from "@angular/router";
import {ActorService} from "../services/actor.service";

@Component({
    selector: 'app-actor-edit',
    templateUrl: './actor-edit.component.html',
    styleUrls: ['./actor-edit.component.css']
})
export class ActorEditComponent implements OnInit {
    actor: Actor;
    private sub: any;

    constructor(private route: ActivatedRoute, private actorServ: ActorService) {
    }

    ngOnInit() {
        this.sub = this.route.params.subscribe(params => {
            this.actorServ.getActor(+params['id']).subscribe(actor => {
                this.actor = actor;
                if (this.actor.dateDeces == "30/11/-1") {
                    this.actor.dateDeces = "";
                }
            });
        });
    }

}
