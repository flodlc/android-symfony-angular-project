package com.example.florian.app;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;

import com.google.gson.internal.LinkedTreeMap;

import java.util.List;

import Service.ApiService;
import Service.ApiServiceInterface;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

/**
 * Created by Florian on 25/01/2018.
 */

public class ActeursActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        displayActeurs();
        setContentView(R.layout.acteurs);
    }

    private void displayActeurs() {
        ApiServiceInterface service = ApiService.getService();
        Call<List> call = service.listActeurs();
        call.enqueue(new Callback<List>() {
            @Override
            public void onResponse(Call<List> call, Response<List> response) {
                List<LinkedTreeMap> list = response.body();
                for (LinkedTreeMap acteur : list) {
                    Fragment acteurFragmentActivity = ActeurFragmentActivity.newInstance("acteur", acteur);
                    getSupportFragmentManager().beginTransaction().add(R.id.content, acteurFragmentActivity, "Tag").commit();
                }
            }

            @Override
            public void onFailure(Call<List> call, Throwable t) {

            }
        });
    }

}
