


<!DOCTYPE html>
<html>
<head>
<title>Backup Page</title>
</head>
<body>

        <form method="post" action="{{url('postdatabasebackup')}}">
@csrf
            <input type="radio" name="backup"> Backup <br>
            <input type="radio" name="download"> Download <br>
            <input type="submit" value="MySQL Backup">

        </form>

</body>
</html>