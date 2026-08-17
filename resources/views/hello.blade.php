<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello Page</title>
</head>

<body>

    @if ($value > 20)
        <div style="background: red;">
            Value is greater than 20
        </div>

    @elseif ($value < 10)
        <div style="background: green;">
            Value is less than 10
        </div>

    @else
        <div style="background: yellow;">
            Value is between 10 and 20
        </div>
    @endif

    <h1>Hello, {{ $name }}</h1>

    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit.
    </p>

    @for ($i = 0; $i < 5; $i++)
        <h2>The current value is {{ $i }}</h2>
    @endfor

</body>
</html>