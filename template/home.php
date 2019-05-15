<?php 
use App\Src\Utility\FormattingHelper;
?>

<section id="last">
	<h2>Dernière publication</h2>
	<div id="lastPostBlog" class="postsBlog breakWords">
		<figure id="lastArticlePicture" class="articlesPicture">
			<img src="img/<?=htmlspecialchars($lastArticle->getImageLink());?>" alt="Image d'illustration du blog" />
		</figure>
		<aside id="rightCLastPost">
			<p id="dateLastPost" class="datePosts">
				<?=FormattingHelper::getSimplefiedDateConvertedFR($lastArticle->getDatePost());?>
			</p>
			<h3 id="titleLastPost"><?=htmlspecialchars($lastArticle->getTitleBook());?></h3>
			<p id="chapCountLastPost" class="chapCount">
				<?=htmlspecialchars($lastArticle->getTitle());?>
			</p>
			<p id="contentLastPost" class="contentPosts">
				<?=nl2br(strip_tags(FormattingHelper::cutTheContentProperly($lastArticle->getContent())));?> 
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
forEach (array_slice($articles, 1) as $article)
{
?>

	<aside class="postsBlog">
		<figure class="articlesPicture">
			<img src="img/<?=htmlspecialchars($article->getImageLink());?>" alt="Image d'illustration du blog" />
		</figure>
		<div class="rightC">
			<div class="blocTitlePost">
				<h3><?=htmlspecialchars($article->getTitle());?></h3>
				<p class="datePosts">
					<?=FormattingHelper::getSimplefiedDateConvertedFR($article->getDatePost());?>
				</p>
			</div>
				<p class="chapCount">
					<?=htmlspecialchars($article->getTitleBook());?>
				</p>
				<p class="contentPosts">
					<?=nl2br(strip_tags(FormattingHelper::cutTheContentProperly($article->getContent())));?>
				</p>
			<a href="index.php?route=singleArticle&articleID=<?=htmlspecialchars($article->getID());?>" class="showMoreContent">Découvrir</a>
		</div>
	</aside>

<?php
}
?>

</section>

<input id="showMorePosts" type="button" value="Plus d'articles" />
