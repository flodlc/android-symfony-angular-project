package com.example.florian.app;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import android.widget.TextView;

import com.google.gson.internal.LinkedTreeMap;

/**
 * Created by Florian on 25/01/2018.
 */

public class FilmFragmentActivity extends Fragment {
    public static FilmFragmentActivity newInstance(LinkedTreeMap film) {
        FilmFragmentActivity f = new FilmFragmentActivity();
        Bundle args = new Bundle();
        args.putSerializable("film", film);
        f.setArguments(args);
        return f;
    }


    public View onCreateView(final LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.film_fragment, container, false);
        final LinkedTreeMap film = (LinkedTreeMap) getArguments().getSerializable("film");

        ((TextView) view.findViewById(R.id.filmName)).setText((String) film.get("title"));
        ((TextView) view.findViewById(R.id.filmRea)).setText((String) ((LinkedTreeMap)film.get("realisateur")).get("name"));
        ((TextView) view.findViewById(R.id.filmDate)).setText((String) film.get("date"));

        view.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), FilmActivity.class);
                Bundle b = new Bundle();
                b.putSerializable("film", film);
                intent.putExtras(b);
                startActivity(intent);
            }
        });
        return view;
    }


}
