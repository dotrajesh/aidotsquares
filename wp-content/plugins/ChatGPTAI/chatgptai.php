<?php 
/*
 Plugin Name: ChatGPT AI
 Plugin URL: https://www.dotsquares.com/
 Description: ChatGPT AI.
 Version: 1.0.0
 Author: Dotsquares
 Author URI: https://www.dotsquares.com/
*/

global $wpdb;

function activePlugin(){
	$chatgptai_version = "1.0.0";
	if (!get_option('chatgpt_ai_version')) {
		add_option("chatgpt_ai_version", $chatgptai_version);
	}else{
		update_option("chatgpt_ai_version", $chatgptai_version);
	}

	if (!get_option('chatgptprompt')) {
		promptsCheck();
	}
}

function deactivatePlugin(){
    flush_rewrite_rules();
}

register_activation_hook(__File__,'activePlugin');
register_deactivation_hook( __FILE__, 'deactivatePlugin');


add_action('admin_enqueue_scripts', 'chatgpt_plugin_style');
add_action( 'wp_enqueue_scripts', 'chatgpt_plugin_style' );


function chatgpt_plugin_style() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_script( 'tinymce_min', '//cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js');
	if(wp_script_is('jquery')) {
		// do nothing
	} else {
		wp_enqueue_script( 'jquery_min', $plugin_url . 'assets/js/jquery.min.js');
	}
    //wp_enqueue_script( 'jquery_min', $plugin_url . 'assets/js/jquery.min.js');
	wp_enqueue_script( 'jq-tinymce_min', '//cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js');
    wp_enqueue_script( 'custom', $plugin_url . 'assets/js/custom.js','','',true);
    wp_localize_script( 'custom', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action('admin_menu','adminMenucreate');

function adminMenucreate(){
    
add_menu_page('Chat Gpt AI','Chat Gpt AI','manage_options','chat-gpt-ai','chatgptFunction',plugins_url( '/assets/images/Chatgptaiicon.png', __FILE__ ),5); 
//add_submenu_page('chat-gpt-ai','General','General','manage_options','chat-gpt-ai','chatgptFunction');
//add_submenu_page('chat-gpt-ai','singin','singin','edit_posts','singin','signin_post_info_page');

}

function chatgptFunction(){
	fileInclude('configurations.php');
}

function chatgptai_custom_block_script_register(){
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_script('chatgpt-custom-block',$plugin_url .'assets/js/chatgptai-guternburg.js',array('wp-blocks','wp-i18n','wp-editor'),true,false);
}
add_action( 'enqueue_block_editor_assets', 'chatgptai_custom_block_script_register' );

add_action("wp_ajax_apifunction", "apifunction");
add_action("wp_ajax_nopriv_apifunction", "apifunction");

function apifunction(){
    $gptapi = $_POST['gptapi'];
    $modelid = $_POST['modelid'];
    $responce =array();

    $data =array('gptkey'=>$gptapi,'modelid'=>$modelid);
    $res_gptkey= update_option('chatgptai',$data);
    if($res_gptkey){
        $responce['status']=true;
        if(!empty(get_option('chatgptai'))){
            $result = get_option('chatgptai');
            $responce['apikey']  =$result['gptkey'];
            $responce['modelid'] =$result['modelid'];
        }
    }else{
        $responce['status']=false;
    }
    echo json_encode($responce);
    wp_die();
}


function getAllModels(){
	
	$curlResult = curlLoad('models','GET','');
	$curlResultArray	=	json_decode($curlResult,true);
	return $curlResultArray;	
}


add_action("wp_ajax_curlfunction", "getChatGPTAIResult");
add_action("wp_ajax_nopriv_curlfunction", "getChatGPTAIResult");
function getChatGPTAIResult(){
    $promtType 	=	 $_REQUEST['selectVal'];
    $promptText =	 $_REQUEST['textVal'];
	$lang 		=    $_REQUEST['lang'];
	$codeSelect =    $_REQUEST['codeSelect'];
	$itenarySelect = $_REQUEST['itenarySelect'];
    $finalResponse = array();
	if(!empty(get_option('chatgptai'))){
        $configurationDetails = get_option('chatgptai');
		$modelId	=	$configurationDetails['modelid'];
    }
   // $modelId	=	'text-davinci-003';	
	if($promtType=='LT'){
		$finalPrompt = "Translate '$promptText' to '$lang'"; 
	}else if($promtType=='SA'){
		$finalPrompt = "Detect the sentiment of this text with confidential score: '$promptText'"; 
	}else if($promtType=='TS'){
		$finalPrompt = "Summarize this text '$promptText"; 
	}else if($promtType=='CW'){		
		$finalPrompt = "'$promptText' in '$codeSelect'"; 
	}else if($promtType=='IG'){		
		$finalPrompt = "Suggest itinerary for $promptText location for '$itenarySelect'"; 
	}else{		
		$finalPrompt = "Summarize this text '$promptText"; 
	}		
	
	$requestParam = array(
			"model" 			=>	$modelId,
			"prompt"			=>	$finalPrompt,
			"max_tokens"		=>	256,
			"temperature"		=>	0.22,
			"top_p"				=>	1, 
			"frequency_penalty"	=>	0,
			"presence_penalty"	=>	0,
			"stream"			=>	false
	);	

	$curlResult = curlLoad('completions','POST',$requestParam);	
	$curlResultObject	=	json_decode($curlResult,true);
	if($curlResultObject['error'] && !empty($curlResultObject['error'])){
		$finalResponse['status']=400;
		$finalResponse['errorMsg'] =$curlResultObject['error']['message'];
	}else{
		$finalResponse['status']=200;
		$finalResponse['apiFinalResult'] =	$curlResultObject;
		$finalResponse['finalText'] =$curlResultObject['choices'][0]['text'];
	}
   
   echo json_encode($finalResponse,true);
   wp_die();
}

add_action("wp_ajax_promptfunction", "savePrompt");
add_action("wp_ajax_nopriv_promptfunction", "savePrompt");

function savePrompt(){
	$res_prompt =update_option('chatgptprompt',$_REQUEST['prompt']);
	if($res_prompt){
        $responce['status']=true;
		$responce['msg']='Prompt Save';
        
    }else{
        $responce['status']=false;
		$responce['msg']='Prompt Not Save';
    }
    echo json_encode($responce);
	wp_die();
}


function curlLoad($url,$method,$paylodData){
	$apiURL		=	'https://api.openai.com/v1/';
    if(!empty(get_option('chatgptai'))){
        $configurationDetails = get_option('chatgptai');
		$apiKey		=	$configurationDetails['gptkey'];
    }
	$curlURL = $apiURL.$url;	
	$payload = json_encode($paylodData);
	$ch	=	curl_init($curlURL);
			curl_setopt($ch, CURLOPT_URL,$curlURL);
			curl_setopt($ch, CURLOPT_HTTPHEADER,array(
								"Content-Type:	application/json; charset=utf-8", 
								"Authorization: Bearer ".$apiKey                         
								)
						);  
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			
	
	$curlResult = curl_exec($ch);		
	curl_close($ch);
	
	return $curlResult;
}

function chatGptAishortcode(){
	ob_start();
	fileInclude('shortcodeform.php');
	return ob_get_clean();
}
add_shortcode('chatgptai', 'chatGptAishortcode');

/***********mce button ********/

function chatgptai_plugin_register_buttons( $buttons ) {
	$buttons[] = 'chatgptai';
	return $buttons;
}
// add new buttons
add_filter( 'mce_buttons', 'chatgptai_plugin_register_buttons' );

function chatgptai_plugin_register_plugin( $plugin_array ) {
	$plugin_array['chatgptai'] = plugins_url( '/assets/js/custom.js', __FILE__ );
	return $plugin_array;
}
// Load the TinyMCE plugin
add_filter( 'mce_external_plugins', 'chatgptai_plugin_register_plugin' );


/*********************admin meta box *****************/
function chatgptai_register_meta_boxes() {
	foreach ( array_keys( $GLOBALS['wp_post_types'] ) as $post_type )
    {
        if ( in_array( $post_type, array( 'attachment', 'revision', 'nav_menu_item','acf-field-group' ) ) )
            continue;
		add_meta_box( 'chatgpt', __( 'CHAT GPT AI', 'chatgpt' ), 'chatgpt_display_callback',$post_type,"side", "high", null);
    }
}
add_action( 'add_meta_boxes', 'chatgptai_register_meta_boxes');

function chatgpt_display_callback() {
	fileInclude('adminform.php');
}

function fileInclude($file){
	$plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'bootsrap-css', $plugin_url . 'assets/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style( 'style-custom', $plugin_url . 'assets/css/style.css');
	include($file);
	wp_enqueue_script( 'bootstrap.min.js', $plugin_url . 'assets/bootstrap/js/bootstrap.min.js');
}

function promptsCheck(){
	require_once ABSPATH . 'wp-content/plugins/ChatGPTAI/promptlistconfig.php';
	$arr_prompt =[];
	foreach($allPrompts as $key=>$prompt){
		$promts =[];
		$promts['pval'] = $key;
		$promts['name'] = $prompt;
		array_push($arr_prompt,$promts);
	}
	add_option("chatgptprompt", $arr_prompt);
}

?>