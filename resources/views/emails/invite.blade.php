<html>
<head>

</head>
<body>
Hello {{ $invite->first_name }},

        Please sign up for PleasantVile using this link <a href="{{ URL::to('/invite/' . $invite->invite_code) }}"> Invite </a>

</body>
</html>