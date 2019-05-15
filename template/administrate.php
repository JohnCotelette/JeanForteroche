<?php
use App\Src\Utility\FormattingHelper;
?>

<div class="sectionTitles">
	<a class="categories links" id="one" href="">Administration des billets<i class="fas fa-sort-up bigArrows arrows"></i></a>
</div>

<section id="adminArticles" class="adminSections">
	<div class="containers">
		<a class="smallCategories links" href="">Liste des billets (<?=$totalArticles;?>)<i class="fas fa-sort-up smallArrows arrows"></i></a>
		<div id="articlesList" class="smallContents">
			<?php
if ($totalArticles > 0)
{
	forEach($articles as $article)
	{
?>			<div class="articles">
				<p class="pArticlesPicture">
					<img src="img/<?=htmlspecialchars($article->getImageLink());?>" alt="Photo d'illustration de l'article" />
				</p>
				<p class="pArticlesDateAuthor">
					<?=htmlspecialchars(FormattingHelper::getSimplefiedDateConvertedFR($article->getDatePost()));?><br />
					<?=htmlspecialchars($article->getAuthor());?>
				</p>
				<p class="pArticlesTitles">
					<?=htmlspecialchars($article->getTitleBook());?><br />
					<?=htmlspecialchars($article->getTitle());?>
				</p>
				<div class="blocArticlesManage">
					<p class="pArticlesShow">
						<a href="index.php?route=singleArticle&articleID=<?=$article->getID();?>" target="_blank" class="showCompleteArticle buttonsShowArticle"><i class="far fa-eye"></i></a>
					</p>
<?php
		if ($_SESSION["rightsAdminBlog"] > 0)
		{
?>
					<p class="pArticlesEdit">
						<input type="button" data-articleID="<?=$article->getID();?>" class="adminButtonsEditArticle buttons" value="Editer"/>
					</p>
					<p class="pArticlesDelete">
						<input type="button" data-articleID="<?=$article->getID();?>" class="adminButtonsDeleteArticle buttons" value="Supprimer" />
					</p>
<?php
		}
?>
				</div>
			</div>
			<hr class="articlesHr">
<?php
		}
	}
		else
		{
?>
			<p id="noArticles">
				Aucun article n'est présent dans la base de données.
			</p>
<?php
		}
	if ($_SESSION["rightsAdminBlog"] > 0)
	{
?>
			<div id="addArticle">
				<p class="articleAddEdit">
					<span class="style">Ajouter un billet</span>
				</p>	
				<div class="addEditArticle">
					<form id="formAddArticle" class="formulaire" method="post">
						<p>
							<label for="title">Chapitre*</label>
							<input class="inputsAdmin" type="text" name="title" id="titleChapterAdd" maxlength="200" required />
						</p>
						<p>
							<label for="titleBook">Titre du livre*</label>
							<input class="inputsAdmin" type="text" name="titleBook" id="titleBookAdd" maxlength="200" required />
						</p>	
						<p>
							<label for="picture">Image*</label>
							<input class="inputsAdmin" type="file" accept="image/jpg" name="picture" id="pictureAdd" required />
						</p>
						<p>
					        <textarea class="texte" name="articleContent" rows="25" ></textarea>
					     </p>
					     <p>
				       		<input type="submit" class="addEditArticlesButton buttons" onclick="tinyMCE.triggerSave(true,true);" data-author="<?=$_SESSION["nameAdminBlog"];?>" value="Ajouter" />
				       	</p>
			 		</form>
				</div>
			</div>

			<div id="editArticle" class="invisible">
				<p class="articleAddEdit">
					<span class="style">Modifier un billet</span>
				</p>	
				<div class="addEditArticle">
					<form id="formEditArticle" class="formulaire" method="post">
						<p>
							<label for="title">Chapitre*</label>
							<input class="inputsAdmin" type="text" name="titleEdit" id="titleChapterEdit" maxlength="200" required />
						</p>
						<p>
							<label for="titleBook">Titre du livre*</label>
							<input class="inputsAdmin" type="text" name="titleBookEdit" id="titleBookEdit" maxlength="200" required />
						</p>	
						<p>
							<label for="picture">Image (si vide, l'ancienne sera convervée)</label>
							<input class="inputsAdmin" type="file" accept="image/jpg" name="pictureEdit" id="pictureEdit" />
							<span id="lastPictureBloc">
								Dernière image: <span id="lastPicture"></span>
							</span>
						</p>
						<p>
					        <textarea class="texte" name="articleContentEdit" rows="25" ></textarea>
					     </p>
					     <p id="submitContainerEdit">
				       		<input type="submit" class="addEditArticlesButton buttons" onclick="tinyMCE.triggerSave(true,true);" data-author="<?=$_SESSION["nameAdminBlog"];?>" value="Modifier" />
				       		<button id="changeMod" class="buttons"><i class="fas fa-arrow-circle-right"></i> Ajouter un article</button>
				       	</p>
			 		</form>
				</div>
			</div>
<?php
	}
?>
		</div>
	</div>
</section>

<div class="sectionTitles">
	<a class="categories links" id="two" href="">Administration des commentaires<i class="fas fa-sort-up bigArrows arrows"></i></a>
</div>

<section id="adminComments" class="adminSections">
	<div class="containers">
		<a class="smallCategories links" href="">Liste des commentaires signalés (<?=$totalReportedComments;?>)<i class="fas fa-sort-up smallArrows arrows"></i></a>
		<div id="CommentsList" class="smallContents">
<?php
if ($totalReportedComments > 0)
{
?>
			<div id="headerComments">
				<p id="pDate">
					Date
				</p>
				<p id="pAuthor">
					Auteur
				</p>
				<p id="pContent">
					Contenu
				</p>
				<p id="pManage">
					Modération
				</p>
			</div>
<?php
	forEach($reportedComments as $comment)
	{
?>			<div class="commentsReported">
				<p class="pDate">
					<?=FormattingHelper::getSimplefiedDateConvertedFR($comment->getDateComment());?>
				</p>
				<p class="pAuthor">
					<?=htmlspecialchars($comment->getAuthor());?>
				</p>
				<p class="pContent">
					<?=nl2br(htmlspecialchars($comment->getContent()));?>
				</p>
				<p class="pManage">
					<input type="button" data-commentID="<?=$comment->getID();?>" class="adminButtonsDeleteComment buttons" value="Supprimer" />
					<input type="button" data-commentID="<?=$comment->getID();?>" class="adminButtonsComment buttons" value="Annuler" />
				</p>
			</div>
			<hr class="commentsHr">
<?php	
	}
}
else
{
?>
			<p id="noComments">
				Aucun commentaire a modérer.
			</p>
<?php
}
?>
		</div>
	</div>
</section>

<div class="sectionTitles">
	<a class="categories links" id="three" href="">Gestion des administrateurs<i class="fas fa-sort-up bigArrows arrows"></i></a>
</div>

<section id="adminAddAndRemove" class="adminSections">
	<div class="containers">
		<a class="smallCategories links" href="">Liste des administrateurs (<?=$totalAdmins;?>)<i class="fas fa-sort-up smallArrows arrows"></i></a>
		<div id="adminsList" class="smallContents">
<?php
if ($_SESSION["rightsAdminBlog"] > 0)
{
?>
		<div id="headerAdmins">
			<p id="pAdminID">
				Numéro
			</p>
			<p id="pAdminPseudo">
				Pseudo
			</p>
			<p id="pAdminRights">
				Droits
			</p>
			<p id="pAdminManage">
				Suppression
			</p>
		</div>
<?php
	forEach($adminsList as $admin)
	{
?>
			<div class="adminsList">
				<p class="pAdminID">
					<?=$admin->getID();?>
				</p>
				<p class="pAdminPseudo">
					<?=htmlspecialchars($admin->getName());?>
				</p>
				<p class="pAdminRights">
<?php
		if($admin->getRights() == 2)
		{
?>					
					Propriétaire du site
<?php
		}
		else if($admin->getRights() == 1)
		{
?>
					Administrateur
<?php
		}
		else
		{
?>
					Modérateur
<?php			
		}
?>
				</p>
				<p class="pAdminManage">
<?php
		if ($admin->getRights() < 2 && $_SESSION["rightsAdminBlog"] > 0)
		{
?>
					<input type="button" data-adminID="<?=$admin->getID();?>" class="adminButtonsDelete buttons" value="Supprimer" />
<?php
		}
?>
				</p>
			</div>
			<hr class="adminsHr">
<?php
	}
}
else
{
?>
			<p id="errorRights">
				Vous ne disposez pas des droits administrateur suffisants pour gérer cette section du site.
			</p>
<?php
}
if ($_SESSION["rightsAdminBlog"] > 0)
{
?>			<p id="pAdminAdd">
				<span class="style">Ajouter un administrateur ou un modérateur</span>
			</p>
			<form id="addAdmin" method="post">
				<p>
					<label for="pseudo">Pseudo*</label>
					<input type="text" name="pseudo" id="pseudoAdmin" class="inputsAdmin" maxlength="200" required />
				</p>
				<p>
					<label for="password">Mot de passe*</label>
					<input type="text" name="password" id="passwordAdmin" class="inputsAdmin" maxlength="200" required/>
				</p>
				<p>
					<label for="rights">Droits*</label>
					<select name="rights" id="rights" class="inputsAdmin" required>
						<option value="">--Selection droits--</option>
						<option value="administrateur">Administrateur</option>
						<option value="modérateur">Modérateur</option>
					</select>
				</p>
				<p id="submitAdminContainer">
					<input type="submit" id="submitAdmin" class="buttons" value="Ajouter" />
				</p>
			</form>
<?php
}
?>
		</div>
	</div>
</section>