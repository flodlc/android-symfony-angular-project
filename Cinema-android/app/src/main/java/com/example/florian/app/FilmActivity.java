package com.example.florian.app;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.widget.TextView;

import com.google.gson.internal.LinkedTreeMap;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import Service.ApiService;
import Service.ApiServiceInterface;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

/**
 * Created by Florian on 25/01/2018.
 */

public class FilmActivity extends AppCompatActivity {

    private HashMap film;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.film);
        film = (HashMap) (getIntent().getExtras().get("film"));

        ((TextView) findViewById(R.id.filmName)).setText((String) film.get("title"));
        ((TextView) findViewById(R.id.filmRea)).setText((String) ((HashMap) film.get("realisateur")).get("name"));
        ((TextView) findViewById(R.id.filmDate)).setText((String) film.get("date"));
        ((TextView) findViewById(R.id.filmBudget)).setText(String.valueOf(film.get("budget")) + "€");
        ((TextView) findViewById(R.id.filmCategorie)).setText((String) ((HashMap) film.get("categorie")).get("libelleCat"));
        ((TextView) findViewById(R.id.filmRecette)).setText(String.valueOf(film.get("montantRecette")));
        displayActeurs();
    }

    private void displayActeurs() {
        ApiServiceInterface service = ApiService.getService();
        Call<LinkedTreeMap> call = service.getFilmByID(String.valueOf(((Double) film.get("id")).intValue()));

        call.enqueue(new Callback<LinkedTreeMap>() {
            @Override
            public void onResponse(Call<LinkedTreeMap> call, Response<LinkedTreeMap> response) {
                LinkedTreeMap freshFilm = response.body();
                for (LinkedTreeMap perso : (ArrayList<LinkedTreeMap>) freshFilm.get("personnages")) {
                    Fragment acteurFragmentActivity = ActeurFragmentActivity.newInstance("personnage", perso);
                    getSupportFragmentManager().beginTransaction().add(R.id.content, acteurFragmentActivity, "Tag").commit();
                }
            }

            @Override
            public void onFailure(Call<LinkedTreeMap> call, Throwable t) {

            }
        });
    }
}
