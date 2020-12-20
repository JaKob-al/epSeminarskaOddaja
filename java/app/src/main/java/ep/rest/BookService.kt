package ep.rest

import retrofit2.Call
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import retrofit2.http.*

object BookService {

    interface RestApi {

        companion object {
            // AVD emulator
            // const val URL = "http://10.0.2.2:8080/netbeans/mvc-rest/api/"
            // Genymotion
            const val URL = "http://10.0.2.2:8080/netbeans/epSeminarska/index.php/api/"
        }

        @GET("book")
        fun getAll(): Call<List<Book>>

        @GET("book/{id}")
        fun get(@Path("id") id: Int): Call<Book>

        @DELETE("books/{id}")
        fun delete(@Path("id") id: Int): Call<Void>

        @FormUrlEncoded
        @POST("book")
        fun insert(@Field("author") author: String,
                   @Field("title") title: String,
                   @Field("price") price: Double,
                   @Field("year") year: Int,
                   @Field("description") description: String): Call<Void>

        @FormUrlEncoded
        @PUT("book/{id}")
        fun update(@Path("id") id: Int,
                   @Field("author") author: String,
                   @Field("title") title: String,
                   @Field("price") price: Double,
                   @Field("year") year: Int,
                   @Field("description") description: String): Call<Void>
    }

    val instance: RestApi by lazy {
        val retrofit = Retrofit.Builder()
                .baseUrl(RestApi.URL)
                .addConverterFactory(GsonConverterFactory.create())
                .build()

        retrofit.create(RestApi::class.java)
    }
}
