<article id="post-<?php echo $content->id; ?>" class="post" itemscope itemtype="http://schema.org/BlogPosting">

	<header class="metadata">
		<h1 itemprop="name"><a href="<?php echo $content->permalink; ?>" itemprop="url"><?php echo $content->title_out; ?></a></h1>
	</header>

	<div class="content" itemprop="articleBody">
	<?php echo $content->content_out; ?>
	</div>

</article>
