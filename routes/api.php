<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Post;

use App\Models\User;
use App\Http\Resources\UserResource;
 

Route::get('/user/{id}', function (string $id) {

    return new UserResource(User::findOrFail($id));

});

Route::prefix('/blog')-> name('blog.')-> group( function () {
    
    Route::get('/', function (Request $request) {

        $post = new Post();
        $post -> title = "article 1";
        $post -> description = "new ";
        $post -> save();

        // return Post::all(['id']);
        // return request()->path(); 

    })->name('index');
    
    Route::get('/{slug}-{id}', function (string $slug, string $id) {
        return [
            'slug' => $slug,
            'id' => $id,
        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+',
    ]
    ) ->name('show');

}
);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
