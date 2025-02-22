<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laravel WEBCS</title>
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
	<header>
		<nav>
			<a href="/rendezvous">Accueil</a>
			<a href="/poneys">Gestion des poneys</a>
			<a href="/historique">Historique</a>
      <a href="/deconnexion">Déconnexion</a>
		</nav>
	</header>
	<main>
    @yield('content')
</main>
</body>
</html>
