<table>
    <tr>
        <th>Student name</th>
        <th>Student email id</th>
        <th>Student city name</th>
        <th>Student Age</th>
    </tr>
   
     @foreach ($stude_data as $value)
      <tr>
        <td>{{$value->name}}</td>
        <td>{{$value->email}}</td>
        <td>{{$value->age}}</td>
        <td>{{$value->city_name}}</td>
      </tr>
     @endforeach
    
</table>