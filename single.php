<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>TestProjectSingle</title>
	</head>

	<body>
		<?php 
		require "DataBase.php";
		require "Article.php";

		$article = new Article;
		$articles = $article->getOneArticle($_GET["articleID"]);

		while($article = $articles->fetch())
		{
		?>
			<div>
				<h2>Title: <?= htmlspecialchars($article["title"]); ?></h2>
				<p>Auteur : <?= htmlspecialchars($article["author"]); ?></p>
				<p>Date: <?= htmlspecialchars($article["dateMessage"]); ?></p>
				<p>Contenu: <?= htmlspecialchars($article["content"]); ?></p>
			</div>
		<?php
		}
		$articles->closeCursor();
		?>
	</body>
</html>