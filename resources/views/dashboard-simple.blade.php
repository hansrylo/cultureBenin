<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenue sur le Dashboard!</h1>
    <p>Vous êtes connecté en tant que: {{ Auth::user()->email }}</p>
    <p>ID utilisateur: {{ Auth::user()->id_utilisateur }}</p>
    <p>Nom: {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</p>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Déconnexion</button>
    </form>
</body>
</html>
