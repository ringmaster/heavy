<article id="post-<?php echo $content->id; ?>" class="post" itemscope itemtype="http://schema.org/BlogPosting">
	<div class="content" itemprop="articleBody"><a href="<?php echo $content->permalink; ?>"><img src="<?php echo $content->info->keyimage; ?>"></a></div>

	<header class="metadata">
		<h1 itemprop="name"><a href="<?php echo $content->permalink; ?>" itemprop="url"><?php echo $content->title_out; ?></a></h1>
		<div class="pubdata">
			<time datetime="<?php echo $content->pubdate->format('Y-m-d\TH:i:s\Z'); ?>" itemprop="datePublished"><?php echo $content->pubdate->format(Options::get('dateformat') . ' ' . Options::get('timeformat')); ?></time><span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php echo $content->author->username; ?></span></span>
		</div>
	</header>

</article>
