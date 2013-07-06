<article <?php post_class(); ?>>
    <header class="post-header clearfix">
        <?php if(!is_null($subtitle=dyPostMeta('doyo_subtitle'))): ?>
        <span class="post-subtitle"><?php echo $subtitle; ?></span>
        <?php endif; ?>
        <h2 class="entry-title"><a href="<?php echo dyGetPostLink(); ?>"><?php the_title(); ?></a></h2> 
        <?php get_template_part('templates/_post_meta')?>
    </header>
    <div class="entry-summary clearfix">
        <?php get_template_part("templates/_featured-image"); ?>   
        <?php the_excerpt(); ?>
        <span class="read-more"><a href="<?php echo dyGetPostLink()?>"><i class="icon-file-text"></i><?php echo __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'doyo' )?></a></span>
    </div>
    <footer class="clearfix">        
        <?php get_template_part('templates/_post_link')?>
    </footer>
</article>