<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>TestProject</title>
	</head>

	<body>
		<?php 
		forEach($articles as $article)
		{
		?>
			<div>
				<h2><a href="../Public/index.php?route=article&articleID=<?=htmlspecialchars($article->getID());?>">TITRE: <?= htmlspecialchars($article->getTitle()); ?></a></h2>
				<p>AUTEUR: <?= htmlspecialchars($article->getAuthor()); ?></p>
				<p>DATE: <?= htmlspecialchars($article->getDatePost()); ?></p>
				<p>CONTENU: <?= htmlspecialchars($article->getContent()); ?></p>
			</div>

		<?php
		}
		?>
	</body>
</html>