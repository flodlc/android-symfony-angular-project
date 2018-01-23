import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {Actor} from "../models/actor.model";
import {ActorService} from "../services/actor.service";
import {Router} from "@angular/router";

@Component({
    selector: 'app-actor-form',
    templateUrl: './actor-form.component.html',
    styleUrls: ['./actor-form.component.css']
})
export class ActorFormComponent {
    ActorForm: FormGroup;

    constructor(private fb: FormBuilder, private actorServ: ActorService, private router: Router) {
        this.createForm();
    }

    createForm(actor?: Actor) {
        if (actor)
            this.ActorForm = this.fb.group(actor);
        else
            this.ActorForm = this.fb.group(new Actor());

    }

    submit() {
        if (this.ActorForm.get('nom').status == 'VALID'
            && this.ActorForm.get('prenom').status == 'VALID'
            && this.ActorForm.get('dateNaissance').status == 'VALID') {
            this.actorServ.postActor(this.ActorForm.getRawValue()).subscribe(actor => {
                this.router.navigate(['/actor/' + actor.id]);
            });
        }
    }
}