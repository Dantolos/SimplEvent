<?php
/*
* Template Name: Tile Template 
*/
get_header();

$fW = get_field('tilepage_width');

$Tile = new TileClass;

?>
<style>
.se-header-title-placeholder{ height:0 !important; }
</style>

<div style="background-color:<?php echo get_field('background_color'); ?>; min-height:100vh;" >
    <div class="se-strip" style="background-image: url('<?php echo get_field('background_image'); ?>'); ">
        <div class="se-content">
            <div class="se-col-12" style="color:<?php echo get_field('text_color'); ?>;">
                <h1 ><?php echo the_title(); ?></h1>
                <p><?php echo the_content(); ?></p>
            </div>
        </div>
    </div>
    <div class="se-strip se-tile-strip">
        <div class="se-content" style="overflow:visible; display: flex; <?php if($fW) { echo 'width:100vw !important;'; } ?>">
            <?php 
                $Tile->getTile( get_field('kategorie') )
            ?>
        </div>
    </div>
</div>


<?php
get_footer();