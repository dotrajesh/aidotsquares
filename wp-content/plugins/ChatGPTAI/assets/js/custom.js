jQuery(document).ready(function($){

    $('#copyshortcode').click(function(){
      let copytext=  $(this).text();
      navigator.clipboard.writeText(copytext);
      $('#copytext').show().delay(3000).fadeOut();
    });

    $('#chatselect').on('change',function(){
		$('.itenaryview').hide();
		$('.commanview').hide();
		$('.langview').hide();
		$('.codeview').hide();
        $('.userInput').val('');
        $('.rowoutput').hide();
		$('.error-effect').text('').hide();

        if($(this).val()=='IG'){
            $('.itenaryview').show();
        }else{
            if($(this).val()=='CW'){
                $('.codeview').show();
            }
            else if($(this).val()=='LT'){
                $('.langview').show();
            }else{
                $('.commanview').show();
            }
            $('.commanview').show();
        } 
    });

    $('#save').click(function(e){
        e.preventDefault();
        $('.message').text('').hide();
        $('.errorapi').hide();
        $('.errormodel').hide();
        let gptapi = $('#gptapi').val();
        let modelid = $('#modelid').val();
        let errorapi =false;
        let errormodel =false;

        if(gptapi ==''){
            errorapi =true;
            $('.errorapi').text('Input field empty').css('color','red').show();
        }else{
            errorapi =false;
            $('.errorapi').text('').hide();
        }

        if(modelid ==''){
            errormodel =true;
            $('.errormodel').text('Input field empty').css('color','red').show();
        }else{
            errormodel =false;
            $('.errormodel').text('').hide();
        }
        
        if((errorapi==true) && (errormodel==true)){
            $('.message').text('Input field empty').css('color','red').show();
        }else if(errorapi==true){
            $('.errorapi').text('Input field empty').css('color','red').show();
        }else if(errormodel==true){
            $('.errormodel').text('Input field empty').css('color','red').show();
        }else{
            $('.loader').show();
            $.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                data: {
                    action: 'apifunction',
                    gptapi: gptapi,
                    modelid: modelid
                },
                success: function (data) {
                    $('.loader').hide();
                    let res = JSON.parse(data);
                    if (res['status'] == true) {
                        $('.message').text('Data Save...').css('color','green').show().delay(5000).fadeOut();
                        $('#gptapi').val(res['apikey']);
                        $('#modelid').val(res['modelid']);
                        
                    } else {
                        $('.message').text('Something wentwrong!').css('color','red').show().delay(5000).fadeOut();
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                  }
            });
        }
    });


    /********************Front End Request Send*************/
    $('#sendRequest').click(function(e){
        e.preventDefault();
        $('.rowoutput').hide();
        $('#output').val('');
        var idName = $(this).attr("id");
        formAjax(idName);
    });

    /********************Front End Request send End*************/
    $('.savePrompt').click(function(){
        var prompt = [];
        $('.errorprompt').text('').hide();
        $(".prompt-group .prompt-list").each(function(index, item) {
            if ($(this).find("input[type=checkbox]").prop("checked")) {
             prompt.push({
                pval: $(this).find(".prompt-input").val(), 
                name:  $(this).find('span').text()
            })
            }
        });

        if(prompt.length === 0){
            $('.errorprompt').text('Please Select At least one prompt.').css('color','red').show();
        }else{
            $('.loader').show();
            $.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                data: {
                    action: 'promptfunction',
                    prompt: prompt
                },
                success: function (data) {
                    $('.loader').hide();
                     let res = JSON.parse(data);
                    if (res['status'] == true) {
                        $('.msgprompt').text(res['msg']).css('color','green').show().delay(5000).fadeOut();
                        
                    } else {
                        $('.errorprompt').text(res['msg']).css('color','red').show().delay(5000).fadeOut();
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                  }
            });
        }
    });
    
    $('.sendadminRequest').unbind('click').bind('click', function (e){
        e.preventDefault();
        var idName = $(this).attr("id");
        formAjax(idName);
    });
});


