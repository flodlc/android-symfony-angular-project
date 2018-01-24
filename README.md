# android-symfony-angular-project
Web api with Synfony and a desktop client with angular and a mobile client on android.


## API Doc

### Films:

- GET /films  
return all films.  
Status code : 200

- GET /film/id  
Return one film by id.  
Status code : 200 or 202 if not found

- DELETE /film/id  
Delete one film by id.  
Status code : 200 or 202 if not found

- POST /film  
If id is null, add a film, else edit a film
return : film created/edited
Status code : 200 or 202 if not found


### Acteurs:

- GET /acteurs  
return all actors  
Status code : 200

- GET /acteurs  
Return one actor by id  
Status code : 200 or 202 if not found

- DELETE /acteur  
Delete one actor by id  
Status code : 200 or 202 if not found

- POST /acteur  
If id is null, add an actor, else edit an actor
return : acteur created/edited
Status code : 200 or 202 if not found




### Categories:
#### TODO

- GET /categories  
return all categories  
Status code : 200

### Realisateur:

- GET /realisateurs  
return all realisateurs  
Status code : 200