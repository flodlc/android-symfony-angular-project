import {Injectable} from '@angular/core';
import {Observable} from 'rxjs/Rx';
import 'rxjs/add/operator/map';
import {HttpClient} from "@angular/common/http";
import {Actor} from "../models/actor.model";

@Injectable()
export class ActorService {

    constructor(private http: HttpClient) {}

    getActors(): Observable<Actor[]> {
        const url = `/actors/`;
        return this.http.get(url).map(actors => actors as Actor[]);
    }

    getActor(id: number): Observable<Actor> {
        const url = `/actor/` + id;
        return this.http.get(url).map(actor => actor as Actor);
    }
}