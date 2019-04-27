<?php 
$this->title = "Blog de Jean Forteroche";

$totalArticles = count($articles);
$lastArticle = $articles[$totalArticles];
?>

<section id="last">
	<h2>Dernière publication</h2>
	<div id="lastPostBlog" class="postsBlog">
		<figure id="lastArticlePicture" class="articlesPicture">
			<img src="img/<?=$lastArticle->getImageLink()?>" alt="Image d'illustration du blog" />
		</figure>
		<aside id="rightCLastPost">
			<p id="dateLastPost" class="datePosts">
				<?=$lastArticle->getDatePost();?>
			</p>
			<h3 id="titleLastPost"><?=$lastArticle->getTitleBook();?></h3>
			<p id="chapCountLastPost" class="chapCount">
				<?=$lastArticle->getTitle();?>
			</p>
			<p id="contentLastPost" class="contentPosts">
				<?=$lastArticle->getContentCut();?> 
			</p>
			<p class="pForInput">
				<input id="showMoreContentLP" class="showMoreContent" type="button" value="Découvrir" />
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
			<img src="img/<?=$articles[$i]->getImageLink()?>" alt="Image d'illustration du blog" />
		</figure>
		<div class="rightC">
			<div class="blocTitlePost">
				<h3><?=$articles[$i]->getTitle();?></h3>
				<p class="datePosts">
					<?=$articles[$i]->getDatePost();?>
				</p>
			</div>
				<p class="chapCount">
					<?=$articles[$i]->getTitleBook();?>
				</p>
				<p class="contentPosts">
					<?=$articles[$i]->getContentCut();?>
				</p>
			<input class="showMoreContent" type="button" value="Découvrir" />
		</div>
	</aside>

<?php
}
?>

</section>

<input id="showMorePosts" type="button" value="Plus d'articles" />
