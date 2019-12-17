<?php

class TileClass {
    protected $finalTileContent;
    protected $kategorie;

    //theme colors
    protected $seMC;
    protected $seSC;
    protected $seWC;

    public function __construct(){
        $this->Clink = new LinkIcon;
        $this->seMC = esc_attr( get_option( 'main_color_picker' ) ) ;
        $this->seSC = esc_attr( get_option( 'second_color_picker' ) );
        $this->seWC = esc_attr( get_option( 'light_color_picker' ) );
    }

    public function getTile( $kategorie ) {
        $this->kategorie = $kategorie;

        $args = array(
            'post_type' => 'tile', 'orderby' => 'menu_order', 'order' => 'ASC',
            'tax_query' => array(
                array(
                  'taxonomy' => 'Type', 'field' => 'term_id', 'terms' => $this->kategorie,
                ),
            ),
        );
        $TileQuery = new WP_Query( $args );
       
        foreach( $TileQuery->posts as $Tile ) {
            $TileID = $Tile->ID;
            
            
            $this->finalTileContent .= '<div class="se-tile-container">';
            $this->finalTileContent .= '<a href="' . get_post_permalink( $TileID ) . '">';

            $this->finalTileContent .= '<div class="se-tile-bild image-settings" style="background-image: url(' . get_field( 'bild', $TileID ) . ');">';
            $this->finalTileContent .= '<div class="se-tile-flag se-mc-bg se-wc-txt"><p>'. get_field('tile_slug', $TileID) .'</p></div>';
            $this->finalTileContent .= '</div>';

            $this->finalTileContent .= '<div class="se-tile-content" style="color:' . $this->seWC . '; background-color:' . $this->seSC . ';">';
            while ( have_rows( 'tile_facts', $TileID ) ) : the_row();
                $this->finalTileContent .= '<p class="se-mc-txt">' . get_sub_field('tile_facts_datum', $TileID) . '</p>';
            endwhile;
            $this->finalTileContent .= '<h4>' . get_field('tile_titel', $TileID) . '</h4>';
            
            $this->finalTileContent .= '<p>' . get_field('tile_teasertext', $TileID) . '</p>';
            $this->finalTileContent .= '</div>';

            
            $this->finalTileContent .= '</a></div>';
           
        }

        echo $this->finalTileContent;
    }
}