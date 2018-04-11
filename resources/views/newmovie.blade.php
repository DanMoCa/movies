@extends('layouts.baselayout')

@section('content')

<form class="col s12" action="{{route('createmovie')}}" method="post">
  {{csrf_field()}}
  <div class="row">
    <div class="input-field col s12">
      <input type="text" name="name" value="" required>
      <label for="name">Name</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input type="number" name="year" value="" required>
      <label for="year">Year</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <select class="" name="genre_id">
        <option value="" selected disabled>Select a Genre</option>
        @forelse($genres as $genre)
        <option value="{{$genre->id}}">{{$genre->name}}</option>
        @empty
        <option value="" disabled>No available genres</option>
        @endforelse
      </select>
      <label>Movie Genre</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <select name="actors[]" multiple>
        <option selected disabled>Select Actors</option>
        @forelse($actors as $actor)
        <option value="{{$actor->id*1}}">{{$actor->name}}</option>
        @empty
        @endforelse
      </select>
      <label>Movie Actors</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <button class="btn waves-effect waves-light" type="submit" name="action">Save
        <i class="material-icons right">save</i>
      </button>
    </div>
  </div>

</form>

@endsection
