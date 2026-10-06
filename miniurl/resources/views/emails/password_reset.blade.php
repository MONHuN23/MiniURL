<!DOCTYPE html>
<html>
<head>
    <title>Jelszó visszaállítása</title>
</head>
<body>
    <h1>Szia!</h1>
    <p>Kaptunk egy kérést a jelszavad visszaállítására a MiniURL oldalon.</p>
    <p>A bejelentkezéshez (vagy új jelszó beállításához) kérlek kattints az alábbi linkre:</p>
    
    <p>
        <!-- A $magicLink változót a PasswordResetMail konstruktorában adtad át, 
             így az itt automatikusan elérhető. -->
        <a href="{{ route('password.reset', $magicLink->link) }}" style="display:inline-block; padding:10px 20px; background-color:#3490dc; color:#ffffff; text-decoration:none; border-radius:5px;">
            Bejelentkezés / Jelszó visszaállítása
        </a>
    </p>

    <p>Ha a gomb nem működne, másold be ezt a linket a böngésződbe:</p>
    <p>{{ route('password.reset', $magicLink->link) }}</p>

    <br>
    <p>Ha nem te kérted a jelszó visszaállítását, nyugodtan hagyd figyelmen kívül ezt a levelet.</p>
</body>
</html>
