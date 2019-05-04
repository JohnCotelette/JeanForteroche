<?php 
use App\Src\Utility\FormattingHelper;
?>

<section id="last">
	<h2>Dernière publication</h2>
	<div id="lastPostBlog" class="postsBlog">
		<figure id="lastArticlePicture" class="articlesPicture">
			<img src="img/<?=htmlspecialchars($lastArticle->getImageLink())?>" alt="Image d'illustration du blog" />
		</figure>
		<aside id="rightCLastPost">
			<p id="dateLastPost" class="datePosts">
				<?=htmlspecialchars(FormattingHelper::getSimplefiedDateConvertedFR($lastArticle->getDatePost()));?>
			</p>
			<h3 id="titleLastPost"><?=htmlspecialchars($lastArticle->getTitleBook());?></h3>
			<p id="chapCountLastPost" class="chapCount">
				<?=htmlspecialchars($lastArticle->getTitle());?>
			</p>
			<p id="contentLastPost" class="contentPosts">
				<?=nl2br((htmlspecialchars(FormattingHelper::cutTheContentProperly($lastArticle->getContent()))));?> 
			</p>
			<p class="pForInput">
				<a href="index.php?route=singleArticle&articleID=<?=htmlspecialchars($lastArticle->getID());?>" id="showMoreContentLP" class="showMoreContent">Découvrir</a>
			</p>
		</aside>
	</div>
</section>

<h2>Publications</h2>
<section id="more">

<?php 
for ($i = $totalArticles - 1; $i > 0; $i--)
{
?>

	<aside class="postsBlog">
		<figure class="articlesPicture">
			<img src="img/<?=htmlspecialchars($articles[$i]->getImageLink())?>" alt="Image d'illustration du blog" />
		</figure>
		<div class="rightC">
			<div class="blocTitlePost">
				<h3><?=htmlspecialchars($articles[$i]->getTitle());?></h3>
				<p class="datePosts">
					<?=htmlspecialchars(FormattingHelper::getSimplefiedDateConvertedFR($articles[$i]->getDatePost()));?>
				</p>
			</div>
				<p class="chapCount">
					<?=htmlspecialchars($articles[$i]->getTitleBook());?>
				</p>
				<p class="contentPosts">
					<?=htmlspecialchars(FormattingHelper::cutTheContentProperly($articles[$i]->getContent()));?>
				</p>
			<a href="index.php?route=singleArticle&articleID=<?=htmlspecialchars($articles[$i]->getID());?>" class="showMoreContent">Découvrir</a>
		</div>
	</aside>

<?php
}
?>

</section>

<input id="showMorePosts" type="button" value="Plus d'articles" />
