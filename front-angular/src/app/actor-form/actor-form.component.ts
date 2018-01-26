import {Component, Input, OnInit} from '@angular/core';
import {FormBuilder, FormGroup} from '@angular/forms';
import {Actor} from "../models/actor.model";
import {ActorService} from "../services/actor.service";
import {Router} from "@angular/router";

@Component({
    selector: 'app-actor-form',
    templateUrl: './actor-form.component.html',
    styleUrls: ['./actor-form.component.css']
})
export class ActorFormComponent implements OnInit {
    ActorForm: FormGroup;
    @Input() actor?: Actor;

    constructor(private fb: FormBuilder, private actorServ: ActorService, private router: Router) {
    }

    ngOnInit() {
        this.createForm(this.actor);
    }

    createForm(actor?: Actor) {
        if (actor) {
            if (this.actor.dateDeces == "30/11/-1" || this.actor.dateDeces == "30/11/-0001") {
                this.actor.dateDeces = "";
            }
            this.ActorForm = this.fb.group(actor);
        }
        else
            this.ActorForm = this.fb.group(new Actor());
    }

    submit() {
        if ((this.ActorForm.get('nom').status == 'VALID'
            || this.ActorForm.get('prenom').status == 'VALID')
            && this.ActorForm.get('dateNaissance').status == 'VALID') {
            this.actorServ.postActor(this.ActorForm.getRawValue()).subscribe(actor => {
                this.router.navigate(['/actor/' + actor.id]);
            });
        }
    }
}