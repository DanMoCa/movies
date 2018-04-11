<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genre;
use App\Actor;
use App\MovieActor;
use Validator;
use Response;

class MovieController extends Controller
{
    //

    public function getMovies(Request $request){
      $movies = Movie::all();
      return view('index')->with(['movies'=>$movies]);
    }
    public function getMovie(Request $request, $id){
      $movie = Movie::find($id);

      if(isset($movie->genre)){
        $genres = Genre::where('id','!=',$movie->genre->id)->get();
      }else{
        $genres = Genre::all();
      }

      $movie->actors;
      $currentactors = $movie->actors->pluck('id')->toArray();

      $actors = Actor::whereNotIn('id',$currentactors)->get();

      return view('editmovie')->with(['movie'=>$movie,'genres'=>$genres,'actors'=>$actors]);
    }

    public function getNewMovie(Request $request){
      $actors = Actor::all();
      $genres = Genre::all();
      return view('newmovie')->with(['genres'=>$genres,'actors'=>$actors]);
    }

    public function createMovie(Request $request){
      $rules = [
        'name' => 'required',
        'year' => 'required',
        'genre_id' => 'required|exists:genres,id'
      ];

      $validator = Validator::make($request->all(),$rules);

      if($validator->fails()){
        return Response::json(['message'=>$validator->messages()->all()],401);
      }

      $movie = new Movie();

      $movie->name = $request->get('name');
      $movie->year = $request->get('year');
      $movie->genre_id = $request->get('genre_id')*1;

      if($movie->save()){
        if($request->has('actors')){
          $requestIds = $this->stringArrayToInteger($request->get('actors'));
          $validActors = Actor::whereIn('id',$requestIds)->get();

          foreach ($validActors as $key => $validActor) {
            MovieActor::create(['actor_id'=>$validActor->id,'movie_id'=>$movie->id]);
          }
        }

        return redirect()->route('index');
      }else{
        return Response::json('wtf');
      }
    }

    public function editMovie(Request $request){

      // return Response::json($request->all());
      $movie = Movie::find($request->get('id'));

      if(!isset($movie)){
        return Response::json('no movie found');
      }

      $movie->name = $request->get('name');
      $movie->year = $request->get('year');
      $movie->genre_id = $request->get('genre_id')*1;


      if($movie->save()){
        if($request->has('actors')){
          $requestIds = $this->stringArrayToInteger($request->get('actors'));
          $currentActors = $movie->actors->pluck('id')->toArray();
          $newActorsIds = array_diff($requestIds,$currentActors);

          // return Response::json(['actors'=>$requestIds,'new'=>$newActorsIds,'current'=>$currentActors]);

          MovieActor::whereNotIn('actor_id',$requestIds)->delete();

          foreach ($newActorsIds as $key => $newActorId) {
            MovieActor::create(['actor_id'=>$newActorId,'movie_id'=>$movie->id]);
          }

        }else{
          MovieActor::where('movie_id',$movie->id)->delete();
        }
        return redirect()->route('index');
      }
    }


    public function deleteMovie(Request $request){
      $rules = [
        'id' => 'required|exists:movie,id'
      ];

      $validator = Validator::make($request->all(),$rules);

      if($validator->fails()){
        return Response::json(['success'=>false,'message'=>$validator->messages()->all()],400);
      }

      $movie = Movie::find($request->get('id'));

      if($movie->delete()){
        return Response::json(['success'=>true,'message'=>'Movie Deleted successfully'],200);
      }else{
        return Response::json(['success'=>false,'message'=>'Could not delete movie at this time, try again later'],501);
      }
    }

    public function stringArrayToInteger($array){
      return array_map('intval', $array);
    }



}
