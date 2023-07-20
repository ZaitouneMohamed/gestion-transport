<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>bon de command</title>
</head>

<body>
    @foreach ($subcategories as $item)
        <h1>{{ $item->subCategory }} - {{ \App\Models\Order::Where('subCategory', $item->subCategory)->count() }}</h1>

        @foreach (\App\Models\Order::Where('subCategory', $item->subCategory)->get() as $test)
            <h3>{{ $test->id }}</h3>
        @endforeach
    @endforeach
</body>

</html>
