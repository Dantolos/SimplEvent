<?php
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$term = get_the_terms( $post->ID , 'Jahre' );
if(count($term) > 1){
  $term = array_pop($term);
} else {
  $term = $term[0];
}

$Spslug = explode('/', $current_url);
$Spslug = $Spslug[count($Spslug) - 1];
$url = home_url() . '/speaker/?j='.$term->name.'&r=' . $Spslug;

wp_redirect( $url );
exit;
