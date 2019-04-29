<?php 
use App\Src\Utility\DatesFRConvertor;
use App\Src\Utility\WordsFRCorrector;
use App\Src\Utility\ChaptersNavDisplay;
$this->title = htmlspecialchars($article->getTitleBook()) . " - " . htmlspecialchars($article->getTitle());
$this->css = '<link rel="stylesheet" href="css/singleArticle.css" />' . ChaptersNavDisplay::display($totalArticles);
?>

<div id="singlePostPageContent">

	<section id="singlePost">
		<div id="blockHeaderSinglePost">
			<div id="flexAuthorDate">
				<h2><?=htmlspecialchars($article->getAuthor());?></h2>
				<p class="dateSinglePost">
					<?=htmlspecialchars(DatesFRConvertor::getSimplefiedDateConverted($article->getDatePost()));?>
				</p>
			</div>
			<h3><?=htmlspecialchars($article->getTitleBook());?></h3>
			<h4><?=htmlspecialchars($article->getTitle());?></h4>
		</div>

		<figure>
			<img src="img/<?=htmlspecialchars($article->getImageLink());?>" />
		</figure>

		<aside>
			<?=nl2br(htmlspecialchars($article->getContent()));?>
		</aside>
	</section>

	<div id="chaptersNavblock">
		<a class="chaptersNav" id="b1" href="index.php?route=singleArticle&articleID=<?=htmlspecialchars($article->getID() - 1)?>">Chapitre précédent</a>
		<a class="chaptersNav" id="b2" href="index.php?route=singleArticle&articleID=<?=htmlspecialchars($article->getID() + 1)?>">Chapitre suivant</a>
	</div>

		<?php
		if ($totalComments > 0)
		{
			$this->scripts = '<script src="js/CommentsView.js"></script>'
		?>
	<div id="moreCommentsControler">
		<a href="#" id="showMoreComments"><?=htmlspecialchars($totalComments);?> <?=WordsFRCorrector::singularOrPluralCorrector("commentaires", $totalComments)?> <i id="arrow" class="fas fa-sort-up"></i></a>
	</div>
	<section id="comments">
		<?php
			forEach($comments as $comment)
			{
		?>
		<div class="comments">
			<p class="authorsComments">
				<?=nl2br(htmlspecialchars($comment->getAuthor()));?>
				<input class="report" type="button" value="Signaler" />
			</p>
			<p class="datesComments">
				Posté le <?=htmlspecialchars(DatesFRConvertor::convertDateToFR($comment->getDateComment()));?>
			</p>
			<p class ="contentComments">
				<?=htmlspecialchars($comment->getContent());?>
			</p>
		</div>
		<hr>
		<?php
			}
		}
		else 
		{
		?>
		<p id="noComments">
			Il n'y a pas encore de commentaire pour cet article.
		</p>
		<?php
		}
		?>
		
	</section>
</div>


