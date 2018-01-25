package com.example.florian.app;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.widget.TextView;

import com.google.common.collect.ImmutableMap;
import com.google.gson.internal.LinkedTreeMap;

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

public class ActeurActivity extends AppCompatActivity {

    private HashMap acteur;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.acteur);
        acteur = (HashMap) (getIntent().getExtras().get("acteur"));

        ((TextView) findViewById(R.id.acteurName)).setText(acteur.get("prenom") + " " + acteur.get("nom"));
        ((TextView) findViewById(R.id.acteurNaissance)).setText((String) acteur.get("dateNaissance"));
        ((TextView) findViewById(R.id.acteurMort)).setText((String) acteur.get("dateDeces"));
        displayFilms();
    }

    private void displayFilms() {
        ApiServiceInterface service = ApiService.getService();
        Call<List> call = service.listFilmsByActeurId(ImmutableMap.of("acteur", String.valueOf(((Double) acteur.get("id")).intValue())));
        call.enqueue(new Callback<List>() {
            @Override
            public void onResponse(Call<List> call, Response<List> response) {
                List<LinkedTreeMap> list = response.body();
                for (LinkedTreeMap film : list) {
                    Fragment filmFragmentActivity = FilmFragmentActivity.newInstance(film);
                    getSupportFragmentManager().beginTransaction().add(R.id.content, filmFragmentActivity, "Tag").commit();
                }
            }

            @Override
            public void onFailure(Call<List> call, Throwable t) {

            }
        });
    }
}
