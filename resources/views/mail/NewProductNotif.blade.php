<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Product Price: {{ $newProduct->ProductPrice }}</p>
    <p>Product Name: {{ $newProduct->ProductName }}</p>
    <p>Product Category: {{ $newProduct->category->CategoryName }}</p>
</body>
</html>