function formAjax(formID){

    let gpttype =jQuery('#gpttype').val();
    let userInput = jQuery('.userInput:visible').val();
    let selectVal =jQuery('#chatselect').val();
    let langSelect =jQuery('#langselect').val();
    userInput =userInput.replace(/\'/g, "");
    var lang ='';
    let codeSelect ='';
    let itenarySelect ='';
    let errortype =false;
    let errorselect =false;
    let errortext =false;

    if(gpttype ==''){
        errortype =true;
        jQuery('.errortype').text('Select Type Field Required*').css('color','red').show();
    }else{
        errortype =false;
        jQuery('.errortype').text('').hide();
    }

    if(selectVal ==''){
        errorselect =true;
        jQuery('.errorselect').text('Select Field Required*').css('color','red').show();
    }else{
        errorselect =false;
        jQuery('.errorselect').text('').hide();
    }

    if(userInput ==''){
        errortext =true;
        jQuery('.errortext:visible').text('Textarea Field Empty').css('color','red').show();
    }else{
        errortext =false;
        jQuery('.errortext').text('').hide();
    }

    if(jQuery('.langview').css('display') == 'block'){
        lang=langSelect;
    }

    if(jQuery('.codeview').css('display') == 'block'){
        codeSelect=jQuery('#codeselect').val();
    }

    if(jQuery('.itenaryview').css('display') == 'block'){
        itenarySelect=jQuery('#itebarayselect').val();
    }
    
    if((errortype==true) && (errorselect==true) && (errortext==true)){
        jQuery('.msg').text('Input field empty').css('color','red').show();
    }else if(errortype==true){
        jQuery('.errortype').text('Select type empty').css('color','red').show();
    }else if(errorselect==true){
        jQuery('.errorselect').text('Select Value empty').css('color','red').show();
    }else if(errortext==true){
        jQuery('.errortext').text('Input field empty').css('color','red').show();
    }else{
        jQuery('.loader').show();
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            data: {
                action: 'curlfunction',
                selectType: gpttype,
                selectVal: selectVal,
                textVal: userInput,
                lang:lang,
                codeSelect:codeSelect,
                itenarySelect:itenarySelect
            },
            success: function (result) {
                jQuery('.loader').hide();
                 let res = JSON.parse(result);
                if (res['status'] == 200) {

                    if(formID=='sendadminRequest'){
                        var activeEditor = tinyMCE.get('content');
                        if(activeEditor!==null){
                            let getData =activeEditor.getContent();
                            //console.log(jQuery.trim(res.finalText));
                           
                            if(selectVal=='SA'){
                                
                                activeEditor.setContent(getData + '<p class="chatAppend">' + jQuery.trim(res.finalText).split('with')[0]+'</p>');
                            }else{
                                activeEditor.setContent(getData + '<p class="chatAppend">' + jQuery.trim(res.finalText)+'</p>');
                            }
                            
                        }else{
                            let newParagraphBlock ='';
                            if(selectVal=='SA'){
                                let paragraph = jQuery.trim(res.finalText).split("with")[0];
                                 newParagraphBlock = wp.blocks.createBlock( 'core/paragraph', { content:  paragraph  });
                            }else{
                                let paragraph = jQuery.trim(res.finalText);
                                newParagraphBlock = wp.blocks.createBlock( 'core/paragraph', { content:  paragraph  });
                            }
                          
                            wp.data.dispatch( 'core/block-editor' ).insertBlocks([newParagraphBlock]);
                        }
                    }else{
                        jQuery('.msg').text('Some thing for you...').css('color','green').show().delay(5000).fadeOut();
                        jQuery('.rowoutput').show();
                        if(selectVal=='SA'){
                            jQuery('#output').val(jQuery.trim(res.finalText).split('with')[0]);
                        }else{
                            jQuery('#output').val(jQuery.trim(res.finalText));
                        }
                    }
                   
                } else {
                    jQuery('.msg').text(res.errorMsg).css('color','red').show().delay(5000).fadeOut();
                    jQuery('.rowoutput').show();
                    jQuery('#output').val(res.errorMsg);
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
              }
        });
    }

}

/************shotcode button*********/
(function() {
    tinymce.PluginManager.add( 'chatgptai', function( editor ){
          editor.addButton( 'chatgptai', {
              type: 'button',
              text: 'chatgptai',
              icon: false,
              onclick: function(){
                        editor.insertContent( '[chatgptai]');
                }
          });
      });
})();
