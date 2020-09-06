<!DOCTYPE html>
<html lang="en">

<table>
    <thead>
        <tr>
            <th></th>


            <th></th>
            <th>C1</th>
            <th>C2</th>
          
        </tr>




    </thead>
    <tbody>
    @if(isset($resultat))
        @foreach($resultat as $res)
        <tr>

            <td>{{ $res->libelle }}</td>
            <td></td>
            @if($res->C1!=null)
                 @if($res->C2!=null)
                 <td>{{$res->C1}}</td>
                 <td>{{$res->C2}}</td>
                 @else
                 <td>{{$res->C1}}</td>
                 <td> </td>
                 @endif

            @else
                @if($res->C2!=null)
                 <td> </td>
                 <td>{{$res->C2}}</td>
                 @else
                 <td></td>
                 <td> </td>
                 @endif
         
            @endif

        </tr>
        @endforeach
        @endif
    </tbody>
</table>