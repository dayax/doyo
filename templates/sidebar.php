<?php get_template_part('templates/profile') ?>
<?php dynamic_sidebar('sidebar-primary'); ?>
<?php if(is_active_sidebar('sidebar-tab')): ?>
<div id="sidebar-tab">
    <ul id="sidebar-tab-list" class="nav nav-tabs"></ul>
    <div class="tab-content">
        <?php dynamic_sidebar('sidebar-tab'); ?>
    </div>
</div>
<?php endif;?>