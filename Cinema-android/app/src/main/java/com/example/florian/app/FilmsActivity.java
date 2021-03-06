package com.example.florian.app;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;

import Service.ApiService;
import Service.ApiServiceInterface;

import com.google.gson.internal.LinkedTreeMap;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class FilmsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        displayFilms();
        setContentView(R.layout.films);
    }

    private void displayFilms() {
        ApiServiceInterface service = ApiService.getService();
        Call<List> call = service.listFilms();

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
