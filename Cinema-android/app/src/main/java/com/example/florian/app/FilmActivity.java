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
        ((TextView) findViewById(R.id.filmBudget)).setText(String.valueOf(film.get("budget")));
        ((TextView) findViewById(R.id.filmCategorie)).setText((String) ((HashMap)  film.get("categorie")).get("libelleCat"));
        ((TextView) findViewById(R.id.filmRecette)).setText(String.valueOf(film.get("montantRecette")));
        displayActeurs();
    }

    private void displayActeurs() {
        for (HashMap perso : ((ArrayList<HashMap>) film.get("personnages"))) {
            Fragment acteurFragmentActivity = ActeurFragmentActivity.newInstance("personnage", perso);
            getSupportFragmentManager().beginTransaction().add(R.id.content, acteurFragmentActivity, "Tag").commit();
        }
    }
}
