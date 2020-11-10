
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Form Example Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<br>

<br>
  <table border="1">
    <tr>
      <td>street</td>
      <td>number</td>
      <td>townId</td>
      <td>provinceId</td>
      <td>type</td>
    </tr>
    <br>
    
    @foreach ($addresses as $address)
    <tr>
      <td>{{$address['street']}}</td>
      <td>{{$address['number']}}</td>
      <td>{{$address['townId']}}</td>
      <td>{{$address['provinceId']}}</td>
      <td>{{$address['type']}}</td>
    </tr>
    @endforeach 
    
  </table>

<!--  
<div class="container mt-4">
  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <div class="card">
    <div class="card-header text-center font-weight-bold">
       Add Address
    </div>
    <div class="card-body">
      <form name="add-address-form" id="add-address-form" method="post" action="store-form">
       @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">street</label>
          <input type="text" id="street" name="street" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">number</label>
          <input type="number" id="number" name="number" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">townId</label>
          <input type="number" id="townId" name="townId" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">provinceId</label>
          <input type="number" id="provinceId" name="provinceId" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">type</label>
          <input type="text" id="type" name="type" class="form-control" required="">
        </div>




        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>    -->
</body>
</html>