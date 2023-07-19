<?php
/****************Theme Option*************/
add_action('admin_menu', 'ai_theme_page');
function ai_theme_page ()
{
	if ( count($_POST) > 0 && isset($_POST['s_office']) )
	{     
        $soffice =$_POST['sofficeadd'];
        $simg=    $_POST['sofficeimg'];
        $new =array();

        for($i=0; $i<count($soffice); $i++){
            if($soffice !=''){
                $new[$i]['sofficeadd'] = $soffice[$i];
            }
            
        }

        for($i=0;$i<count($simg);$i++){
            if($simg !=''){
                $new[$i]['sofficeimg'] = $simg[$i];
            }
        }
        update_option('saddress',$new);
	}
    if ( count($_POST) > 0 && isset($_POST['d_office']) )
	{     
        $doffice =$_POST['dofficeadd'];
        $dimg=    $_POST['dofficeimg'];
        $dnew =array();
        if($doffice !=''){
            $dnew['dofficeadd'] = $doffice;
        }
        if($dimg !=''){
            $dnew['dofficeimg'] = $dimg;
        }
    
        update_option('daddress',$dnew);
	}

    if ( count($_POST) > 0 && isset($_POST['social_media']) )
	{     
        $smedianame =$_POST['smedianame'];
        $smediaimg=    $_POST['smediaimg'];
        $new =array();

        for($i=0; $i<count($smedianame); $i++){
            if($smedianame !=''){
                $new[$i]['smedianame'] = $smedianame[$i];
            }
            
        }

        for($i=0;$i<count($smediaimg);$i++){
            if($smediaimg !=''){
                $new[$i]['smediaimg'] = $smediaimg[$i];
            }
        }
        update_option('socialmedia',$new);
	}

    if ( count($_POST) > 0 && isset($_POST['cpywrite']) )
	{     
        $cpywritemsg =$_POST['cpywritemsg'];
        $new =array();
        if($cpywritemsg !=''){
            $new['cpywritemsg']= $cpywritemsg;
        }
        update_option('cpywritemsg',$new);
	}


	add_menu_page(__('Theme Options'), __('Theme Options'), 'edit_themes', basename(__FILE__), 'ai_settings');
	//add_submenu_page(__('Theme Options'), __('Theme Options'), 'edit_themes', basename(__FILE__), 'sk_settings');
}

