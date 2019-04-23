<?php
require "../Src/Managers/DataBaseManager.php";
require "../Src/Managers/ArticleManager.php";
require "../Src/Managers/CommentManager.php";

use App\Src\Managers\ArticleManager;
use App\Src\Managers\CommentManager;
?>


<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>TestProjectSingle</title>
	</head>

	<body>
		<?php 
		$article = new ArticleManager;
		$articles = $article->getOneArticle($_GET["articleID"]);

		while($article = $articles->fetch())
		{
		?>
			<div>
				<h2>TITRE: <?= htmlspecialchars($article->title); ?></h2>
				<p>AUTEUR: <?= htmlspecialchars($article->author); ?></p>
				<p>DATE: <?= htmlspecialchars($article->dateMessage); ?></p>
				<p>CONTENU: <?= htmlspecialchars($article->content); ?></p>
			</div>
		<?php
		}
		$articles->closeCursor();
		?>

		<div>
			<a href="home.php">Retour à la page d'accueil</a>
		</div>

		<?php
		$comment = new CommentManager;
		$comments = $comment->getCommentsArticle($_GET["articleID"]);

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