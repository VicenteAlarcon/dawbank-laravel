<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Crear cuenta</h1>


@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif
@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/cuentas">
    @csrf

    <div>
        <label>Nombre</label><br>
        <input type="text" name="nombre">
    </div>

    <div>
        <label>Apellidos</label><br>
        <input type="text" name="apellidos">
    </div>

    <div>
        <label>DNI</label><br>
        <input type="text" name="dni">
    </div>

    <button type="submit">Crear cuenta</button>
</form>
</body>
</html>
