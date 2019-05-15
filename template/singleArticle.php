<?php 
use App\Src\Utility\FormattingHelper;
use App\Src\Utility\SpecialsDisplays;
?>

<div id="singlePostPageContent">
	<section id="singlePost">
		<div id="blockHeaderSinglePost">
			<div id="flexAuthorDate">
				<h2><?=htmlspecialchars($article->getAuthor());?></h2>
				<p class="dateSinglePost">
					<?=FormattingHelper::getSimplefiedDateConvertedFR($article->getDatePost());?>
				</p>
			</div>
			
			<h3><?=htmlspecialchars($article->getTitleBook());?></h3>
			<h4><?=htmlspecialchars($article->getTitle());?></h4>
		</div>

		<figure>
			<img src="img/<?=htmlspecialchars($article->getImageLink());?>" />
		</figure>

		<aside>
			<?=nl2br($article->getContent());?>
		</aside>
	</section>

	<div id="chaptersNavblock">
		<a class="chaptersNav" id="b1" href="index.php?route=singleArticle&articleID=<?=SpecialsDisplays::articlesNavigator($article->getID(), $articlesID, "left");?>">Chapitre précédent</a>
		<a class="chaptersNav" id="b2" href="index.php?route=singleArticle&articleID=<?=SpecialsDisplays::articlesNavigator($article->getID(), $articlesID, "right");?>">Chapitre suivant</a>
	</div>

<?php
if ($totalComments > 0)
{
?>
	<div id="moreCommentsControler">
		<a href="#" id="showMoreComments"><?=htmlspecialchars($totalComments);?> <?=FormattingHelper::singularOrPluralCorrector("commentaires", $totalComments)?> <i id="arrow" class="fas fa-sort-up"></i></a>
	</div>

	<section id="comments">
<?php
	forEach($comments as $comment)
	{
?>
		<div class="comments">
			<p class="authorsComments">
				<?=nl2br(htmlspecialchars($comment->getAuthor()));?>
<?php
		if ($comment->getReportStatus() == 0)
		{
?>
				<input id="<?=$comment->getID();?>" class="report" type="button" value="Signaler" />
				<p id="<?=$comment->getID();?>" class="invisible">
					Signalé !
				</p>
<?php
		}
?>
			</p>
			<p class="datesComments">
				Posté le <?=FormattingHelper::convertDateToFR($comment->getDateComment());?>
			</p>
			<p class ="contentComments">
				<?=nl2br(htmlspecialchars($comment->getContent()));?>
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

	<section id="commentPost">
		<div id="blocContainer">
			<p id="titleForm">
				Pour laisser un commentaire, remplissez le formulaire ci-dessous.<br />
				Tous les champs sont obligatoires.
			</p>

			<form id="form" class="invisible" method="post" action="#">
				<div id="identity">
					<p>
						<label class="labels" for="nom">Nom*</label><br />
						<input type="text" id="nom" name="nom" maxlength="30" required />
					</p>
					<p>
						<label class="labels" for="prenom">Prenom*</label><br />
						<input type="text" id="prenom" nom="prenom" maxlength="30" required />
					</p>
				</div>

				<p id="blocCommentPostContent">
					<label class="labels" for="commentPostContent">Commentaire*</label><br />
					<textarea id="commentPostContent" name="commentPostContent" maxlength="500" required /></textarea>
				</p>
				
				<div id="submitContainer">
					<p>
						<input type="hidden" id="articleID" data-articleID="<?=$article->getID();?>" />
						<input type="submit" id="submit" class="submit" value="Envoyer" />
					</p>
				</div>

			</form>

			<div id="displayCaptchaContainer">
				<button id="displayCaptcha" class="submit">Laisser un commentaire</button>
			</div>

			<div id="captcha" class="invisible">
				<p>
					<span id="captchaNumber1"></span> plus <span id="captchaNumber2"></span> font :
					<input type="text" name="captchaResult" id="captchaResult" maxlength="2" />
				</p>
				<button id="captchaValidator" class="submit">Valider le résultat</button>
			</div>

			<p id="confirmPostMessage" class="invisible">
				Votre commentaire a bien été ajouté
			</p>
		</div>
	</section>
</div>