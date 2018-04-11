@extends('layouts.baselayout')

@section('content')
  <table id="movies-table" class="striped">
    <thead>
      <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Year</td>
        <td>Genre</td>
        <td>Options</td>
      </tr>
    </thead>
    <tbody>
      @forelse($movies as $movie)
        <tr>
          <td>{{$movie->id}}</td>
          <td>{{$movie->name}}</td>
          <td>{{$movie->year}}</td>
          @if(isset($movie->genre))
          <td>{{$movie->genre->name}}</td>
          @else
          <td>N/A</td>
          @endif
          <td>
            <a class="dropdown-button btn" href="#" data-activates="dropdown-options{{$movie->id}}">Options</a>
            <ul id="dropdown-options{{$movie->id}}" class="dropdown-content">
              <li>
                <a href="{{route('getmovie',$movie->id)}}"><i class="material-icons">edit</i>Edit</a>
                <li><a class="delete-movie" data-movieid="{{$movie->id}}" href="#"><i class="material-icons">delete</i>Delete</a></li>
              </li>
            </ul>

          </td>
        </tr>
      @empty
      @endforelse
    </tbody>
  </table>
@endsection

@section('scripts')
  <script type="text/javascript">
    $( document ).ready(function() {
      $('.delete-movie').click(function(){
        var id = this.getAttribute('data-movieid');
        var rowIndex = $('#movies-table tr').index($(this).closest('tr'));

        $.ajax({
          url: "{{route('deletemovie')}}",
          method: "DELETE",
          data: {id : id}
        }).done(function(){
          $('#movies-table tr').eq(rowIndex).remove();
          alert('The Movie has been deleted successfully');
        }).fail(function(jqXHR, textStatus){
          alert("Request failed: " + textStatus);
        });
      });
    });
  </script>
@endsection
