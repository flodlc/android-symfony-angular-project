package com.example.florian.app;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.widget.TextView;
import com.google.gson.internal.LinkedTreeMap;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import Service.ApiService;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

/**
 * Created by Florian on 25/01/2018.
 */

public class ActeurActivity extends AppCompatActivity {

    private HashMap acteur;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.film);
        acteur = (HashMap) (getIntent().getExtras().get("film"));

        ((TextView) findViewById(R.id.filmName)).setText((String) acteur.get("title"));
        ((TextView) findViewById(R.id.filmRea)).setText((String) ((HashMap) acteur.get("realisateur")).get("name"));
        ((TextView) findViewById(R.id.filmDate)).setText((String) acteur.get("date"));
        displayFilms();
    }

    private void displayFilms() {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.0.41/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        ApiService service = retrofit.create(ApiService.class);
        Call<List> call = service.listFilmsByActeurId("?acteur=" + acteur.get("id"));
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
