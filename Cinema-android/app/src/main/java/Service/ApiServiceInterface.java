package Service;

import java.util.List;
import java.util.Map;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Path;
import retrofit2.http.QueryMap;

/**
 * Created by Florian on 05/01/2018.
 */
public interface ApiServiceInterface {
    @GET("films")
    Call<List> listFilms();

    @GET("acteurs")
    Call<List> listActeurs();

    @GET("films")
    Call<List> listFilmsByActeurId(@QueryMap Map<String, String> filters);
}