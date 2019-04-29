<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<link rel="stylesheet" href="css/main.css" />
		<?=$css?>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<title><?=$title?></title>
		<meta name="description" content="Retrouvez sur cette page les derniers épisodes de 'Billet simple pour l'Alaska', le dernier roman de JeanForteroche. Pages PHP." />
	</head>

	<body>
		<header>
			<div id="blogTitle"><h1>Jean<br />Forteroche</h1>
			</div>
			<nav id="menu">
				<a id="hamburger" href="#"><i class="fas fa-bars"></i></a>
				<ul id="contentNav" class="mobileMenuCss">
					<li class="menuLinks" id="home"><a href="index.php">Accueil</a></li>
					<li class="menuLinks" id="about"><a href="#">A propos de moi</a></li>
					<li class="menuLinks" id="contact"><a href="#">Contact</a></li>
					<li class="menuLinks" id="sign"><a href="#">Se connecter</a></li>
					<a href="#" id="exitMobileMenu"><i class="far fa-times-circle"></i></a>
				</ul>
			</nav>
		</header>
		
		<div id="filterBody">
			<div id="pageContent">
				<?=$content?>
			</div>

			<footer>
				<div id="footerAuthor">
					Jean<br />Forteroche
				</div>

				<div id="legalsLink">
					<a class="link" href="#">Mentions légales</a>
				</div>
			</footer>
		</div>

		<?=$scripts?>
		<script src="js/MobileNav.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>