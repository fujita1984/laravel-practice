<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/test.js') }}"></script>
    <title>Document</title>
</head>

<body>
    <button id="button" onclick="fetchData()">ask</button>
    <div>your message</div>
    <textarea name="request" id="request" cols="50" rows="10"></textarea>
    <div>ai response</div>
    <textarea name="response" id="response" cols="50" rows="10"></textarea>
</body>

</html>