function ai_settings(){ ?>
   <h2>Theme Settings</h2>
    <?php
    $getOptionVal =get_option('saddress'); 
    
    ?>
    <form method="post" action="" enctype="multipart/form-data">
	
	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px; float:left; width:100%;">
	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Sales Office Address.</strong></legend>
	<table class="form-table">
        <?php if(!empty($getOptionVal)){
            foreach ($getOptionVal as $key => $value) { ?>
            <tr valign="top" class='srow'>
                <th scope="row"><label for="officeadd">Address</label></th>
                <td class="w-75">
                    <div class='main-box'>
                    <div class='contentData'>
                    <input name="sofficeadd[]" type="text"  value="<?php if(isset($value['sofficeadd'])){ echo $value['sofficeadd']; } ?>" class="regular-text" />
                    <?php if(!empty($value['sofficeimg'])){
                        echo  "<a class='button insertImage-soffice imgInsert' href='javascript:void(0)' style='display:none'>Add Image</a>";
                     }else{
                       echo  "<a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Image</a>";
                    } ?>
                    
                    <input type='hidden' name='sofficeimg[]' class='imgVal' value='<?php if(isset($value['sofficeimg'])){ echo $value['sofficeimg']; } ?>' /></div>
                    <div class='preview_img'>
                        <?php if(!empty($value['sofficeimg'])){
                             $imgUrl = wp_get_attachment_image_url( $value['sofficeimg'], array( 80, 80 ) ); ?>
                            <div class="removeDiv">
                                <img src="<?php echo $imgUrl; ?>">
                                <a class="removeImg" data-name="remove" href="#" title="Remove" data-ID="<?php echo $value['sofficeimg']; ?>">x</a>
                            </div>
                      <?php } ?>
                    </div>
                </div>
                </td>
               <?php  
                if($key==0){
                    continue;
                }else{
                    echo '<td><a  class="button remove" href="javascript:void(0)">Remove</a></td>';
                } ?>
            </tr>
        <?php }
        }else{ ?>
                <tr valign="top" class='srow'>
                    <th><label for="officeadd">Address</label></th>
                    <td>
                    <div class='main-box'>
                        <div class='contentData'>
                        <input name="sofficeadd[]" type="text" class="regular-text" />
                        <a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Image</a>
                        <input type='hidden' name='sofficeimg[]' class='imgVal' value='' /></div>
                        <div class='preview_img'></div>
                    </div>   
                    </td>
                </tr>
       <?php } ?>
		
        <tfoot>
            <tr>
                <td ></td>
                <td colspan="4" ><a id="office-row" class="button addRowTable" href="javascript:void(0)">Add Row</a></td>
            </tr>
        </tfoot>
	</table>
	</fieldset>
	<p class="submit">
 	   <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
  	  <input type="hidden" name="s_office" value="save" style="display:none;" />
    </p>
    
    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Development Office</strong></legend>
        <?php $doffice =get_option('daddress'); ?>
	    <table class="form-table">
        <tr valign="top">
            <th><label for="officeadd">Address</label></th>
            <td>
                <div class='main-box'>
                    <div class='contentData'>
                    <input name="dofficeadd" type="text" class="regular-text" value='<?php if(!empty($doffice['dofficeadd'])){
                        echo $doffice['dofficeadd'];
                    } ?>' />

                    <?php if(!empty($doffice['dofficeimg'])){
                        echo  "<a class='button insertImage-soffice imgInsert' href='javascript:void(0)' style='display:none'>Add Image</a>";
                     }else{
                       echo  "<a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Image</a>";
                    } ?>
                    
                    <input type='hidden' name='dofficeimg' class='imgVal' value='<?php if(isset($doffice['dofficeimg'])){ echo $doffice['dofficeimg']; } ?>' /></div>
                    <div class='preview_img'>
                        <?php if(!empty($doffice['dofficeimg'])){
                             $imgUrl = wp_get_attachment_image_url($doffice['dofficeimg'], array( 80, 80 ) ); ?>
                            <div class="removeDiv">
                                <img src="<?php echo $imgUrl; ?>">
                                <a class="removeImg" data-name="remove" href="#" title="Remove" data-ID="<?php echo $doffice['dofficeimg']; ?>">x</a>
                            </div>
                      <?php } ?>
                    </div>
                </div>
            </td>
        </tr>
        </table>
     </fieldset>
	 <p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="d_office" value="save" style="display:none;" />
	</p>

    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px; float:left; width:100%;">
	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Social Media Details.</strong></legend>
	<table class="form-table">
        <?php 
        $socialmedia =get_option('socialmedia');
        
        if(!empty($socialmedia)){
            foreach ($socialmedia as $key => $value) { ?>
            <tr valign="top" class='Mrow'>
                <th scope="row"><label for="sociallink">Social Link</label></th>
                <td class="w-75">
                    <div class='main-box'>
                    <div class='contentData'>
                    <input name="smedianame[]" type="text"  value="<?php if(isset($value['smedianame'])){ echo $value['smedianame']; } ?>" class="regular-text" />
                    <?php if(!empty($value['smediaimg'])){
                        echo  "<a class='button insertImage-soffice imgInsert' href='javascript:void(0)' style='display:none'>Add Image</a>";
                     }else{
                       echo  "<a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Image</a>";
                    } ?>
                    
                    <input type='hidden' name='smediaimg[]' class='imgVal' value='<?php if(isset($value['smediaimg'])){ echo $value['smediaimg']; } ?>' /></div>
                    <div class='preview_img'>
                        <?php if(!empty($value['smediaimg'])){
                             $imgUrl = wp_get_attachment_image_url( $value['smediaimg'], array( 80, 80 ) ); ?>
                            <div class="removeDiv">
                                <img src="<?php echo $imgUrl; ?>">
                                <a class="removeImg" data-name="remove" href="#" title="Remove" data-ID="<?php echo $value['smediaimg']; ?>">x</a>
                            </div>
                      <?php } ?>
                    </div>
                </div>
                </td>
               <?php  
                if($key==0){
                    continue;
                }else{
                    echo '<td><a  class="button remove" href="javascript:void(0)">Remove</a></td>';
                } ?>
            </tr>
        <?php }
        }else{ ?>
                <tr valign="top" class='Mrow'>
                    <th><label for="officeadd">Social Link</label></th>
                    <td>
                    <div class='main-box'>
                        <div class='contentData'>
                        <input name="smedianame[]" type="text" class="regular-text" />
                        <a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Icon</a>
                        <input type='hidden' name='smediaimg[]' class='imgVal' value='' /></div>
                        <div class='preview_img'></div>
                    </div>   
                    </td>
                </tr>
       <?php } ?>
		
        <tfoot>
            <tr>
                <td ></td>
                <td colspan="4" ><a id="social-row" class="button addRowTable" href="javascript:void(0)">Add Row</a></td>
            </tr>
        </tfoot>
	</table>
	</fieldset>
	<p class="submit">
 	   <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
  	  <input type="hidden" name="social_media" value="save" style="display:none;" />
    </p>

    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Copywrite Text</strong></legend>
        <?php $cpywritemsg =get_option('cpywritemsg'); ?>
	    <table class="form-table">
        <tr valign="top">
            <th><label for="cpywritemsg">Copywrite Text</label></th>
            <td>
                <div class='main-box'>
                    <div class='contentData'>
                        <?php  echo  strip_tags($cpywritemsg['cpywritemsg']); ?>
                    <input name="cpywritemsg" type="text" class="regular-text" value='<?php if(!empty($cpywritemsg['cpywritemsg'])){
                        echo trim($cpywritemsg['cpywritemsg']);
                    } ?>' />
                </div>
            </td>
        </tr>
        </table>
     </fieldset>
	 <p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="cpywrite" value="save" style="display:none;" />
	</p>

