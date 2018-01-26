# android-symfony-angular-project
Web api with Synfony and a desktop client with angular and a mobile client on android.
The API can store a lot of films with some details, like budget or the director. You can edit them.
You can store some actors and in wich films they have plaid. You can edit them too.

## About technologies
As we said in introduction, the server was created in Symfony 4 and there is a MySQL databases.
So you need to have Composer, in order to install all bundles needed by the server (like Doctrine), and MySQL.
You have the front angular compiled in public directory of symfony. So, at the route "/", you have the client web of the app.

The android app is in the folder android. Minimum SDK version of android : 21.

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

- GET /categories  
return all categories  
Status code : 200

### Realisateur:

- GET /realisateurs  
return all realisateurs  
Status code : 200