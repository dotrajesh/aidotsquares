<?php 
/********************Client Status Meta Box**********************/
add_action('admin_init', 'ai_client_status_meta_boxes', 2);

function ai_client_status_meta_boxes() {

    if((!empty($_GET['post'])) || (!empty($_POST['post_ID'])) ){
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
        $post = get_post($post_id);
        $post_slug = $post->post_name;
        // checks for post/page slug.
        if ( $post_slug == 'front-page') {
            add_meta_box( 'ai-client-status', 'Client Status', 'Client_meta_box_display', 'page', 'normal', 'default');
        }
      //add_action( 'add_meta_boxes_ai_partner_slide', 'ai_add_meta_slide' );
    }
}

function Client_meta_box_display(){ 
    
    global $post;
    $clientstatus_group = get_post_meta($post->ID, 'clientstatus_group', true);
    wp_nonce_field( 'clientstatus_meta_box_nonce', 'clientstatus_meta_box_nonce' );
    ?>

<style>
table.repetable-table {
    width: 100%;
}

table.repetable-table {
    vertical-align: middle;
}

td.repetable-colomn.remove-colomn {
    text-align: center;
}

.image-preview {
    width: 150px;
    height: 150px;
    display: block ruby;
    border: 1px solid;
    padding: 5px;
}

.image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-preview .acf-icon.-cancel.dark.clientimg-remove {
    left: -30px;
    opacity: 0;
}

.image-preview:hover .acf-icon.-cancel.dark.clientimg-remove {
    opacity: 1;
}

.acf-input .image-preview {
    position: relative;
}

.acf-input a.acf-icon.-cancel.dark.clientimg-remove {
  position: absolute;
  left: 80%;
  top: 3px;
}
</style>
<script>
jQuery(document).ready(function() {
    jQuery('#add-row').click(function() {
        let Row = `<tr class='repetable-row'>
                                <td class='repetable-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                <input type="text"  name="heading[]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Sub Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                <input type="text"  name="subheading[]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Image</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                <a class='button insertImage' href='javascript:void(0)'>Add Image</a>
                                                    <input type="hidden" class='imgSibling' name="imge[]">
                                                </div>
                                                <div class='image-preview' style='display:none'>
                                                    <img src=''>
                                                    <a class="acf-icon -cancel dark clientimg-remove" data-name="remove" href="#" title="Remove"></a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </td>
                                <td class='repetable-colomn remove-colomn' width="10%">
                                    <a class='removeButton remove button' href='javascript:void(0)'>-</a>
                                </td>
                            </tr>`;
        jQuery('.repetable-table').append(Row);
    });

    jQuery(document).on('click', '.removeButton', function() {
        jQuery(this).parents('.repetable-row').remove();
    });
});

jQuery(document).on('click', '.insertImage', function() {
    let that = jQuery(this);
    var upload = wp.media({
            title: 'Choose Image', //Title for Media Box
            multiple: true, //For limiting multiple image
            library: {
                type: ['image']
            },
        })
        .on('select', function() {
            var select = upload.state().get('selection');
            var attach = select.first().toJSON();
            that.siblings('.imgSibling').val(attach.id);
            that.parent('.acf-input-wrap').siblings('.image-preview').find('img').attr('src', attach.url);
            that.parent('.acf-input-wrap').siblings('.image-preview').show();
            that.parent('.acf-input-wrap').siblings('.image-preview').find('.clientimg-remove').show();
            that.hide();

        })
        .open();

});
jQuery(document).on('click', '.clientimg-remove', function() {
    jQuery(this).siblings('img').attr('src', '');
    jQuery(this).parent('.image-preview').siblings('.acf-input-wrap').find('.imgSibling').val('');
    jQuery(this).parent('.image-preview').siblings('.acf-input-wrap').find('.insertImage').show();
    jQuery(this).parent('.image-preview').hide();
    jQuery(this).hide();

});
</script>

<div class="acf-fields">
    <div class="acf-field">
        <div class="acf-label">
            <label for="ai_partner_slide">Client Details</label>
        </div>
        <div class="acf-input-heading">
            <div class="acf-fields -border">
                <div class="acf-field acf-field-text " data-name="partner-logos-heading" data-type="text">
                    <table class='repetable-table table table-bordered' style="width:100%">
                        <tbody>
                            <?php if($clientstatus_group){
                            foreach($clientstatus_group as $key => $data){ ?>

                            <tr class='repetable-row'>
                                <td class='repetable-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="heading[]"
                                                        value='<?php  if(!empty($data['heading'])) echo $data['heading'] ?>'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Sub Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="subheading[]"
                                                        value='<?php if(!empty($data['subheading'])) echo $data['subheading'] ?>'>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Image</label>
                                            </div>
                                            <div class="acf-input">
                                            <?php if((isset($data['imge'])) && (!empty($data['imge']))){
                                                    $imgID =$data['imge'];

                                                }else{
                                                    $imgID ='';
                                                } ?>

                                                <div class="acf-input-wrap">
                                                    <?php if(!empty($imgID)){ ?>
                                                    <a class='button insertImage' href='javascript:void(0)'
                                                        style='display:none'>Add Image</a>
                                                   <?php }else{ ?>
                                                    <a class='button insertImage' href='javascript:void(0)'
                                                   >Add Image</a>
                                                  <?php } ?>
                                                  <input type="hidden" class='imgSibling' name="imge[]"
                                                        value='<?php  if(!empty($imgID)) echo $imgID; ?>'>
                                                </div>
                                                <?php 
                                                   if(!empty($imgID)){
                                                    $imgUrl = wp_get_attachment_image_url( $imgID, array( 80, 80 ) ); 
                                                    ?>
                                                <div class='image-preview'>
                                                    <img src='<?php echo $imgUrl; ?>'>
                                                    <a class="acf-icon -cancel dark clientimg-remove" data-name="remove"
                                                        href="#" title="Remove"></a>
                                                </div>
                                                <?php }else{ ?>
                                                    <div class='image-preview' style='display:none'>
                                                    <img src=''>
                                                    <a class="acf-icon -cancel dark clientimg-remove" data-name="remove"
                                                        href="#" title="Remove"></a>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class='repetable-colomn remove-colomn' width="10%">
                                    <?php if($key==0){}else{
                                        echo "<a class='removeButton remove button' href='javascript:void(0)'>-</a>";
                                    } ?>
                                </td>
                            </tr>

                            <?php  }
                            }else{ ?>
                            <tr class='repetable-row'>
                                <td class='repetable-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="heading[]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Sub Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="subheading[]">
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Image</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <a class='button insertImage' href='javascript:void(0)'>Add
                                                        Image</a>
                                                    <input type="hidden" class='imgSibling' name="imge[]">
                                                </div>
                                                <div class='image-preview' style='display:none'>
                                                    <img src=''>
                                                    <a class="acf-icon -cancel dark clientimg-remove" data-name="remove"
                                                        href="#" title="Remove"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class='repetable-colomn remove-colomn' width="10%">
                                    <a class='removeButton remove button' href='javascript:void(0)'  style='display:none'>-</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<p><a id="add-row" class="button" href="javascript:void(0)">Add another</a></p>
<?php
}

add_action('save_post','Client_meta_box_show');

function Client_meta_box_show($post_id){

    if ( ! isset( $_POST['clientstatus_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['clientstatus_meta_box_nonce'], 'clientstatus_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'clientstatus_group', true);
    $new = array();
    $heading = $_POST['heading'];
    $subheading = $_POST['subheading'];
    $imge =$_POST['imge'];
    $url =$_POST['url'];
     $count = count( $heading );
     for ( $i = 0; $i < $count; $i++ ) {
        if ( $heading[$i] != '' ) :
            $new[$i]['heading'] = stripslashes( strip_tags( $heading[$i] ) );
        endif;

        if ( $subheading[$i] != '' ) :
            $new[$i]['subheading'] = stripslashes( strip_tags($subheading[$i] ) );
        endif;
        if ( $imge[$i] != '' ) :
            $new[$i]['imge'] = stripslashes( strip_tags( $imge[$i] ) );
        endif;

    }
    //update_post_meta( $post_id, 'clientstatus_group', '' );
    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'clientstatus_group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'clientstatus_group', $old );
}



/********************Development Meta Box**********************/
add_action('admin_init', 'ai_development_meta_boxes', 2);

function ai_development_meta_boxes() {

    if((!empty($_GET['post'])) || (!empty($_POST['post_ID'])) ){
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
        $post = get_post($post_id);
        $post_slug = $post->post_name;
        // checks for post/page slug.
        if ( $post_slug == 'front-page') {
            add_meta_box( 'ai-development', 'Data Science', 'development_meta_box_display', 'page', 'normal', 'default');
        }
      //add_action( 'add_meta_boxes_ai_partner_slide', 'ai_add_meta_slide' );
    }
}

function development_meta_box_display(){ 
    global $post;
    $development_group = [];
    if(metadata_exists('post', $post->ID, 'development_group')) {
        $development_group= get_post_meta($post->ID, 'development_group', true);
    }
    wp_nonce_field( 'deveopment_meta_box_nonce', 'deveopment_meta_box_nonce' );
    ?>

<style>
table.development-table {
    width: 100%;
}

table.development-table {
    vertical-align: middle;
}

td.development-colomn.remove-colomn {
    text-align: center;
}

.development-image-preview {
    width: 150px;
    height: 150px;
    display: block ruby;
    border: 1px solid;
    padding: 5px;
}

.development-image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.development-image-preview .acf-icon.-cancel.dark.development-remove {
    left: -30px;
    opacity: 0;
}

.development-image-preview:hover .acf-icon.-cancel.dark.development-remove {
    opacity: 1;
}

.development-image-preview .acf-icon.-cancel.dark.development-head-remove {
    left: -30px;
    opacity: 0;
}

.development-image-preview:hover .acf-icon.-cancel.dark.development-head-remove {
    opacity: 1;
}

.acf-input .image-preview {
    position: relative;
}

.acf-input a.acf-icon.-cancel.dark.development-remove {
  position: absolute;
  left: 11%;
  top: 3px;
}
.acf-input a.acf-icon.-cancel.dark.development-head-remove {
  position: absolute;
  left: 12%;
  top: 3px;
}
</style>
<script>
jQuery(document).ready(function() {
    jQuery('#add-row-development').click(function() {
        let Row = `<tr class='development-row'>
                                <td class='development-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                <input type="text"  name="dheading[]">
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Color Class</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text"  name="colorClass[]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Image</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                <a class='button insertImage-development' href='javascript:void(0)'>Add Image</a>
                                                    <input type="hidden" class='imgSibling' name="dimge[]">
                                                </div>
                                                <div class='development-image-preview' style='display:none'>
                                                    <img src=''>
                                                    <a class="acf-icon -cancel dark development-remove" data-name="remove" href="#" title="Remove"></a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </td>
                                <td class='development-colomn remove-colomn' width="10%">
                                    <a class='removeButton remove button' href='javascript:void(0)'>-</a>
                                </td>
                            </tr>`;
        jQuery('.development-table').append(Row);
    });

    jQuery(document).on('click', '.removeButton', function() {
        jQuery(this).parents('.development-row').remove();
    });
});

jQuery(document).on('click', '.insertImage-development', function() {
    let that = jQuery(this);
    var upload = wp.media({
            title: 'Choose Image', //Title for Media Box
            multiple: true, //For limiting multiple image
            library: {
                type: ['image']
            },
        })
        .on('select', function() {
            var select = upload.state().get('selection');
            var attach = select.first().toJSON();
            that.siblings('.imgSibling').val(attach.id);
            that.parent('.acf-input-wrap').siblings('.development-image-preview').find('img').attr('src',
                attach.url);
            that.parent('.acf-input-wrap').siblings('.development-image-preview').show();
            that.parent('.acf-input-wrap').siblings('.development-image-preview').find(
                '.development-remove').show();
            that.hide();

        })
        .open();

});

jQuery(document).on('click', '.insertImage-development-head', function() {
    let that = jQuery(this);
    var upload = wp.media({
            title: 'Choose Image', //Title for Media Box
            multiple: true, //For limiting multiple image
            library: {
                type: ['image']
            },
        })
        .on('select', function() {
            var select = upload.state().get('selection');
            var attach = select.first().toJSON();
            that.siblings('.imgSibling').val(attach.id);
            that.parent('.acf-input-wrap').siblings('.development-image-preview').find('img').attr('src',
                attach.url);
            that.parent('.acf-input-wrap').siblings('.development-image-preview').show();
            //that.parent('.acf-input-wrap').siblings('.development-image-preview').find('.development-remove').show();
            that.parent('.acf-input-wrap').siblings('.development-image-preview').find(
                '.development-head-remove').show();
            that.hide();

        })
        .open();

});

jQuery(document).on('click', '.development-remove', function() {
    jQuery(this).siblings('img').attr('src', '');
    jQuery(this).parent('.development-image-preview').siblings('.acf-input-wrap').find('.imgSibling').val('');
    jQuery(this).parent('.development-image-preview').siblings('.acf-input-wrap').find(
        '.insertImage-development').show();
    jQuery(this).parent('.development-image-preview').hide();
    jQuery(this).hide();

});

jQuery(document).on('click', '.development-head-remove', function() {
    jQuery(this).siblings('img').attr('src', '');
    jQuery(this).parent('.development-image-preview').siblings('.acf-input-wrap').find('.imgSibling').val('');
    jQuery(this).parent('.development-image-preview').siblings('.acf-input-wrap').find(
        '.insertImage-development-head').show();
    jQuery(this).parent('.development-image-preview').hide();
    jQuery(this).hide();

});
</script>

<div class="acf-fields">
    <div class="acf-field">
        <div class="acf-label">
            <label>Data Science</label>
        </div>
        <div class="acf-input-heading">
            <div class="acf-fields -left -border">
                <div class="acf-field acf-field-text ">
                    <div class="acf-label">
                        <label>Data Head</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap first-img">
                            <?php if(!empty($development_group)){ ?>
                                <input type='text'
                                value='<?php if(!empty($development_group['head-data']['data-heading'])) echo $development_group['head-data']['data-heading']; ?>'
                                name='data-heading' class='data-heading'>

                           <?php }else{ ?>
                            <input type='text' value='' name='data-heading' class='data-heading'>
                          <?php } ?>
                            
                        </div>

                        <div class='acf-fields'>
                            <div class="acf-label">
                                <label>Image</label>
                            </div>
                            <div class="acf-input">
                                <div class="acf-input-wrap">
                                    <?php if(empty($development_group)){ ?>
                                        <a class='button insertImage-development-head' href='javascript:void(0)'>Add
                                        Image</a>
                                        <input type="hidden" class='imgSibling' name="data-imge"
                                        value='<?php  if(!empty($imgID)) echo $imgID ?>'>

                                    <?php }else{
                                        if(isset($development_group['head-data']['data-imge'])){
                                            $imgID = $development_group['head-data']['data-imge'];
                                        }else{
                                            $imgID = '';
                                        }
                                       
                                    if(!empty($imgID)){ ?>
                                        <a class='button insertImage-development-head' href='javascript:void(0)'
                                        style='display:none'>Add Image</a>
                                   <?php }else{ ?>
                                    <a class='button insertImage-development-head' href='javascript:void(0)'>Add
                                        Image</a>
                                    <?php  }?>
                                    <!---->
                                    <input type="hidden" class='imgSibling' name="data-imge"
                                        value='<?php  if(!empty($imgID)) echo $imgID ?>'>
                                    
                                </div>
                                <?php if(!empty($imgID)){ ?>
                                    <div class='development-image-preview'>
                                    <?php  
                                    if(!empty($imgID)){
                                        $imgUrl = wp_get_attachment_image_url( $imgID, array( 80, 80 ) );                                                        ?>
                                    <img src='<?php echo $imgUrl; ?>'>
                                    <a class="acf-icon -cancel dark development-head-remove" data-name="remove" href="#"
                                        title="Remove"></a>
                                    <?php }  ?>
                                </div>
                               <?php }else{ ?>

                                <div class='development-image-preview' style='display:none'>
                                    <img src='' />
                                    <a class="acf-icon -cancel dark development-head-remove" data-name="remove" href="#"
                                        title="Remove"></a>
                                </div>  
                               <?php }
                             } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="acf-input-heading">
            <div class="acf-fields -border">
                <div class="acf-field acf-field-text ">
                    <table class='development-table table table-bordered' style="width:100%">
                        <tbody>
                            <?php if(isset($development_group['repeat-data'])){
                            foreach($development_group['repeat-data'] as $key => $data){ ?>

                            <tr class='development-row'>
                                <td class='development-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="dheading[]"
                                                        value='<?php  if((isset($data['dheading']))&&(!empty($data['dheading']))) echo $data['dheading'] ?>'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Color Class</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="colorClass[]"
                                                        value='<?php  if((isset($data['colorClass']))&&(!empty($data['colorClass']))) echo $data['colorClass'] ?>'>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Image</label>
                                            </div>
                                            <div class="acf-input">
                                                <?php if((isset($data['dimge'])) && (!empty($data['dimge']))){
                                                    $imgID =$data['dimge'];

                                                }else{
                                                    $imgID ='';
                                                } ?>

                                                <div class="acf-input-wrap">
                                                    <?php if(!empty($imgID)){ ?>
                                                    <a class='button insertImage-development' href='javascript:void(0)'
                                                        style='display:none'>Add Image</a>
                                                   <?php }else{ ?>
                                                    <a class='button insertImage-development' href='javascript:void(0)'
                                                   >Add Image</a>
                                                  <?php } ?>
                                                  <input type="hidden" class='imgSibling' name="dimge[]"
                                                        value='<?php  if(!empty($imgID)) echo $imgID; ?>'>
                                                </div>
                                                <?php 
                                                   if(!empty($imgID)){
                                                    $imgUrl = wp_get_attachment_image_url( $imgID, array( 80, 80 ) ); 
                                                    ?>
                                                <div class='development-image-preview'>
                                                    <img src='<?php echo $imgUrl; ?>'>
                                                    <a class="acf-icon -cancel dark development-remove" data-name="remove" href="#" title="Remove"></a>
                                                </div>
                                                <?php }else{ ?>
                                                    <div class='development-image-preview' style='display:none'>
                                                    <img src=''>
                                                    <a class="acf-icon -cancel dark development-remove" data-name="remove" href="#" title="Remove"></a>
                                                </div>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class='development-colomn remove-colomn' width="10%">
                                    <?php if($key=='0'){

                                    }else{
                                        echo "<a class='removeButton remove button' href='javascript:void(0)'>-</a>";
                                    } ?>
                                    
                                </td>
                            </tr>

                            <?php  }
                            }else{ ?>
                            <tr class='development-row'>
                                <td class='development-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="dheading[]">
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Color Class</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="colorClass[]">
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Image</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <a class='button insertImage-development'
                                                        href='javascript:void(0)'>Add Image</a>
                                                    <input type="hidden" class='imgSibling' name="dimge[]">
                                                </div>
                                                <div class='development-image-preview' style='display:none'>
                                                    <img src=''>
                                                    <a class="acf-icon -cancel dark development-remove"
                                                        data-name="remove" href="#" title="Remove"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class='development-colomn remove-colomn' width="10%">
                                    <a class='removeButton remove button' href='javascript:void(0)' style='display:none'>-</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<p><a id="add-row-development" class="button" href="javascript:void(0)">Add another</a></p>
<?php
}

add_action('save_post','development_meta_box_show');

function development_meta_box_show($post_id){

    if ( ! isset( $_POST['deveopment_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['deveopment_meta_box_nonce'], 'deveopment_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'development_group', true);
    $new = array();
    $dataHeading =$_POST['data-heading'];
    $dataImage =$_POST['data-imge'];
    $heading = $_POST['dheading'];
    $colorClass = $_POST['colorClass'];
    $imge =$_POST['dimge'];
     $count = count( $heading );

    if($dataHeading != ''){
        $new['head-data']['data-heading'] =stripslashes( strip_tags($dataHeading) );
    }
    if($dataImage != ''){
        $new['head-data']['data-imge'] =stripslashes( strip_tags($dataImage));
    }    


     for ( $i = 0; $i < $count; $i++ ) {
        if ( $heading[$i] != '' ) :
            $new['repeat-data'][$i]['dheading'] = stripslashes( strip_tags( $heading[$i] ) );
        endif;

        if ( $colorClass[$i] != '' ) :
            $new['repeat-data'][$i]['colorClass'] = stripslashes( strip_tags( $colorClass[$i] ) );
        endif;
        if ( $imge[$i] != '' ) :
            $new['repeat-data'][$i]['dimge'] = stripslashes( strip_tags( $imge[$i] ) );
        endif;

    }
    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'development_group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'development_group', $old );
}


/********************Service Meta Box**********************/
add_action('admin_init', 'ai_service_meta_boxes', 2);

function ai_service_meta_boxes() {

    if((!empty($_GET['post'])) || (!empty($_POST['post_ID'])) ){
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
        $post = get_post($post_id);
        $post_slug = $post->post_name;
        // checks for post/page slug.
        if ( $post_slug == 'front-page') {
            add_meta_box( 'ai-service', 'Service Section', 'service_meta_box_display', 'page', 'normal', 'default');
        }
      //add_action( 'add_meta_boxes_ai_partner_slide', 'ai_add_meta_slide' );
    }
}

function service_meta_box_display(){ 
    global $post;
    $service_group = [];
    if(metadata_exists('post', $post->ID, 'service_group')) {
        $service_group= get_post_meta($post->ID, 'service_group', true);
    }
    wp_nonce_field( 'service_meta_box_nonce', 'service_meta_box_nonce' );
    ?>

<style>
table.service-table {
    width: 100%;
}

table.service-table {
    vertical-align: middle;
}

td.service-colomn.remove-colomn {
    text-align: center;
}

.service-image-preview {
    width: 150px;
    height: 150px;
    display: block ruby;
    border: 1px solid;
    padding: 5px;
}

.service-image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.service-image-preview .acf-icon.-cancel.dark.service-remove {
    left: -30px;
    opacity: 0;
}

.service-image-preview:hover .acf-icon.-cancel.dark.service-remove {
    opacity: 1;
}

.acf-input .image-preview {
    position: relative;
}
.acf-input a.acf-icon.-cancel.dark.service-remove {
  position: absolute;
  left: 11%;
  top: 3px;
}
</style>
<script>
jQuery(document).ready(function() {
    jQuery('#add-row-service').click(function() {
        let Row = `<tr class='service-row'>
                                <td class='service-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                <input type="text"  name="sheading[]">
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Url</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text"  name="surl[]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Image</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                <a class='button insertImage-service' href='javascript:void(0)'>Add Image</a>
                                                    <input type="hidden" class='imgSibling' name="simge[]">
                                                </div>
                                                <div class='service-image-preview' style='display:none'>
                                                    <img src=''>
                                                    <a class="acf-icon -cancel dark service-remove" data-name="remove" href="#" title="Remove"></a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </td>
                                <td class='service-colomn remove-colomn' width="10%">
                                    <a class='removeButton remove button' href='javascript:void(0)'>-</a>
                                </td>
                            </tr>`;
        jQuery('.service-table').append(Row);
    });

    jQuery(document).on('click', '.removeButton', function() {
        jQuery(this).parents('.service-row').remove();
    });
});

jQuery(document).on('click', '.insertImage-service', function() {
    let that = jQuery(this);
    var upload = wp.media({
            title: 'Choose Image', //Title for Media Box
            multiple: true, //For limiting multiple image
            library: {
                type: ['image']
            },
        })
        .on('select', function() {
            var select = upload.state().get('selection');
            var attach = select.first().toJSON();
            that.siblings('.imgSibling').val(attach.id);
            that.parent('.acf-input-wrap').siblings('.service-image-preview').find('img').attr('src', attach
                .url);
            that.parent('.acf-input-wrap').siblings('.service-image-preview').show();
            that.parent('.acf-input-wrap').siblings('.service-image-preview').find('.service-remove')
                .show();
            that.hide();

        })
        .open();

});

jQuery(document).on('click', '.insertImage-service-head', function() {
    let that = jQuery(this);
    var upload = wp.media({
            title: 'Choose Image', //Title for Media Box
            multiple: true, //For limiting multiple image
            library: {
                type: ['image']
            },
        })
        .on('select', function() {
            var select = upload.state().get('selection');
            var attach = select.first().toJSON();
            that.siblings('.imgSibling').val(attach.id);
            that.parent('.acf-input-wrap').siblings('.service-image-preview').find('img').attr('src', attach
                .url);
            that.parent('.acf-input-wrap').siblings('.service-image-preview').show();
            //that.parent('.acf-input-wrap').siblings('.development-image-preview').find('.development-remove').show();
            that.parent('.acf-input-wrap').siblings('.service-image-preview').find('.service-head-remove')
                .show();
            that.hide();

        })
        .open();
});

jQuery(document).on('click', '.service-remove', function() {
    jQuery(this).siblings('img').attr('src', '');
    jQuery(this).parent('.service-image-preview').siblings('.acf-input-wrap').find('.imgSibling').val('');
    jQuery(this).parent('.service-image-preview').siblings('.acf-input-wrap').find('.insertImage-service')
        .show();
    jQuery(this).parent('.service-image-preview').hide();
    jQuery(this).hide();

});

jQuery(document).on('click', '.service-head-remove', function() {
    jQuery(this).siblings('img').attr('src', '');
    jQuery(this).parent('.service-image-preview').siblings('.acf-input-wrap').find('.imgSibling').val('');
    jQuery(this).parent('.service-image-preview').siblings('.acf-input-wrap').find('.insertImage-service-head')
        .show();
    jQuery(this).parent('.service-image-preview').hide();
    jQuery(this).hide();

});
</script>

<div class="acf-fields">
    <div class="acf-field">
        <div class="acf-label">
            <label>Services</label>
        </div>
        <div class="acf-input-heading">
            <div class="acf-fields -left -border">
                <div class="acf-field acf-field-text ">
                    <div class="acf-label">
                        <label>Service Head</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap first-img">
                            <input type='text'
                                value='<?php if(!empty($service_group['head-service']['data-service'])) echo $service_group['head-service']['data-service']; ?>'
                                name='data-service' class='data-service'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="acf-input-heading">
            <div class="acf-fields -border">
                <div class="acf-field acf-field-text ">
                    <table class='service-table table table-bordered' style="width:100%">
                        <tbody>

                            <?php if((!empty($service_group)) && (isset($service_group['service-data']))){
                            foreach($service_group['service-data'] as $key => $data){ ?>

                            <tr class='service-row'>
                                <td class='service-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="sheading[]"
                                                        value='<?php  if(!empty($data['sheading'])) echo $data['sheading'] ?>'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Url</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="surl[]"
                                                        value='<?php  if(!empty($data['surl'])) echo $data['surl'] ?>'>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Image</label>
                                            </div>
                                            <div class="acf-input">
                                            <?php if((isset($data['simge'])) && (!empty($data['simge']))){
                                                    $imgID =$data['simge'];

                                                }else{
                                                    $imgID ='';
                                                } ?>

                                                <div class="acf-input-wrap">
                                                    <?php if(!empty($imgID)){ ?>
                                                    <a class='button insertImage-service' href='javascript:void(0)'
                                                        style='display:none'>Add Image</a>
                                                   <?php }else{ ?>
                                                    <a class='button insertImage-service' href='javascript:void(0)'
                                                   >Add Image</a>
                                                  <?php } ?>
                                                  <input type="hidden" class='imgSibling' name="simge[]"
                                                        value='<?php  if(!empty($imgID)) echo $imgID; ?>'>
                                                </div>
                                                <?php 
                                                   if(!empty($imgID)){
                                                    $imgUrl = wp_get_attachment_image_url( $imgID, array( 80, 80 ) ); 
                                                    ?>
                                                <div class='service-image-preview imagePreview'>
                                                    <img src='<?php echo $imgUrl; ?>'>
                                                    <a class="acf-icon -cancel dark service-remove" data-name="remove"
                                                        href="#" title="Remove"></a>
                                                </div>
                                                <?php }else{ ?>
                                                    <div class='service-image-preview imagePreview' style='display:none'>
                                                    <img src=''>
                                                    <a class="acf-icon -cancel dark service-remove" data-name="remove"
                                                        href="#" title="Remove"></a>
                                                </div>
                                                <?php } ?>



                                                <?php /*
                                                <div class="acf-input-wrap">
                                                    <a class='button insertImage-service' href='javascript:void(0)'
                                                        style='display:none'>Add Image</a>
                                                    <input type="hidden" class='imgSibling' name="simge[]"
                                                        value='<?php  if(!empty($data['simge'])) echo $data['simge'] ?>'>
                                                </div>
                                                <div class='service-image-preview imagePreview'>
                                                    <?php $imgID = $data['simge'];
                                                   if(!empty($imgID)){
                                                        $imgUrl = wp_get_attachment_image_url( $imgID, array( 80, 80 ) );                                                        ?>
                                                    <img src='<?php echo $imgUrl; ?>'>
                                                    <a class="acf-icon -cancel dark service-remove" data-name="remove"
                                                        href="#" title="Remove"></a>
                                                    <?php } ?>
                                                </div>
                                                <?php */ ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class='service-colomn remove-colomn' width="10%">
                                    <?php if($key =='0'){

                                    }else{
                                        echo "<a class='removeButton remove button' href='javascript:void(0)'>-</a>";
                                    } ?>
                                    
                                </td>
                            </tr>

                            <?php  }
                            }else{ ?>
                            <tr class='service-row'>
                                <td class='service-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="sheading[]">
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Url</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" name="surl[]">
                                                </div>
                                            </div>
                                        </div>

                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Image</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <a class='button insertImage-service' href='javascript:void(0)'>Add
                                                        Image</a>
                                                    <input type="hidden" class='imgSibling' name="simge[]">
                                                </div>
                                                <div class='service-image-preview imagePreview' style='display:none'>
                                                    <img src=''>
                                                    <a class="acf-icon -cancel dark service-remove" data-name="remove"
                                                        href="#" title="Remove"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class='service-colomn remove-colomn' width="10%">
                                    <a class='removeButton remove button' href='javascript:void(0)' style='display:none'>-</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<p><a id="add-row-service" class="button" href="javascript:void(0)">Add another</a></p>
<?php
}

add_action('save_post','service_meta_box_show');

function service_meta_box_show($post_id){

    if ( ! isset( $_POST['service_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['service_meta_box_nonce'], 'service_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'service_group', true);
    $new = array();
    $dataHeading =$_POST['data-service'];
    $heading = $_POST['sheading'];
    $url = $_POST['surl'];
    $imge =$_POST['simge'];
     $count = count( $heading );

    if($dataHeading != ''){
        $new['head-service']['data-service'] =stripslashes( strip_tags($dataHeading) );
    }
   

     for ( $i = 0; $i < $count; $i++ ) {
        if ( $heading[$i] != '' ) :
            $new['service-data'][$i]['sheading'] = stripslashes( strip_tags( $heading[$i] ) );
        endif;

        if ( $url[$i] != '' ) :
            $new['service-data'][$i]['surl'] = stripslashes( strip_tags( $url[$i] ) );
        endif;
        if ( $imge[$i] != '' ) :
            $new['service-data'][$i]['simge'] = stripslashes( strip_tags( $imge[$i] ) );
        endif;

    }

    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'service_group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'service_group', $old );
}

add_action('admin_init', 'ai_casestudy_post_meta_boxes', 2);

function ai_casestudy_post_meta_boxes() {
    add_meta_box( 'ai-casetudy_post', 'Content Section', 'casestudy_post_meta_box_display', 'casestudies', 'normal', 'default');
}


add_action('wp_ajax_getMultipleMetaBoxCustom', 'getMultipleMetaBoxCustom'); 
function getMultipleMetaBoxCustom(){
	if(isset($_POST['randGenId'])) {
		$randGenId = $_POST['randGenId'];
        $textID = $_POST['textID'];
		$wpEditor =  wp_editor('',$randGenId,$settings = array('textarea_name'=> $textID.'[]'));
		echo $wpEditor;
		wp_die();
    }
}	

function casestudy_post_meta_box_display(){
    global $post;
    $ctpost_group = get_post_meta($post->ID, 'casestudypost_group', true);
    wp_nonce_field( 'casestudypost_meta_box_nonce', 'casestudypost_meta_box_nonce' );
	?>
<style>
table.custudy-post-table {
    width: 100%;
}

table.custudy-post-table {
    vertical-align: middle;
}

td.service-colomn.remove-colomn {
    text-align: center;
}

/* .csp-image-preview .removeDiv img {
    max-width: 70%;
} */

.csp-image-preview {
    display: flex !important;

}

.csp-image-preview .removeDiv {
    position: relative;
    display: flex;
    margin: 2px;
}

.csp-image-preview .removeDiv a.acf-icon.-cancel.dark.csp-remove {
    margin-left: -27px;
    opacity: 0;
}

.csp-image-preview .removeDiv:hover a.acf-icon.-cancel.dark.csp-remove {
    opacity: 1;
}

.applictions {
    margin: 15px;
}

.removeDiv {
    max-width: 200px;
    max-height: 200px;
    display: flex;
    border: 1px solid;
    padding: 2px;
    position: relative;
}

.removeDiv img {
    width: 100%;
    object-fit: cover;
}

.removeDiv .removeImg {
    opacity: 0;
    position: absolute;
    top: 0;
    right: 0;
}

.removeDiv:hover .removeImg {
    opacity: 1;
}
</style>

<script>
jQuery(document).ready(function() {
    // CKEDITOR.replace('pcontent');

    jQuery('#add-row-custudy-post').click(function() {
        let RowLength = jQuery('.custudy-post-row').length;
        var randGenId = 'pcontent' + RowLength;
        var AJAX_URL = '<?php echo admin_url( "admin-ajax.php" ); ?>';
        jQuery.ajax({
            type: "POST",
            url: AJAX_URL,
            data: {
                'action': 'getMultipleMetaBoxCustom',
                randGenId: randGenId,
                textID: 'pcontent'
            },
            success: function(data) {

                var newData = `<tr class="custudy-post-row">
                    <td class="custudy-post-colomn" style="width:90%">
                        <div class="acf-input">
                            <div class="acf-fields">
                                <div class="acf-label">
                                    <label>Heading</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                    <input type="text" class="form-control" name="cpheading[]">
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="acf-input">
                            <div class="acf-fields">
                                <div class="acf-label">
                                    <label>Description</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">` + data + ` 
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class='acf-fields'>
                            <div class="acf-label">
                                <label>Images</label>
                            </div>
                            <div class="acf-input">
                                <div class="acf-input-wrap">
                                    <a class='button insertImage-csp' href='javascript:void(0)'>Add Image</a>
                                    <input type="hidden" class='imgSibling' name="cspimge[]">
                                </div>
                                <div class='csp-image-preview' style='display:none'>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="custudy-post-colomn remove-colomn" width="10%">
                        <a class="removeButton remove button" href="javascript:void(0)">-</a>
                    </td>
                </tr>`;

                jQuery('.custudy-post-table').append(newData);
                //window.QTags({'id': randGenId, 'buttons': "strong,em,link,block,del,ins,img,ul,ol,li,code,more,close"});
                tinyMCE.execCommand('mceAddEditor', false, randGenId);
            }
        });
    });

    jQuery(document).on('click', '.removeButton', function() {
        jQuery(this).closest('tr').remove();
    });



    jQuery(document).on('click', '.insertImage-csp', function() {
        let that = jQuery(this);
        var upload = wp.media({
                title: 'Choose Image', //Title for Media Box
                multiple: true, //For limiting multiple image
                library: {
                    type: ['image']
                },
            })
            .on('select', function() {
                var select = upload.state().get('selection');
                var attach = select.first().toJSON();
                var Data = select.toJSON();
                let oldVal = that.siblings('.imgSibling').val();
                let oldArry = '';
                if (oldVal != '') {
                    oldArry = oldVal.split(',');
                } else {
                    oldArry = [];
                }
                Data.map(function(arr) {
                    //console.log('id',arr.id );
                    oldArry.push(arr.id);
                    that.parent('.acf-input-wrap').siblings('.csp-image-preview').append(
                        '<div class="removeDiv"><img src="' + arr.url +
                        '"><a class="acf-icon -cancel dark csp-remove" data-name="remove" href="#" title="Remove" data-ID="' +
                        arr.id + '"></a></div>');
                });
                that.parent('.acf-input-wrap').siblings('.csp-image-preview').show();
                // console.log(arrId);
                that.siblings('.imgSibling').val(oldArry);
                console.log(oldArry);

            })
            .open();
    });

    jQuery(document).on('click', '.csp-remove', function() {
        let ImgID = jQuery(this).attr('data-ID');
        let imagesVal = jQuery(this).parents('.csp-image-preview').siblings('.acf-input-wrap').find(
            '.imgSibling').val();
        console.log(imagesVal);
        let imgToarr = imagesVal.split(',');
        var i = 0;
        while (i < imgToarr.length) {
            if (imgToarr[i] === ImgID) {
                imgToarr.splice(i, 1);
            } else {
                ++i;
            }
        }
        jQuery(this).parents('.csp-image-preview').siblings('.acf-input-wrap').find('.imgSibling').val(
            imgToarr);
        jQuery(this).siblings('img').hide();
        jQuery(this).hide();
        // console.log(imgToarr);
    });

    jQuery('.layoutchange').on('change', function() {
        let layout = jQuery(this).val();

        if (layout == 'layoutone') {
            jQuery('.layouttwo').hide();
            jQuery('.layoutone').show();

        } else if (layout == 'layouttwo') {
            jQuery('.layoutone').hide();
            jQuery('.layouttwo').show();
        } else {
            jQuery('.layout').hide();
        }


    });

    jQuery(document).on('click', '.imgInsert', function() {
        let that = jQuery(this);
        var upload = wp.media({
                title: 'Choose Image', //Title for Media Box
                multiple: false, //For limiting multiple image
                library: {
                    type: ['image']
                },
            })
            .on('select', function() {
                var select = upload.state().get('selection');
                var attach = select.first().toJSON();

                that.parent('.acf-input-wrap').siblings('.imagePreview').append(
                    '<div class="removeDiv"><img src="' + attach.url +
                    '"><a class="acf-icon -cancel dark removeImg" data-name="remove" href="#" title="Remove" data-ID="' +
                    attach.id + '"></a></div>');

                that.parent('.acf-input-wrap').siblings('.imagePreview').show();

                that.siblings('.imgSibling').val(attach.id);
                that.hide();
            })
            .open();
    });

    jQuery(document).on('click', '.removeImg', function() {
        jQuery(this).parents('.imagePreview').siblings('.acf-input-wrap').find('.imgSibling').val('');
        jQuery(this).siblings('img').hide();
        jQuery(this).parents('.imagePreview').siblings('.acf-input-wrap').find('.imgInsert').show();
        jQuery(this).hide();
        jQuery(this).parent('.removeDiv').remove();
    });

    jQuery('.addRowTable').click(function() {
        let ID = jQuery(this).attr('id');
        let Row = '';
        if (ID == 'add-row-appliction') {
            Row = `<tr class="app-post-row">
                            <td>content</td>
                            <td class='appliction-post-colomn' style="width:90%">
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Heading</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type="text" class="form-control" name="appheading[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Description</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type='text' name='appdescription[]' />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Images</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <a class='button insertImage-app imgInsert' href='javascript:void(0)'>Add Image</a>
                                            <input type="hidden" class='imgSibling' name="appimge[]">
                                        </div>
                                        <div class='app-image-preview imagePreview' style='display:none'>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                        </tr>`;

        } else if (ID == 'pro-row') {
            Row = `<tr class="pro-post-row">
                            <td>content</td>
                            <td class='pro-post-colomn' style="width:90%">
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Heading</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type="text" class="form-control" name="proheading[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Description</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type='text' name='prodescription[]' />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Images</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <a class='button insertImage-pro imgInsert' href='javascript:void(0)' >Add Image</a>
                                            <input type="hidden" class='imgSibling' name="proimge[]">
                                        </div>
                                        <div class='pro-image-preview imagePreview' style='display:none'>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                        </tr>`;
        } else {
            Row = `<tr class="blogtest-post-row">
                            <td>content</td>
                            <td class='blogtest-post-colomn' style="width:90%">
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Heading</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type="text" class="form-control" name="blogheading[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Images</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <a class='button insertImage-blog imgInsert' href='javascript:void(0)' id='insertImage-blog'>Add Image</a>
                                            <input type="hidden" class='imgSibling' name="blogimge[]">
                                        </div>
                                        <div class='blog-image-preview imagePreview' style='display:none'>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                        </tr>`;
        }
        jQuery(this).parents('tfoot').siblings('tbody').append(Row);
    });
});
</script>
<div class="acf-fields">
    <div class="acf-field">
        <div class='border'>
            <div class="acf-label">
                <label>Choose Post Layout</label>
            </div>
            <?php $layoutVal='';
            if(isset($ctpost_group['layout'])){
                $layoutVal =$ctpost_group['layout'];
            }?>
            <div class="acf-input-wrap">
                <select class='layoutchange' name='layout'>
                    <option value='' <?php if($layoutVal ==''){
                        echo 'Selected';} ?>>None</option>
                    <option value='layoutone' <?php if($layoutVal =='layoutone'){
                        echo 'Selected';} ?>>Layout One</option>
                    <option value='layouttwo' <?php if($layoutVal =='layouttwo'){
                        echo 'Selected';} ?>>Layout Two</option>
                </select>
            </div>
        </div>
        <div class='layoutone layout' style='display:<?php if($layoutVal ==='layoutone'){
                        echo 'block';}else{ echo 'none'; } ?>'>
            <table class='custudy-post-table table table-bordered' style="width:100%">
                <tbody>
                    <?php if(!empty($ctpost_group['layoutone']['content'])){
                        foreach($ctpost_group['layoutone']['content'] as $key => $cdata){ ?>
                    <tr class='custudy-post-row'>
                        <td class='custudy-post-colomn' style="width:90%">
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Heading</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <input type="text" class="form-control" name="cpheading[]"
                                                value='<?php if(isset($cdata['heading'])){ echo $cdata['heading']; } ?>'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Description</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <!--<textarea class="form-control edit" name="pcontent[]" id="pcontent" rows="3"></textarea>-->
                                            <?php $pID ='pcontent'.$key; 
                                                    if(isset($cdata['description'])){
                                                        $des =$cdata['description'];
                                                    }else{
                                                        $des ='';
                                                    }
                                                    wp_editor($des, $pID, $settings = array('textarea_name'=>'pcontent[]') ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Images</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <a class='button insertImage-csp' href='javascript:void(0)'>Add Image</a>
                                        <input type="hidden" class='imgSibling' name="cspimge[]"
                                            value='<?php if(isset($cdata['images'])){ echo $cdata['images']; } ?>'>
                                    </div>
                                    <div class='csp-image-preview' style='display:block'>
                                        <?php  if(isset($cdata['images'])){
                                                         $imgArr =   explode(',',$cdata['images']);
                                                         foreach($imgArr as $img){ 
                                                            $imgUrl = wp_get_attachment_image_url( $img, array( 80, 80 ) ); ?>
                                        <div class='removeDiv'>
                                            <img src="<?php echo $imgUrl; ?>">
                                            <a class="acf-icon -cancel dark csp-remove" data-name="remove" href="#"
                                                title="Remove" data-ID="<?php echo $img; ?>"></a>
                                        </div>
                                        <?php  }  ?>
                                        <?php  } ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class='custudy-post-colomn remove-colomn' width="10%">
                            <a class='removeButton remove button' href='javascript:void(0)'>-</a>
                        </td>
                    </tr>


                    <?php }
                }else{ ?>
                    <tr class='custudy-post-row'>
                        <td class='custudy-post-colomn' style="width:90%">
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Heading</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <input type="text" class="form-control" name="cpheading[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Description</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <!--<textarea class="form-control edit" name="pcontent[]" id="pcontent" rows="3"></textarea>-->
                                            <?php wp_editor('', 'pcontent', $settings = array('textarea_name'=>'pcontent[]') ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Images</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <a class='button insertImage-csp' href='javascript:void(0)'>Add Image</a>
                                        <input type="hidden" class='imgSibling' name="cspimge[]">
                                    </div>
                                    <div class='csp-image-preview' style='display:none'>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class='custudy-post-colomn remove-colomn' width="10%">
                            <a class='removeButton remove button' href='javascript:void(0)'>-</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p><a id="add-row-custudy-post" class="button" href="javascript:void(0)">Add another</a></p>
        </div>
        <div class='layouttwo layout' style='display:<?php if($layoutVal ==='layouttwo'){
                        echo 'block';}else{ echo 'none'; } ?>'>
            <div class='border'>
                <div class='applictions -left -border'>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <div class="acf-label">
                                    <label>Appliction</label>
                                </div>
                            </tr>
                        </thead>
                        <tbody class='appliction-body'>
                            <?php if(!empty($ctpost_group['layouttwo']['application'])){ 
                            $appliction =$ctpost_group['layouttwo']['application']; ?>
                            <tr>
                                <td>Heading</td>
                                <td><input type='text' name='apphead'
                                        value='<?php if(isset($appliction['headheading'])){ echo $appliction['headheading']; } ?>'>
                                </td>
                            </tr>
                            <?php foreach($appliction['content'] as $key => $apploop){ ?>

                            <tr class="app-post-row">
                                <td>content</td>
                                <td class='appliction-post-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control" name="appheading[]" value='<?php if(isset($apploop['appheading']))
                                                    { echo $apploop['appheading']; } ?>'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Description</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type='text' name='appdescription[]' value='<?php if(isset($apploop['appdescription'])){ 
                                                        echo $apploop['appdescription']; } ?>' />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Images</label>
                                        </div>
                                        <?php if(!empty($apploop['appimages'])){ 
                                            $imgUrl = wp_get_attachment_image_url($apploop['appimages'], array( 80, 80 ) ); ?>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <a class='button insertImage-app imgInsert' href='javascript:void(0)'
                                                    style='display:none'>Add Image</a>
                                                <input type="hidden" class='imgSibling' name="appimge[]"
                                                    value='<?php if(isset($apploop['appimages'])){ echo $apploop['appimages']; } ?>' />
                                            </div>
                                            <div class='app-image-preview imagePreview' style='display:block'>
                                                <div class="removeDiv">
                                                    <img src="<?php echo $imgUrl; ?>"
                                                        alt='<?php if(isset($apploop['appheading'])){ echo $apploop['appheading']; } ?>' />
                                                    <a class="acf-icon -cancel dark removeImg" data-name="remove"
                                                        href="#" title="Remove"
                                                        data-ID="<?php $apploop['appimages'] ?>"></a>
                                                </div>

                                            </div>
                                        </div>

                                        <?php }else{ ?>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <a class='button insertImage-app imgInsert'
                                                    href='javascript:void(0)'>Add Image</a>
                                                <input type="hidden" class='imgSibling' name="appimge[]">
                                            </div>
                                            <div class='app-image-preview imagePreview' style='display:none'>
                                            </div>
                                        </div>

                                        <?php  } ?>

                                    </div>
                                </td>
                                <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                            </tr>

                            <?php } }else{ ?>
                            <tr>
                                <td>Heading</td>
                                <td><input type='text' name='apphead'></td>
                            </tr>
                            <tr class="app-post-row">
                                <td>content</td>
                                <td class='appliction-post-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control" name="appheading[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Description</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type='text' name='appdescription[]' />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Images</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <a class='button insertImage-app imgInsert'
                                                    href='javascript:void(0)'>Add Image</a>
                                                <input type="hidden" class='imgSibling' name="appimge[]">
                                            </div>
                                            <div class='app-image-preview imagePreview' style='display:none'>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><a id="add-row-appliction" class="button addRowTable" href="javascript:void(0)">Add
                                        another</a></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class='border'>
                <div class='applictions -left -border'>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <div class="acf-label">
                                    <label>Product</label>
                                </div>
                            </tr>
                        </thead>
                        <tbody class='product-body'>
                            <?php    
                            if(!empty($ctpost_group['layouttwo']['product'])){
                                $product =$ctpost_group['layouttwo']['product'];
                                ?>

                            <tr>
                                <td>Heading</td>
                                <td><input type='text' name='prohead'
                                        value='<?php if(isset($product['headheading'])){ echo $product['headheading']; } ?>'>
                                </td>
                            </tr>

                            <?php if(!empty($product['content'])){
                                foreach($product['content'] as $pro){ ?>

                            <tr class="pro-post-row">
                                <td>content</td>
                                <td class='pro-post-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control" name="proheading[]" value='<?php if(isset($pro['proheading']))
                                                    { echo $pro['proheading']; } ?>' />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Description</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type='text' name='prodescription[]' value='<?php if(isset($pro['prodescription']))
                                                    { echo $pro['prodescription']; } ?>' />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Images</label>
                                        </div>
                                        <?php if(!empty($pro['proimages'])){
                                                 $imgUrl = wp_get_attachment_image_url($pro['proimages'], array( 80, 80 ) );
                                                ?>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <a class='button insertImage-pro imgInsert' href='javascript:void(0)'
                                                    style='display:none'>Add Image</a>
                                                <input type="hidden" class='imgSibling' name="proimge[]"
                                                    value='<?php if(isset($pro['proimages'])){ echo $pro['proimages']; } ?>' />
                                            </div>
                                            <div class='pro-image-preview imagePreview' style='display:block'>
                                                <div class="removeDiv">
                                                    <img src="<?php echo $imgUrl; ?>"
                                                        alt='<?php if(isset($pro['proheading'])){ echo $pro['proheading']; } ?>' />
                                                    <a class="acf-icon -cancel dark removeImg" data-name="remove"
                                                        href="#" title="Remove"
                                                        data-ID="<?php $pro['proimages'] ?>"></a>
                                                </div>
                                            </div>
                                        </div>

                                        <?php }else{ ?>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <a class='button insertImage-pro imgInsert'
                                                    href='javascript:void(0)'>Add Image</a>
                                                <input type="hidden" class='imgSibling' name="proimge[]">
                                            </div>
                                            <div class='pro-image-preview imagePreview' style='display:none'>
                                            </div>
                                        </div>
                                        <?php } ?>

                                    </div>
                                </td>
                                <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                            </tr>

                            <?php }

                            }  ?>


                            <?php
                            }else{
                        ?>
                            <tr>
                                <td>Heading</td>
                                <td><input type='text' name='prohead'></td>
                            </tr>
                            <tr class="pro-post-row">
                                <td>content</td>
                                <td class='pro-post-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control" name="proheading[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Description</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type='text' name='prodescription[]' />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Images</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <a class='button insertImage-pro imgInsert'
                                                    href='javascript:void(0)'>Add Image</a>
                                                <input type="hidden" class='imgSibling' name="proimge[]">
                                            </div>
                                            <div class='pro-image-preview imagePreview' style='display:none'>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><a id="pro-row" class="button addRowTable" href="javascript:void(0)">Add Row</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!---blogs-->
            <div class='border'>
                <div class='applictions -left -border'>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <div class="acf-label">
                                    <label>Blogs</label>
                                </div>
                            </tr>
                        </thead>
                        <tbody class='blogtest-body'>
                            <?php if(!empty($ctpost_group['layouttwo']['blogs'])){ 
                            $blogs =$ctpost_group['layouttwo']['blogs']; ?>
                            <tr>
                                <td>Heading</td>
                                <td><input type='text' name='bloghead'
                                        value='<?php if(isset($blogs['headheading'])){ echo $product['headheading']; } ?>' />
                                </td>
                            </tr>
                            <?php if(!empty($blogs['content'])){ 
                                
                                foreach($blogs['content'] as $blog){ ?>
                            <tr class="blogtest-post-row">
                                <td>content</td>
                                <td class='blogtest-post-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control" name="blogheading[]" value='<?php if(isset($blog['blogheading']))
                                                    { echo $blog['blogheading']; } ?>'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Images</label>
                                        </div>
                                        <?php if(!empty($blog['blogimages'])){ 
                                            $imgUrl = wp_get_attachment_image_url($blog['blogimages'], array( 80, 80 ) );?>

                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <a class='button insertImage-blog imgInsert' href='javascript:void(0)'
                                                    style='display:none'>Add Image</a>
                                                <input type="hidden" class='imgSibling' name="blogimge[]" value='<?php if(isset($blog['blogimages']))
                                                    { echo $blog['blogimages']; } ?>' />
                                            </div>
                                            <div class='blog-image-preview imagePreview' style='display:block'>
                                                <div class="removeDiv">
                                                    <img src="<?php echo $imgUrl; ?>"
                                                        alt='<?php if(isset($blog['blogheading'])){ echo $blog['blogheading']; } ?>' />
                                                    <a class="acf-icon -cancel dark removeImg" data-name="remove"
                                                        href="#" title="Remove"
                                                        data-ID="<?php $blog['blogimages'] ?>"></a>
                                                </div>
                                            </div>
                                        </div>

                                        <?php }else{ ?>

                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <a class='button insertImage-blog imgInsert'
                                                    href='javascript:void(0)'>Add Image</a>
                                                <input type="hidden" class='imgSibling' name="blogimge[]">
                                            </div>
                                            <div class='blog-image-preview imagePreview' style='display:none'>
                                            </div>
                                        </div>

                                        <?php } ?>

                                    </div>
                                </td>
                                <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                            </tr>
                            <?php }
                        } ?>
                            <?php  }else{ ?>
                            <tr>
                                <td>Heading</td>
                                <td><input type='text' name='bloghead'></td>
                            </tr>
                            <tr class="blogtest-post-row">
                                <td>content</td>
                                <td class='blogtest-post-colomn' style="width:90%">
                                    <div class="acf-input">
                                        <div class='acf-fields'>
                                            <div class="acf-label">
                                                <label>Heading</label>
                                            </div>
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control" name="blogheading[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Images</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <a class='button insertImage-blog imgInsert'
                                                    href='javascript:void(0)'>Add Image</a>
                                                <input type="hidden" class='imgSibling' name="blogimge[]">
                                            </div>
                                            <div class='blog-image-preview imagePreview' style='display:none'>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><a id="blog-row-appliction" class="button addRowTable" href="javascript:void(0)">Add
                                        Row</a></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}

add_action('save_post','casestudypost_meta_box_show');

function casestudypost_meta_box_show($post_id){

    if ( ! isset( $_POST['casestudypost_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['casestudypost_meta_box_nonce'], 'casestudypost_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'casestudypost_group', true);
    $new = array();
    $layout =$_POST['layout'];

    //if($layout =='layoutone'){
        $new['layout'] = $layout;
        $heading = $_POST['cpheading'];
        $description = $_POST['pcontent'];
        $images = $_POST['cspimge'];

        $count = count( $heading );

        for ( $i = 0; $i < $count; $i++ ) {
            if ( $heading[$i] != '' ) :
                $new['layoutone']['content'][$i]['heading'] = stripslashes( strip_tags( $heading[$i] ));
            endif;
    
            if ($description[$i] != '' ) :
                $new['layoutone']['content'][$i]['description'] = $description[$i];
            endif;
            if ($images[$i] != '' ) :
                $new['layoutone']['content'][$i]['images'] = $images[$i];
            endif;
        }

   // }else if($layout =='layouttwo'){
        //$new['layout'] = $layout;
        $apphead =$_POST['apphead'];
        $appheading = $_POST['appheading'];
        $appdescription = $_POST['appdescription'];
        $appimages = $_POST['appimge'];
        $appcount =count($appheading);

        if($apphead != ''){
            $new['layouttwo']['application']['headheading'] =$apphead;
        }
        for($j=0;$j <$appcount; $j++){
            if($appheading !=''){
                $new['layouttwo']['application']['content'][$j]['appheading'] =$appheading[$j];
            }
    
            if($appdescription !=''){
                $new['layouttwo']['application']['content'][$j]['appdescription'] =$appdescription[$j];
            }
    
            if($appimages !=''){
                $new['layouttwo']['application']['content'][$j]['appimages'] =$appimages[$j];
            }
        }

        /****************Product*****************/
        $prohead =$_POST['prohead'];
        $proheading = $_POST['proheading'];
        $prodescription = $_POST['prodescription'];
        $proimages = $_POST['proimge'];
        $procount =count($proheading);

        if($prohead != ''){
            $new['layouttwo']['product']['headheading'] =$prohead;
        }
        for($j=0;$j <$procount; $j++){
            if($proheading !=''){
                $new['layouttwo']['product']['content'][$j]['proheading'] =$proheading[$j];
            }
    
            if($prodescription !=''){
                $new['layouttwo']['product']['content'][$j]['prodescription'] =$prodescription[$j];
            }
    
            if($proimages !=''){
                $new['layouttwo']['product']['content'][$j]['proimages'] =$proimages[$j];
            }
        }

        /******************************Blogs******************************/
    
        $bloghead =$_POST['bloghead'];
        $blogheading = $_POST['blogheading'];
        $blogimages = $_POST['blogimge'];
        $blogcount =count($blogheading);

        if($bloghead != ''){
            $new['layouttwo']['blogs']['headheading'] =$bloghead;
        }
        for($j=0;$j <$blogcount; $j++){
            if($blogheading !=''){
                $new['layouttwo']['blogs']['content'][$j]['blogheading'] =$blogheading[$j];
            }
    
            if($blogimages !=''){
                $new['layouttwo']['blogs']['content'][$j]['blogimages'] =$blogimages[$j];
            }
        }
  

    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'casestudypost_group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'casestudypost_group', $old );
}

// function stackoverflow_remove_cpt_slug( $post_link, $post ) {
//     if ( 'casestudies' === $post->post_type && 'publish' === $post->post_status ) {
//         $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
//     }
//     return $post_link;
// }
// add_filter( 'post_type_link', 'stackoverflow_remove_cpt_slug', 10, 2 );


/**********Repeater Meta Box *******/

function ai_add_meta_slide() {
    // Get post/page ID.
    if((!empty($_GET['post'])) || (!empty($_POST['post_ID'])) ){
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
        $post = get_post($post_id);
        // Get post/page slug.
        $post_slug = $post->post_name;
        // checks for post/page slug.
        if ( $post_slug == 'front-page') {
            add_meta_box( 'ai_partner_slide','Partner Slider', 'ai_partner_slide_callback', array( 'post', 'page'),'advanced','low', $callback_args = null);
        }
      add_action( 'add_meta_boxes_ai_partner_slide', 'ai_add_meta_slide' );
    }
  }
  add_action('admin_init','ai_add_meta_slide');
  
  function ai_partner_slide_callback($post){
    $logoGroup =  get_post_meta( $post->ID, 'plogo-group', true );  
    wp_nonce_field( 'ai_add_meta_slide_nonce', 'ai_add_meta_slide_nonce' );
    ?>
<div class="acf-fields">
    <div class="acf-field">
        <div class="acf-label">
            <label for="ai_partner_slide">Partners Logo</label>
        </div>
        <?php  if(!empty($logoGroup)){ ?>

        <div class="acf-input-heading">
            <div class="acf-fields -left -border">
                <div class="acf-field acf-field-text " data-name="partner-logos-heading" data-type="text">
                    <div class="acf-label">
                        <label for="partner-logo">Heading</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap first-logo">
                            <input type='text'
                                value='<?php if(isset( $logoGroup['heading'])){ echo  $logoGroup['heading']; } ?>'
                                name='plogo-heading' class='plogo-heading'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='acf-fields -left -border'>
            <div class="acf-field">
                <div class="acf-label">
                    <label>Images</label>
                </div>
                <div class="acf-input">
                    <div class="acf-input-wrap">
                        <a class='button insertImage-logo' href='javascript:void(0)'>Add Image</a>
                        <input type="hidden" class='imgSibling' name="logoimge[]"
                            value='<?php if(isset($logoGroup['logos'][0])){ echo $logoGroup['logos'][0]; } ?>'>
                    </div>
                    <?php  if(!empty($logoGroup['logos'][0])){ ?>
                    <div class='logo-image-preview' style='display:block'>
                        <?php
                                //echo $logoGroup['logos'][0];
                                $imgArr =   explode(',',$logoGroup['logos'][0]);
                                foreach($imgArr as $img){ 
                                    $imgUrl = wp_get_attachment_image_url( $img, array( 80, 80 ) ); ?>
                        <div class='removeDiv'>
                            <img src="<?php echo $imgUrl; ?>">
                            <a class="acf-icon -cancel dark logo-remove" data-name="remove" href="#" title="Remove"
                                data-ID="<?php echo $img; ?>"></a>
                        </div>
                        <?php  }  ?>
                    </div>
                    <?php  }else{ ?>
                    <div class='logo-image-preview' style='display:none'>
                        <?php }  ?>

                    </div>
                </div>
            </div>
            <?php }else{ ?>
            <div class="acf-input-heading">
                <div class="acf-fields -left -border">
                    <div class="acf-field acf-field-text " data-name="partner-logos-heading" data-type="text">
                        <div class="acf-label">
                            <label for="partner-logo">Heading</label>
                        </div>
                        <div class="acf-input">
                            <div class="acf-input-wrap first-logo">
                                <input type='text' value='' name='plogo-heading' class='plogo-heading'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='acf-fields -left -border'>
                <div class="acf-field">
                    <div class="acf-label">
                        <label>Images</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap">
                            <a class='button insertImage-logo' href='javascript:void(0)'>Add Image</a>
                            <input type="hidden" class='imgSibling' name="logoimge[]">
                        </div>
                        <div class='logo-image-preview' style='display:none'></div>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>

    <style>
    .logo-image-preview .removeDiv img {
        max-width: 70%;
    }

    .logo-image-preview {
        display: flex !important;
    }

    .logo-image-preview .removeDiv {
        position: relative;
        display: flex;
    }

    .logo-image-preview .removeDiv a.acf-icon.-cancel.dark.logo-remove {
        margin-left: -27px;
        opacity: 0;
    }

    .logo-image-preview .removeDiv:hover a.acf-icon.-cancel.dark.logo-remove {
        opacity: 1;
    }
    </style>

    <script>
    jQuery(document).ready(function($) {

        jQuery(document).on('click', '.insertImage-logo', function() {
            let that = jQuery(this);
            var upload = wp.media({
                    title: 'Choose Image', //Title for Media Box
                    multiple: true, //For limiting multiple image
                    library: {
                        type: ['image']
                    },
                })
                .on('select', function() {
                    var select = upload.state().get('selection');
                    var attach = select.first().toJSON();
                    var Data = select.toJSON();
                    let oldVal = that.siblings('.imgSibling').val();
                    let oldArry = '';
                    if (oldVal != '') {
                        oldArry = oldVal.split(',');
                    } else {
                        oldArry = [];
                    }
                    Data.map(function(arr) {
                        oldArry.push(arr.id);
                        that.parent('.acf-input-wrap').siblings('.logo-image-preview')
                            .append('<div class="removeDiv"><img src="' + arr.url +
                                '"><a class="acf-icon -cancel dark logo-remove" data-name="remove" href="#" title="Remove" data-ID="' +
                                arr.id + '"></a></div>');
                    });
                    that.parent('.acf-input-wrap').siblings('.logo-image-preview').show();
                    that.siblings('.imgSibling').val(oldArry);
                    //console.log(oldArry);  
                })
                .open();
        });

        jQuery(document).on('click', '.logo-remove', function() {
            let ImgID = jQuery(this).attr('data-ID');
            let imagesVal = jQuery(this).parents('.logo-image-preview').siblings('.acf-input-wrap')
                .find('.imgSibling').val();
            let imgToarr = '';
            if (imagesVal != '') {
                imgToarr = imagesVal.split(',');
                var i = 0;
                while (i < imgToarr.length) {
                    if (imgToarr[i] === ImgID) {
                        imgToarr.splice(i, 1);
                    } else {
                        ++i;
                    }
                }
                jQuery(this).parents('.logo-image-preview').siblings('.acf-input-wrap').find(
                    '.imgSibling').val(imgToarr);
            } else {
                jQuery(this).parents('.logo-image-preview').siblings('.acf-input-wrap').find(
                    '.imgSibling').val(imgToarr);
                jQuery(this).parents('.logo-image-preview').hide();
            }

            jQuery(this).siblings('img').hide();
            jQuery(this).hide();
        });



    });
    </script>
    <?php 
  }
  
  function slide_meta_save( $post_id ) {

    if ( ! isset( $_POST['ai_add_meta_slide_nonce'] ) ||
    ! wp_verify_nonce( $_POST['ai_add_meta_slide_nonce'], 'ai_add_meta_slide_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;


    $old = get_post_meta($post_id, 'plogo-group', true);
    $new = array();
    
    $heading = $_POST['plogo-heading'];
    $images = $_POST['logoimge'];
    $count = count( $images );

    if($heading != ''){
        $new['heading'] =$heading;
    }
    //$new['logos'] = '';
    if ($images != '' ) :
        $new['logos'] = $images;
    endif;


    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'plogo-group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'plogo-group', $old );
  
  }
  add_action( 'save_post', 'slide_meta_save' );

  /***********************Service template  ********************/
  add_action('admin_init', 'Service_template_meta_boxes', 2);

  function Service_template_meta_boxes() {
          if((!empty($_GET['post'])) || (!empty($_POST['post_ID'])) ){
            $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
            $slug = get_page_template_slug($post_id);
            // checks for post/page slug.
            if ($slug == 'services.php') {
                add_meta_box( 'ai-service-template', 'Services', 'Service_template_show', 'page', 'normal', 'default');
            }
        }
  }

function Service_template_show($post){ 
    $serviceSection =  get_post_meta( $post->ID, 'service-section', true );  
    wp_nonce_field( 'ai_service_section_nonce', 'ai_service_section_nonce');    
?>
    <script>
    jQuery(document).ready(function() {
        jQuery(document).on('click', '#service-section', function() {
            let RowLength = jQuery('.service-section-row').length;
            //var randGenId = 'scontent' + (parseInt(RowLength)+1);
            var randGenId = 'scontent' + RowLength;
            var AJAX_URL = '<?php echo admin_url( "admin-ajax.php" ); ?>';
            jQuery.ajax({
                type: "POST",
                url: AJAX_URL,
                data: {
                    'action': 'getMultipleMetaBoxCustom',
                    randGenId: randGenId,
                    textID: 'scontent'
                },
                success: function(data) {

                    let Row = `<tr class='service-section-row'>
                <td class='service-section-colomn' style="width:90%">
                    <div class="acf-input">
                        <div class='acf-fields'>
                            <div class="acf-label">
                                <label>Heading</label>
                            </div>
                            <div class="acf-input">
                                <div class="acf-input-wrap">
                                    <input type="text" class="form-control" name="sheading[]">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="acf-input">
                        <div class='acf-fields'>
                            <div class="acf-label">
                                <label>Description</label>
                            </div>
                            <div class="acf-input">
                                <div class="acf-input-wrap">` + data + `</div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class='service-section-colomn remove-colomn' width="10%">
                    <a class='removeButton remove button' href='javascript:void(0)'>-</a>
                </td>
                </tr>`;
                    jQuery('.service-section-table').append(Row);
                    tinyMCE.execCommand('mceAddEditor', false, randGenId);
                }
            });
        });

        jQuery(document).on('click', '.removeButton', function() {
            jQuery(this).parents('tr').remove();
        });
    });
    </script>

    <div class='serviceTemplate'>
        <table class="table table-bordered service-section-table">
            <thead>
                <tr>
                    <div class="acf-input">
                        <div class='acf-fields'>
                            <div class="acf-label">
                                <label>Service Content</label>
                            </div>
                        </div>
                    </div>
                </tr>
            </thead>
            <tbody>

                <?php if(!empty($serviceSection)){
            foreach($serviceSection as $key => $service){ 
                $id =$key
                ?>

                <tr class='service-section-row'>
                    <td class='service-section-colomn' style="width:90%">
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Heading</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <!--if(!empty($service['heading'])){ echo $service['heading']; }-->

                                        <input type="text" class="form-control" name="sheading[]"
                                            value='<?php if(isset($service['heading'])){ echo $service['heading']; }  ?>'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Description</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap test2">
                                        <?php //$content ='';
                              //echo $service['content'];
                             
                              if($id==0){
                                $pID ='scontent';
                              }else{
                                $pID ='scontent'.$id;
                              }
                          
                            if(isset($service['content'])){
                                $des =$service['content'];
                            }else{
                                $des ='';
                            }
                            wp_editor($des, $pID, $settings = array('textarea_name'=>'scontent[]','wpautop' => true ) ); ?>
                                        <?php //wp_editor($service['content'],$pID,array('textarea_name'=>'scontent[]')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='service-section-colomn remove-colomn' width="10%">
                        <a class='removeButton remove button' href='javascript:void(0)'>-</a>
                    </td>
                </tr>

                <?php }

        }else{ ?>
                <tr class='service-section-row'>
                    <td class='service-section-colomn' style="width:90%">
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Heading</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <input type="text" class="form-control" name="sheading[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Description</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap test">
                                        <?php 
                            $con='';
                            $cID ='scontent';
                            $settings = array('textarea_name'=>'scontent[]','wpautop' => true,'quicktags' => true,
                            'tinymce' => true,'textarea_rows' => 20,'editor_height' => 300);
                            wp_editor($con,$cID,$settings);
                             ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='service-section-colomn remove-colomn' width="10%">
                        <a class='removeButton remove button' href='javascript:void(0)'>-</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <a id="service-section" class="button addRowTable" href="javascript:void(0)">AddRow</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php }

function service_section_save($post_id){
    if ( ! isset( $_POST['ai_service_section_nonce'] ) ||
    ! wp_verify_nonce( $_POST['ai_service_section_nonce'], 'ai_service_section_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;
        $old = get_post_meta($post_id, 'service-section', true);
        $new = array();

        $heading = $_POST['sheading'];
        $content = $_POST['scontent'];
        $count = count( $heading );
    
        for($j=0;$j <$count; $j++){
            if($heading !=''){
                $new[$j]['heading'] =$heading[$j];
            }
    
            if($content !=''){
                $new[$j]['content'] =$content[$j];
            }
        }
        
        //update_post_meta( $post_id, 'service-section','');
    
        if ( !empty( $new ) && $new != $old )
            update_post_meta( $post_id, 'service-section', $new );
        elseif ( empty($new) && $old )
            delete_post_meta( $post_id, 'service-section', $old );


}
add_action( 'save_post', 'service_section_save' );


/***********************Service template  ********************/
add_action('admin_init', 'Service_template_two_meta_boxes', 2);

function Service_template_two_meta_boxes() {
        if((!empty($_GET['post'])) || (!empty($_POST['post_ID'])) ){
          $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
          $slug = get_page_template_slug($post_id);
          // checks for post/page slug.
          if ($slug == 'services_layout.php') {
              add_meta_box( 'ai-service-two-template', 'Services', 'Service_template_two_show', 'page', 'normal', 'default');
          }
      }
}

function Service_template_two_show(){ 
    global $post;
    $servicelayout = get_post_meta($post->ID, 'servicelayout_group', true);
    wp_nonce_field('servicelayout_meta_box_nonce', 'servicelayout_meta_box_nonce'); ?>
    <style>
    .applictions {
        margin: 15px;
    }

    .removeDiv {
        max-width: 200px;
        max-height: 200px;
        display: flex;
        border: 1px solid;
        padding: 2px;
        position: relative;
    }

    .removeDiv img {
        width: 100%;
        object-fit: cover;
    }

    .removeDiv .removeImg {
        opacity: 0;
        position: absolute;
        top: 0;
        right: 0;
    }

    .removeDiv:hover .removeImg {
        opacity: 1;
    }
    </style>

    <script>
    jQuery(document).ready(function() {
        jQuery('.addRowTable').click(function() {
            let ID = jQuery(this).attr('id');
            let Row = '';
            if (ID === 'sapp-row') {
                Row = `<tr class="sapp-post-row">
                    <td>content</td>
                    <td class='sapp-post-colomn' style="width:90%">
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Heading</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <input type="text" class="form-control" name="sappheading[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Description</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <input type='text' class="form-control" name='sappdescription[]' />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='acf-fields'>
                            <div class="acf-label">
                                <label>Images</label>
                            </div>
                            <div class="acf-input">
                                <div class="acf-input-wrap">
                                    <a class='button insertImage-sapp imgInsert'
                                        href='javascript:void(0)'>Add Image</a>
                                    <input type="hidden" class='imgSibling' name="sappimge[]">
                                </div>
                                <div class='sapp-image-preview imagePreview' style='display:none'>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                </tr>`;
            } else if (ID === 'spro-row') {
                Row = `<tr class="spro-post-row">
                    <td>content</td>
                    <td class='spro-post-colomn' style="width:90%">
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Heading</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <input type="text" class="form-control" name="sproheading[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Description</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <input type='text' class="form-control" name='sprodescription[]' />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='acf-fields'>
                            <div class="acf-label">
                                <label>Images</label>
                            </div>
                            <div class="acf-input">
                                <div class="acf-input-wrap">
                                    <a class='button insertImage-spro imgInsert'
                                        href='javascript:void(0)'>Add Image</a>
                                    <input type="hidden" class='imgSibling' name="sproimge[]">
                                </div>
                                <div class='spro-image-preview imagePreview' style='display:none'>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                </tr>`;
            } else if (ID === 'stech-row') {
                Row = `<tr class="spro-post-row">
                    <td>content</td>
                    <td class='spro-post-colomn' style="width:90%">
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Heading</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <input type="text" class="form-control" name="stechheading[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="acf-input">
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Description</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <input type='text' class="form-control" name='stechdescription[]' />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='acf-fields'>
                            <div class="acf-label">
                                <label>Images</label>
                            </div>
                            <div class="acf-input">
                                <div class="acf-input-wrap">
                                    <a class='button insertImage-stech imgInsert'
                                        href='javascript:void(0)'>Add Image</a>
                                    <input type="hidden" class='imgSibling' name="stechimge[]">
                                </div>
                                <div class='stech-image-preview imagePreview' style='display:none'>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                </tr>`;
            }
            jQuery(this).parents('tfoot').siblings('tbody').append(Row);
        });

        jQuery(document).on('click', '.removeButton', function() {
            jQuery(this).closest('tr').remove();
        });

        jQuery(document).on('click', '.imgInsert', function() {
            let that = jQuery(this);
            var upload = wp.media({
                    title: 'Choose Image', //Title for Media Box
                    multiple: false, //For limiting multiple image
                    library: {
                        type: ['image']
                    },
                })
                .on('select', function() {
                    var select = upload.state().get('selection');
                    var attach = select.first().toJSON();

                    that.parent('.acf-input-wrap').siblings('.imagePreview').append(
                        '<div class="removeDiv"><img src="' + attach.url +
                        '"><a class="acf-icon -cancel dark removeImg" data-name="remove" href="#" title="Remove" data-ID="' +
                        attach.id + '"></a></div>');

                    that.parent('.acf-input-wrap').siblings('.imagePreview').show();

                    that.siblings('.imgSibling').val(attach.id);
                    that.hide();
                })
                .open();
        });

        jQuery(document).on('click', '.removeImg', function() {
            jQuery(this).parents('.imagePreview').siblings('.acf-input-wrap').find('.imgSibling').val(
                '');
            jQuery(this).siblings('img').hide();
            jQuery(this).parents('.imagePreview').siblings('.acf-input-wrap').find('.imgInsert').show();
            jQuery(this).hide();
            jQuery(this).parent('.removeDiv').remove();
        });


    });
    </script>

    <div class='border'>
        <div class='applictions -left -border'>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <div class="acf-label">
                            <label>Application</label>
                        </div>
                    </tr>
                </thead>
                <tbody class='product-body'>
                    <tr>
                        <td>Head</td>
                        <td>
                            <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Heading</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                            <input type='text' class="form-control" name='sapphead'
                                value='<?php if(isset($servicelayout['application']['head']['headheading'])){ echo $servicelayout['application']['head']['headheading']; } ?>' >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Sub Heading</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                            <input type='text' class="form-control" name='sappsubhead'
                                value='<?php if(isset($servicelayout['application']['head']['sappsubhead'])){ echo $servicelayout['application']['head']['sappsubhead']; } ?>' >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Images</label>
                                </div>
                                <div class="acf-input">
                                <div class="acf-input-wrap">
                                <?php if(!empty($servicelayout['application']['head']['sheadappimge'])){ ?>
                                        <a class='button insertImage-sheadapp imgInsert' href='javascript:void(0)' style='display:none'>Add Image</a>
                                      <?php }else{ ?>
                                        <a class='button insertImage-sheadapp imgInsert' href='javascript:void(0)'>Add Image</a>
                                      <?php } ?>
                                        <input type="hidden" class='imgSibling' name="sheadappimge" value='<?php if(isset($servicelayout['application']['head']['sheadappimge'])){ echo $servicelayout['application']['head']['sheadappimge']; } ?>' >
                                </div>
                                <?php if(!empty($servicelayout['application']['head']['sheadappimge'])){ 
                                    $imgUrl = wp_get_attachment_image_url( $servicelayout['application']['head']['sheadappimge'], array( 80, 80 ) );?>
                                    <div class='sheadapp-image-preview imagePreview' style='display:block'>
                                        <div class="removeDiv">
                                            <img src="<?php echo $imgUrl; ?>">
                                            <a class="acf-icon -cancel dark removeImg" data-name="remove" href="#" title="Remove" data-ID="<?php if(isset($servicelayout['application']['head']['sheadappimge'])){ echo $servicelayout['application']['head']['sheadappimge']; } ?>"></a>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                        <div class='sheadapp-image-preview imagePreview' style='display:none'></div>
                                       <?php } ?>
                                    </div>

                                    <!--<div class="acf-input-wrap">
                                        <a class='button insertImage-sheadapp imgInsert' href='javascript:void(0)'>Add Image</a>
                                        <input type="hidden" class='imgSibling' name="sheadappimge[]">
                                    </div>
                                    <div class='sheadapp-image-preview imagePreview' style='display:none'>
                                    </div>-->
                                </div>
                            </div>
                        
                            </td>
                    </tr>
                    <?php if(!empty($servicelayout['application']['content'])){
                         foreach($servicelayout['application']['content'] as $content){ ?>
                        <tr class="sapp-post-row">
                            <td>content</td>
                            <td class='sapp-post-colomn' style="width:90%">
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Heading</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type="text" class="form-control" name="sappheading[]" value='<?php if(isset($content['appheading'])){ echo $content['appheading']; } ?>' />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Description</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type='text' class="form-control" name='sappdescription[]' value='<?php if(isset($content['appdescription'])){ echo $content['appdescription']; } ?>' />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Images</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <?php if(!empty($content['appimages'])){ ?>
                                                 <a class='button insertImage-sapp imgInsert' href='javascript:void(0)' style='display:none'>Add
                                                 Image</a>

                                           <?php }else{ ?>
                                            <a class='button insertImage-sapp imgInsert' href='javascript:void(0)'>Add
                                                Image</a>
                                         <?php  } ?>
                                            <input type="hidden" class='imgSibling' name="sappimge[]" value='<?php if(isset($content['appimages'])){ echo $content['appimages']; } ?>' >
                                        </div>
                                        <?php if(!empty($content['appimages'])){ 
                                            $imgUrl = wp_get_attachment_image_url( $content['appimages'], array( 80, 80 ) );?>
                                            <div class='sapp-image-preview imagePreview' style='display:block'>
                                            <div class="removeDiv">
                                                <img src="<?php echo $imgUrl; ?>">
                                                <a class="acf-icon -cancel dark removeImg" data-name="remove" href="#" title="Remove" data-ID="<?php if(isset($content['appimages'])){ echo $content['appimages']; } ?>"></a>
                                            </div>
                                        
                                        </div>
                                        <?php }else{ ?>
                                            <div class='sapp-image-preview imagePreview' style='display:none'></div>
                                       <?php } ?>
                                    </div>
                                </div>
                            </td>
                            <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                        </tr>

                        <?php }
                    }else{ ?>
                    <tr class="sapp-post-row">
                        <td>content</td>
                        <td class='sapp-post-colomn' style="width:90%">
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Heading</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <input type="text" class="form-control" name="sappheading[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Description</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <input type='text' class="form-control" name='sappdescription[]' />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Images</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <a class='button insertImage-sapp imgInsert' href='javascript:void(0)'>Add
                                            Image</a>
                                        <input type="hidden" class='imgSibling' name="sappimge[]">
                                    </div>
                                    <div class='sapp-image-preview imagePreview' style='display:none'>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><a id="sapp-row" class="button addRowTable" href="javascript:void(0)">Add Row</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-----processs------------->
        <div class='applictions -left -border'>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <div class="acf-label">
                            <label>Process</label>
                        </div>
                    </tr>
                </thead>
                <tbody class='product-body'>
                    <tr>
                        <td>Heading</td>
                        <td><input type='text' class="form-control" name='sprohead' value ='<?php if(isset($servicelayout['process']['headheading'])){ echo $servicelayout['process']['headheading']; } ?>' ></td>
                    </tr>
                    <?php  if(!empty($servicelayout['process']['content'])){
                         foreach($servicelayout['process']['content'] as $content){ ?>
                         <tr class="spro-post-row">
                            <td>content</td>
                            <td class='spro-post-colomn' style="width:90%">
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Heading</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type="text" class="form-control" name="sproheading[]" value='<?php if(isset($content['sproheading'])){ echo $content['sproheading']; } ?>' />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Description</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type='text' class="form-control" name='sprodescription[]'  value='<?php if(isset($content['sprodescription'])){ echo $content['sprodescription']; } ?>'  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Images</label>
                                    </div>
                                    <div class="acf-input">
                                    <div class="acf-input-wrap">
                                    <?php if(!empty($content['sproimages'])){ ?>
                                                 <a class='button insertImage-spro imgInsert' href='javascript:void(0)' style='display:none'>Add
                                                 Image</a>

                                           <?php }else{ ?>
                                            <a class='button insertImage-spro imgInsert' href='javascript:void(0)'>Add
                                                Image</a>
                                         <?php  } ?>
                                            <input type="hidden" class='imgSibling' name="sproimge[]" value='<?php if(isset($content['sproimages'])){ echo $content['sproimages']; } ?>' >
                                        </div>
                                        <?php if(!empty($content['sproimages'])){ 
                                            $imgUrl = wp_get_attachment_image_url( $content['sproimages'], array( 80, 80 ) );?>
                                            <div class='spro-image-preview imagePreview' style='display:block'>
                                            <div class="removeDiv">
                                                <img src="<?php echo $imgUrl; ?>">
                                                <a class="acf-icon -cancel dark removeImg" data-name="remove" href="#" title="Remove" data-ID="<?php if(isset($content['sproimages'])){ echo $content['sproimages']; } ?>"></a>
                                            </div>
                                        
                                        </div>
                                        <?php }else{ ?>
                                            <div class='spro-image-preview imagePreview' style='display:none'></div>
                                       <?php } ?>
                                    </div>
                                </div>
                            </td>
                            <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                        </tr>

                         <?php }
                    }else{  ?> 
                    <tr class="spro-post-row">
                        <td>content</td>
                        <td class='spro-post-colomn' style="width:90%">
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Heading</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <input type="text" class="form-control" name="sproheading[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Description</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <input type='text' class="form-control" name='sprodescription[]' />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Images</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <a class='button insertImage-spro imgInsert' href='javascript:void(0)'>Add
                                            Image</a>
                                        <input type="hidden" class='imgSibling' name="sproimge[]">
                                    </div>
                                    <div class='spro-image-preview imagePreview' style='display:none'>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><a id="spro-row" class="button addRowTable" href="javascript:void(0)">Add Row</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!----------techenical-------------------->

        <div class='applictions -left -border'>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <div class="acf-label">
                            <label>Techniques</label>
                        </div>
                    </tr>
                </thead>
                <tbody class='product-body'>
                    <tr>
                        <td>Heading</td>
                        <td><input type='text' class="form-control" name='stechhead'  value ='<?php if(isset($servicelayout['technical']['stechheading'])){ echo $servicelayout['technical']['stechheading']; } ?>' ></td>
                    </tr>
                    <?php  if(!empty($servicelayout['technical']['content'])){
                         foreach($servicelayout['technical']['content'] as $content){ ?>
                         <tr class="spro-post-row">
                            <td>content</td>
                            <td class='spro-post-colomn' style="width:90%">
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Heading</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type="text" class="form-control" name="stechheading[]"  value='<?php if(isset($content['stechheading'])){ echo $content['stechheading']; } ?>'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="acf-input">
                                    <div class='acf-fields'>
                                        <div class="acf-label">
                                            <label>Description</label>
                                        </div>
                                        <div class="acf-input">
                                            <div class="acf-input-wrap">
                                                <input type='text' class="form-control" name='stechdescription[]' value='<?php if(isset($content['stechdescription'])){ echo $content['stechdescription']; } ?>' />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Images</label>
                                    </div>
                                    <div class="acf-input">
                                    <div class="acf-input-wrap">
                                    <?php if(!empty($content['stechimages'])){ ?>
                                                 <a class='button insertImage-stech imgInsert' href='javascript:void(0)' style='display:none'>Add
                                                 Image</a>

                                           <?php }else{ ?>
                                            <a class='button insertImage-stech imgInsert' href='javascript:void(0)'>Add
                                                Image</a>
                                         <?php  } ?>
                                            <input type="hidden" class='imgSibling' name="stechimge[]" value='<?php if(isset($content['stechimages'])){ echo $content['stechimages']; } ?>' >
                                        </div>
                                        <?php if(!empty($content['stechimages'])){ 
                                            $imgUrl = wp_get_attachment_image_url( $content['stechimages'], array( 80, 80 ) );?>
                                            <div class='stech-image-preview imagePreview' style='display:block'>
                                            <div class="removeDiv">
                                                <img src="<?php echo $imgUrl; ?>">
                                                <a class="acf-icon -cancel dark removeImg" data-name="remove" href="#" title="Remove" data-ID="<?php if(isset($content['stechimages'])){ echo $content['stechimages']; } ?>"></a>
                                            </div>
                                        
                                        </div>
                                        <?php }else{ ?>
                                            <div class='stech-image-preview imagePreview' style='display:none'></div>
                                       <?php } ?>
                                    </div>
    
                                    </div>
                                </div>
                            </td>
                            <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                        </tr>
                        <?php } 
                    }
                         else{ ?>
                    <tr class="spro-post-row">
                        <td>content</td>
                        <td class='spro-post-colomn' style="width:90%">
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Heading</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <input type="text" class="form-control" name="stechheading[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="acf-input">
                                <div class='acf-fields'>
                                    <div class="acf-label">
                                        <label>Description</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap">
                                            <input type='text' class="form-control" name='stechdescription[]' />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='acf-fields'>
                                <div class="acf-label">
                                    <label>Images</label>
                                </div>
                                <div class="acf-input">
                                    <div class="acf-input-wrap">
                                        <a class='button insertImage-stech imgInsert' href='javascript:void(0)'>Add
                                            Image</a>
                                        <input type="hidden" class='imgSibling' name="stechimge[]">
                                    </div>
                                    <div class='stech-image-preview imagePreview' style='display:none'>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><a class='removeButton remove button' href='javascript:void(0)'>-</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><a id="stech-row" class="button addRowTable" href="javascript:void(0)">Add Row</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

    <?php   
}


add_action('save_post','servicelayout_meta_box_show');

function servicelayout_meta_box_show($post_id){

    if ( ! isset( $_POST['servicelayout_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['servicelayout_meta_box_nonce'], 'servicelayout_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'servicelayout_group', true);
    $new = array();
   

   // }else if($layout =='layouttwo'){
        //$new['layout'] = $layout;
        $apphead =$_POST['sapphead'];
        $appsubhead =$_POST['sappsubhead'];
        $appheadimg = $_POST['sheadappimge'];
        
        $appheading = $_POST['sappheading'];
        $appdescription = $_POST['sappdescription'];
        $appimages = $_POST['sappimge'];
        $appcount =count($appheading);

        if($apphead != ''){
            $new['application']['head']['headheading'] =$apphead;
        }
        if($appsubhead != ''){
            $new['application']['head']['sappsubhead'] =$appsubhead;
        }
        if($appheadimg != ''){
            $new['application']['head']['sheadappimge'] =$appheadimg;
        }

        for($j=0;$j <$appcount; $j++){
            if($appheading !=''){
                $new['application']['content'][$j]['appheading'] =$appheading[$j];
            }
    
            if($appdescription !=''){
                $new['application']['content'][$j]['appdescription'] =$appdescription[$j];
            }
    
            if($appimages !=''){
                $new['application']['content'][$j]['appimages'] =$appimages[$j];
            }
        }

        /****************Process*****************/
        $prohead =$_POST['sprohead'];
        $proheading = $_POST['sproheading'];
        $prodescription = $_POST['sprodescription'];
        $proimages = $_POST['sproimge'];
        $procount =count($proheading);

        if($prohead != ''){
            $new['process']['headheading'] =$prohead;
        }
        for($j=0;$j <$procount; $j++){
            if($proheading !=''){
                $new['process']['content'][$j]['sproheading'] =$proheading[$j];
            }
    
            if($prodescription !=''){
                $new['process']['content'][$j]['sprodescription'] =$prodescription[$j];
            }
    
            if($proimages !=''){
                $new['process']['content'][$j]['sproimages'] =$proimages[$j];
            }
        }

        /******************************Technical******************************/
    
        $techhead =$_POST['stechhead'];
        $techheading = $_POST['stechheading'];
        $techdescription = $_POST['stechdescription'];
        $techimages = $_POST['stechimge'];
        $techcount =count($techheading);

        if($techhead != ''){
            $new['technical']['stechheading'] =$techhead;
        }
        for($j=0;$j <$techcount; $j++){
            if($techheading !=''){
                $new['technical']['content'][$j]['stechheading'] =$techheading[$j];
            }
    
            if($techdescription !=''){
                $new['technical']['content'][$j]['stechdescription'] =$techdescription[$j];
            }
    
            if($techimages !=''){
                $new['technical']['content'][$j]['stechimages'] =$techimages[$j];
            }
        }
  

    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'servicelayout_group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'servicelayout_group', $old );
}

include('theme-options.php');
function load_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_media_files' );