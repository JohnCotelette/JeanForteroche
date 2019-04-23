<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>TestProjectSingle</title>
	</head>

	<body>
		<?php 
		$article = $articles->fetch()
		?>
			<div>
				<h2>TITRE: <?= htmlspecialchars($article->title); ?></h2>
				<p>AUTEUR: <?= htmlspecialchars($article->author); ?></p>
				<p>DATE: <?= htmlspecialchars($article->dateMessage); ?></p>
				<p>CONTENU: <?= htmlspecialchars($article->content); ?></p>
			</div>

		<?php
		$articles->closeCursor();
		?>
		<div>
			<a href="../Public/index.php">Retour à la page d'accueil</a>
		</div>

		<?php
		while($comment = $comments->fetch())
		{
		?>
			<div>
				<p>
					AJOUTE PAR <?= htmlspecialchars($comment->author);?>, LE <?= htmlspecialchars($comment->dateComment);?><br />
					<?= htmlspecialchars($comment->content);?>
				</p>
			</div>

		<?php
		}
		$comments->closeCursor();
		?>
	</body>
</html>