
<!DOCTYPE html>
<html>
<head>
     
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body >
     
 
<table class="content-table">
  <thead>
    <tr>
      <th>Code Apogee</th>
      <th>CNE</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Adresse mail</th>

    </tr>
  </thead>
  <tbody>
  @foreach($data1 as $res)
    <tr>
      <td>{{$res->code_apogee}}</td>
      <td>{{$res->cne}}</td>
      <td>{{$res->nom}}</td>
      <td>{{$res->prenom}}</td>
      <td>{{$res->email}}</td>  
    </tr>
    @endforeach
     
  </tbody>
</table> </body>
</html>