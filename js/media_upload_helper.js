jQuery(document).ready(function($) {
    var postThumbnailSrc, postId, postTitle, button;
    // add a click handler to the media upload buttons
   $('.get-media').on('click', function() {
      // get the button object
      button = $(this); 
      console.log(button);
      
      // show the media upload thickbox
      tb_show('Upload Media', 'media-upload.php?referer=file-upload&type=file&TB_iframe=true', false);
      
      // after the thickbox has loaded
        $('#TB_iframeContent').load(function() {
            
            // attach a click handler to the 'Insert Into Post' button
            $('#TB_iframeContent').contents().find('#media-items').on('click', 'td.savesend input', function() {
                
                // get the source of the thumbnail
                postThumbnailSrc = $(this).closest('table').find('thead img.thumbnail').attr('src');
                console.log(postThumbnailSrc);
                // get the id of the post
                postId = $(this).attr('id').replace('send[', '').replace(']', '');
                console.log(postId);
                // get the title of the file
                postTitle = $(this).closest('tbody').find('tr.post_title td.field input').attr('value');
                console.log(postTitle);
            });
         
        });
        
    // when the editor is closed, remove the thickbox
    window.send_to_editor = function(html){
            // set the hidden input field to the media post id
            button.siblings('.media-id').val(postId);
            var preview = button.siblings('.preview');
            preview.removeClass('hidden').addClass('show-preview');
            preview.find('.image-preview').attr('src', postThumbnailSrc);
            preview.find('.title-preview').val(postTitle);
            tb_remove();
    };
    return false;
      
   });
   
   $('.delete-media').click(function() {
       console.log($(this).siblings('.media-id'));
       $(this).siblings('.media-id').val('');
       $(this).siblings('div.preview').addClass('hidden');
   });
});