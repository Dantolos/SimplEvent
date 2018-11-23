jQuery(document).ready(function($){

  //add WP Media Uploader
  var mediaUploader;

  $( '#upload-button' ).on('click',function(e){
    e.preventDefault();
    if ( mediaUploader ){
      mediaUploader.open();
      return;
    }

    //modify wp media frame
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose the Logo',
      button: {
        text: 'Choose Logo'
      },
      multible: false
    });

    mediaUploader.on('select', function(){
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#event-logo').val(attachment.url);
    });

    mediaUploader.open();
    
  });

});
