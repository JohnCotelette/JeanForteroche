<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>TestProjectSingle</title>
	</head>

	<body>
			<div>
				<h2>TITRE: <?= htmlspecialchars($article->getTitle()); ?></h2>
				<p>AUTEUR: <?= htmlspecialchars($article->getAuthor()); ?></p>
				<p>DATE: <?= htmlspecialchars($article->getDatePost()); ?></p>
				<p>CONTENU: <?= htmlspecialchars($article->getContent()); ?></p>
			</div>

		<div>
			<a href="../Public/index.php">Retour à la page d'accueil</a>
		</div>

		<?php
		forEach($comments as $comment)
		{
		?>
		<div>
			<p>
				AJOUTE PAR <?= htmlspecialchars($comment->getAuthor());?>, LE <?= htmlspecialchars($comment->getDateComment());?><br />
				<?= htmlspecialchars($comment->getContent());?>
			</p>
		</div>

		<?php
		}
		?>
	</body>
</html>