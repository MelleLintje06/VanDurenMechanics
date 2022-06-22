<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Login Basic</title>

    <style>
        .main{
            margin:50px auto;
            width: 500px;
            height: auto;
            border:0.2px solid gray;
            border-radius: 20px;
            padding:40px;
        }
    </style>
</head>
<body>
    @include('layouts/header')

    <div class="main">
        Van Duren Mechanics
        <br>
        <br><br>
        @if($message = Session::get('error'))
            {{$message}}
        @endif
        <form action="LoginSubmit">
            <input type="text" name="usr" placeholder="Username">
            <br><br>
            <input type="password" name="pwd" placeholder="Password">
            <br><br>
            <input type="submit" value="Login">
        </form>
        <br><br><br><br>
        <a href="https://inspireweb.nl/" target="_blank">Powered by InspireWeb</a>
    </div>

    @include('layouts/footer')
</body>
</html>