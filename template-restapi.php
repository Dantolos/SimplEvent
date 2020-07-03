<?php
/*
 *Template Name: Rest API
 */
get_header();

$apiURL = get_field('restapi_url');
$apiFunction = get_field('function');

?>

<div class="se-strip se-tile-strip">
     <div  id="api_target" class="se-content">
          <!-- restAPI Request-->
     </div>
</div>

<script type='text/javascript' async>
     var apiURL = '<?php echo $apiURL ?>';
     var apiFunction = '<?php echo $apiFunction ?>';
     seREST = new seREST();
     seREST.callRestAPI(apiURL, apiFunction);
</script>
 
<?php
get_footer();
?>