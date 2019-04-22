<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>TestProject</title>
	</head>

	<body>
		<?php 
		require "DataBase.php";
		require "Article.php";

		$article = new Article;
		$articles = $article->getArticles();

		while($article = $articles->fetch())
		{
		?>
			<div>

				<h2><a href="single.php?articleID=<?=htmlspecialchars($article->ID);?>">Title: <?= htmlspecialchars($article->title); ?></a></h2>
				<p>Auteur : <?= htmlspecialchars($article->author); ?></p>
				<p>Date: <?= htmlspecialchars($article->dateMessage); ?></p>
				<p>Contenu: <?= htmlspecialchars($article->content); ?></p>
			</div>
		<?php
		}
		$articles->closeCursor();
		?>
	</body>
</html>