<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    <div class="wrapper">
        <div class="profile-box">
            <p>{{ $user->name }} さん</p>
            <div class="image-box">
                <img src="{{ asset('storage/images/'. $user->avatar) }}" alt="">
            </div>
        </div>
        <button type="button" onclick="history.back()" class="return-btn">戻る</button>
    </div>
</body>
</html>