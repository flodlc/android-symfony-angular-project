import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {Actor} from "../models/actor.model";
import {ActorService} from "../services/actor.service";

@Component({
    selector: 'app-actor-form',
    templateUrl: './actor-form.component.html',
    styleUrls: ['./actor-form.component.css']
})
export class ActorFormComponent {
    ActorForm: FormGroup;

    constructor(private fb: FormBuilder, private actorServ: ActorService) {
        this.createForm();
    }

    createForm(actor?: Actor) {
        if (actor)
            this.ActorForm = this.fb.group(actor);
        else
            this.ActorForm = this.fb.group(new Actor());

    }

    submit() {
        if (this.ActorForm.get('nom') && this.ActorForm.get('prenom') && this.ActorForm.get('dateNaissance'))
            console.log(this.ActorForm.getRawValue());
    }
}