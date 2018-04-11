<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  </head>
  <body>
    <nav>
       <div class="nav-wrapper">
         <a href="#" class="brand-logo">Cinechafa</a>
         <ul id="nav-mobile" class="right hide-on-med-and-down">
           <li><a href="/">Movies</a></li>
           <li><a href="{{route('newmovie')}}">New Movie</a></li>
         </ul>
       </div>
     </nav>
     <div class="row">
       <div class="col s12">
         @yield('content')
       </div>
     </div>
  </body>
  <footer>
    <!-- Compiled and minified JavaScript -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="/js/master.js" charset="utf-8"></script>
    @yield('scripts')
  </footer>
</html>
