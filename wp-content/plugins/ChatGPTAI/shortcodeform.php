<div class='short-form-section chatgpt-ai'>
  <h3>Chat GPT AI</h3>
  <form method="post">
    <div class="form-group form-outline mb-2">
      <label for="chatselect">Select Prompt</label>
      <p class='errorselect error-effect' style="display:none"></p>
      <select class="form-select" name='apiselect' id='chatselect' aria-label="Default select example">
        <option value="">Select</option>
        <?php $prompt =get_option('chatgptprompt');
        if(!empty($prompt)){
        foreach($prompt as $promt){
        echo '<option value="'.$promt["pval"].'">'.$promt["name"].'</option>';
        }
        }else{
        echo '<option value="">Value not select</option>';
        }
        ?>
      </select>
    </div>
    
    <div class="form-group form-outline mb-2 langview" style="display:none">
      <label for="chatselect">Select Language</label>
      <p class='errorlang error-effect' style="display:none"></p>
      <select class="form-select" name='langselect' id='langselect' aria-label="Default select example">
        <option value="English">English</option>
        <option value="French">French</option>
        <option value="Hindi">Hindi</option>
        <option value="Spanish">Spanish</option>
      </select>
    </div>
    <div class="form-group form-outline mb-2 codeview" style="display:none">
      <label for="codeselect">Select Technology</label>
      <p class='errorlang error-effect' style="display:none"></p>
      <select class="form-select" name='codeselect' id='codeselect' aria-label="Default select example">
        <option value="PHP">PHP</option>
        <option value="Java">Java</option>
        <option value="Nodejs">Node Js</option>
        <option value="Python">Python</option>
      </select>
    </div>

    <div class="form-group form-outline mb-2 commanInput commanview">
      <label for="chattextarea">Ask anything you want.</label>
      <p class='errortext error-effect' style="display:none"></p>
      <textarea id='chattextarea' name="chattextarea" class="form-control userInput"
      aria-label="With textarea" row="10"></textarea>
    </div>

    <!-----------------Itenary section ------------------------------>
    <div class="form-group form-outline mb-2 commanInput itenaryview" style="display:none">
      <label for="chattextarea">Where to you go.?</label>
      <p class='errortext error-effect' style="display:none"></p>
      <input type='text' class='form-control userInput' value='' >
    </div>
    <div class="form-group form-outline mb-2 itenaryview" style="display:none">
      <label for="itebarayselect">How many days?</label>
      <p class='erroritenaray error-effect' style="display:none"></p>
      <select class="form-select" name='itenarayselect' id='itebarayselect' aria-label="Default select example">
        <?php for($i=1;$i<11; $i++){
            echo '<option value="'.$i.'">'.$i.'</option>';    
        } ?>
      </select>
    </div>
    <!-----------------Itenary section end------------------------------>

    <div class="d-flex align-items-center mt-3">
      <button type="submit" name='SUBMITFORM' class="btn btn-success btn-block btn-lg text-light mt-2"
      id='sendRequest'>Send Request</button>
      <div class="msg" style="display:none"></div>
      <div class="spinner-border loader" role="status" style='display:none !important'>
        <span class="sr-only"></span>
      </div>
    </div>
  </form>
 
  <div class='mt-3 rowoutput' style="display:none">
    <div class='col'>
      <div class="form-group form-outline mb-2">
        <label for="output">Your Result Here</label>
        <textarea id='output' name="output" class="form-control" aria-label="With textarea" style="height:500px"></textarea>
      </div>
    </div>
  </div>
</div>