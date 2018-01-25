package com.example.florian.app;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

import Service.ApiService;
import com.google.gson.internal.LinkedTreeMap;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;


public class FilmsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        displayFilms();
        setContentView(R.layout.films);
    }

    private void displayFilms() {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.0.41/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        ApiService service = retrofit.create(ApiService.class);
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
