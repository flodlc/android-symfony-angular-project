package Service;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Path;

/**
 * Created by Florian on 05/01/2018.
 */
public interface ApiService {
    @GET("films")
    Call<List> listFilms();

    @GET("films(param)")
    Call<List> listFilmsByActeurId(@Path("param") String param);
}