</form>
<style>
.main-box {
    display: flex;    
}
.form-table label {
	margin-left: 50px;
}
.removeDiv {
        max-width: 50px;
        max-height: 50px;
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
	top: -10px;
	right: 2px;
	font-size: 20px;
    color:red;
}

    .removeDiv:hover .removeImg {
        opacity: 1;
    }

</style>
<script type="text/javascript">
    jQuery('.addRowTable').click(function(){
        let iD =jQuery(this).attr('id');
        if(iD =='office-row'){
            let trLength =jQuery('.srow').length;
            if(trLength < 4){
                let row =`
                <tr valign="top" class='srow'>
                <th><label for="officeadd">Address</label></th>
                <td>
                <div class='main-box'>
                    <div class='contentData'>
                    <input name="sofficeadd[]" type="text" class="regular-text" />
                    <a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Image</a>
                    <input type='hidden' name='sofficeimg[]' class='imgVal' value='' /></div>
                    <div class='preview_img'></div>
                </div>   
                </td>
                <td><a  class="button remove" href="javascript:void(0)">Remove</a></td>
            </tr>`;
            jQuery(this).parents('tfoot').siblings('tbody').append(row);
            if(jQuery('.srow').length ==4){
                jQuery('#'+iD).hide();
            }else{
                jQuery('#'+iD).show();
            }
            }else{
                jQuery('#'+iD).show();
            }

        }else{
            let trLength =jQuery('.Mrow').length;
            console.log(trLength);
            if(trLength < 4){
                let row =`
                <tr valign="top" class='Mrow'>
                    <th><label for="officeadd">Social Link</label></th>
                    <td>
                    <div class='main-box'>
                        <div class='contentData'>
                        <input name="smedianame[]" type="text" class="regular-text" />
                        <a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Icon</a>
                        <input type='hidden' name='smediaimg[]' class='imgVal' value='' /></div>
                        <div class='preview_img'></div>
                    </div>   
                    </td>
                    <td><a  class="button remove" href="javascript:void(0)">Remove</a></td>
                </tr>`;
            jQuery(this).parents('tfoot').siblings('tbody').append(row);
            if(jQuery('.Mrow').length ==4){
                jQuery('#'+iD).hide();
            }else{
                jQuery('#'+iD).show();
            }
            }else{
                jQuery('#'+iD).show();
            }

        }
    });

    jQuery(document).on('click','.remove',function(){
        jQuery(this).parents('tr').remove();
        if(jQuery(this).parents('tr').attr('class') =='srow'){
            jQuery('#office-row').show();
        }else{
            jQuery('#social-row').show();
        }
        
    });

    jQuery(document).on('click', '.insertImage-soffice', function() {
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

                    that.parent('.contentData').siblings('.preview_img').append(
                        '<div class="removeDiv"><img src="' + attach.url +
                        '"><a class="removeImg" data-name="remove" href="#" title="Remove" data-ID="' +
                        attach.id + '">x</a></div>');

                    that.parent('.contentData').siblings('.preview_img').show();

                    that.siblings('.imgVal').val(attach.id);
                    that.hide();
                })
                .open();
        });

        jQuery(document).on('click','.removeImg',function(e){
            e.preventDefault();
            jQuery(this).siblings('img').attr('src','');
            jQuery(this).parents('.preview_img').siblings('.contentData').find('.insertImage-soffice').show();
            jQuery(this).parents('.preview_img').siblings('.contentData').find('.imgVal').val('');
            jQuery(this).parents('.preview_img').find('.removeDiv').remove();
            jQuery(this).hide();
            

        });
	

</script>
<?php }
?>