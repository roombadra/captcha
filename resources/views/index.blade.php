<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="design.css">
</head>

<body>
    <div class ="center">
        <form>
            <div class="mb-3">

                <input type="text" class="form-control" placeholder="fullname" name="fullname">
            </div>
            <div class="mb-3">

                <input type="email" class="form-control" placeholder="email" name="email">
            </div>
            <div class="mb-3">

                <input type="text" name="phone" placeholder="phone" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" name="subject" placeholder="subject" class="form-control">
            </div>
            <puzzle-captcha challenge="{{ $challenge }}" width="350" height="200" piece-width="80"
                piece-height="50" class="captcha" src={{ route('captcha', $challenge) }}></puzzle-captcha>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</body>
<script src="captcha.js"></script>

</html>
