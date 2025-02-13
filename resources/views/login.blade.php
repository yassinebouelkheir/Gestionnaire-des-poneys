<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Laravel WEBCS</title>
      <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  </head>
  <body class="login-page">
    <div class="login-container">
        <h1>ESA WEBCS 2025</h1><br>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="nom_utilisateur">Nom d'utilisateur</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>

            <label for="mdp">Password</label>
            <input type="password" id="mdp" name="mdp" required>

            <button type="submit">Connexion</button>
        </form>
    </div>
  </body>
</html>
