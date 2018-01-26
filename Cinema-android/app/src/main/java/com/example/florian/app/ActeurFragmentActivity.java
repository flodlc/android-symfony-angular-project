package com.example.florian.app;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import android.widget.TextView;

import com.google.gson.internal.LinkedTreeMap;

import java.util.HashMap;


/**
 * Created by Florian on 25/01/2018.
 */

public class ActeurFragmentActivity extends Fragment {
    public static ActeurFragmentActivity newInstance(String key, HashMap acteur) {
        ActeurFragmentActivity f = new ActeurFragmentActivity();
        Bundle args = new Bundle();
        args.putSerializable(key, acteur);
        f.setArguments(args);
        return f;
    }

    public static ActeurFragmentActivity newInstance(String key, LinkedTreeMap acteur) {
        ActeurFragmentActivity f = new ActeurFragmentActivity();
        Bundle args = new Bundle();
        args.putSerializable(key, convertToHashMap(acteur));
        f.setArguments(args);
        return f;
    }

    private static HashMap convertToHashMap(LinkedTreeMap acteur) {
        HashMap act = new HashMap();
        for (Object key : acteur.keySet()) {
            act.put(key, acteur.get(key));
        }
        return act;
    }


    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.acteur_fragment, container, false);

        String acteurName;
        final HashMap acteur;

        if (getArguments().get("personnage") != null) {
            HashMap perso = (HashMap) getArguments().getSerializable("personnage");
            acteur = convertToHashMap((LinkedTreeMap) perso.get("acteur"));
            acteurName = acteur.get("prenom") + " " + acteur.get("nom") + " (" + perso.get("nomPerso") + ")";
        } else {
            acteur = (HashMap) getArguments().getSerializable("acteur");
            acteurName = acteur.get("prenom") + " " + acteur.get("nom");
        }

        ((TextView) view.findViewById(R.id.acteurName)).setText(acteurName);
        ((TextView) view.findViewById(R.id.acteurNaissance)).setText((String) acteur.get("dateNaissance"));

        view.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), ActeurActivity.class);
                Bundle b = new Bundle();
                b.putSerializable("acteur", acteur);
                intent.putExtras(b);
                startActivity(intent);
            }
        });

        return view;
    }
}
