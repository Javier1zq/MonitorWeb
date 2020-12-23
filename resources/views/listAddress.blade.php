
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Form Example Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<br>



<form action="listDB" method="POST">
      @csrf
        <hr>

        <hr>
        <label id="icon" for="street"><i class="fas fa-envelope"></i></label>
        <input type="text" name="street" id="street" value="FLUVIA" required/>
        <label id="icon" for="number"><i class="fas fa-user"></i></label>
        <input type="number" name="number" id="number" value="76" required/>
        <label id="icon" for="town"><i class="fas fa-unlock-alt"></i></label>
        <input type="text" name="town" id="town" value="BARCELONA" required/>

        <hr>
        <div class="btn-block">

          <button type="submit" >Submit</button>
        </div>
      </form>











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
