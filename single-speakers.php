<?php
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$term = get_the_terms( $post->ID , 'Jahre' );
if(count($term) > 1){
  $term = array_pop($term);
} else {
  $term = $term[0];
}

$SpslugFull = explode('/', $current_url);
$SpslugFull = array_filter($SpslugFull);

$Spslug = $SpslugFull[count($SpslugFull)];
if ( function_exists('icl_object_id') ) {
  $url = home_url() . '/' . ICL_LANGUAGE_CODE . '/speaker/?j='.$term->name.'&r=' . $Spslug;
}else{
  $url = home_url() . '/speaker/?j='.$term->name.'&r=' . $Spslug;
}

wp_redirect( $url );
exit;
