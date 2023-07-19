<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if(!empty(get_option('chatgptai'))){
	$result = get_option('chatgptai');
	$reskey =$result['gptkey'];
	$modeid =$result['modelid'];
}
?>
<div class="chatgpt-ai">
<h1 class="wp-heading-inline">Configraution Details</h1>
<div class="custom-tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="general" data-bs-toggle="tab" data-bs-target="#general-pane"
                type="button" role="tab" aria-controls="general-pane" aria-selected="true">General</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="prompt-tab" data-bs-toggle="tab" data-bs-target="#prompt-tab-pane"
                type="button" role="tab" aria-controls="prompt-tab-pane" aria-selected="false">Prompt</button>
        </li>
       
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="general-pane" role="tabpanel" aria-labelledby="home-tab"
            tabindex="0">
            <div class="container-fluid">
				<div class="row">
				  <div class="col-8">
					<h3>General</h3>
					<div class='message' style="display:none"></div>
					<form method="post">
					  <div class="form-group form-outline mb-2">
						<label for="gptapi">Open Api Key </label>
						<input type="text" id="gptapi" class="form-control" name="gptkey" value="<?php if(isset($reskey)){ echo $reskey; } ?>"/>
						<p class="errorapi" style="display:none"></p>
					  </div>
					  <div class="form-group form-outline mb-2">
						<label for="modelid">Model Id</label>
						<input type="text" id="modelid" class="form-control" name='modelid' value='<?php if(isset($modeid)){ echo $modeid; } ?>'/>
						<p class='errormodel' style="display:none"></p>
					  </div>
					  <div class="d-flex align-items-center mt-3">
						<button type="submit" name='SUBMIT' class="btn btn-success btn-block btn-lg text-light mt-2" id='save'>Save</button>
						  <div class="spinner-border loader" role="status" style='display:none !important'>
							<span class="visually-hidden">Loading...</span>
						  </div>
					  </div>
					</form>
				  </div>
				  <div class="col-4">
					<div class="border-left h-100">
					  <h3>Chat GPT AI Shortcode</h3>
					  <p id='copyshortcode'><strong><?php echo '[chatgptai]'; //echo '[chatgptai type="completions"]';  ?></strong></p>
					  <p id='copytext' style='display: none; color:green;'>Shortcode Copy.</p>
					</div>
				  </div>
				</div>
			</div>
        </div>
        <div class="tab-pane fade" id="prompt-tab-pane" role="tabpanel" aria-labelledby="prompt-tab" tabindex="0">
           <?php 
			require_once ABSPATH . 'wp-content/plugins/ChatGPTAI/promptlistconfig.php';
			?>
			<div class="selectdiv">
			  <div class="checkbox-custom">
				<div class="container">
				  <div class="row">
					<div class="col-7">
						<h3>Prompts</h3>
						<span>Please select one or more prompts</span>
						<p class="errorprompt" style="display:none"></p>
						<p class="msgprompt" style="display:none"></p>
						<div class="list-group prompt-group">
						<?php $arr_promt=[];
							foreach($allPrompts as $key=>$prompt){ 
							  $promptget =get_option('chatgptprompt');
								 if(!empty($promptget)){
								  foreach($promptget as $promt){
										if($promt["pval"] == $key){ 
											array_push($arr_promt,$key);
										}
									}
								}
							}

							foreach($allPrompts as $key=>$prompt){ ?>	
								<label class="list-group-item prompt-list">
									<input class="form-check-input me-1 prompt-input" type="checkbox" value="<?php echo $key; ?>"  <?php if(in_array($key,$arr_promt)){
										echo "checked=checked"; }else{ } ?> >
									<span><?php echo $prompt; ?></span>
								</label>
							<?php } ?> 
						</div>
						<div class="d-flex align-items-center mt-3">
							<button type="submit" name="submit" class="btn btn-success btn-block btn-lg text-light mt-2 savePrompt">Save</button>
							<div class="spinner-border loader" role="status" style='display:none !important'>
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
    </div>
</div>
<div class="border"></div>
</div>

