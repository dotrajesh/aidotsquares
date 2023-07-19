<?php
$responce =[];
if (isset($_POST['name']) && trim($_POST['name']) != '') {

		$strEmailCont = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
			<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/> 
			<title>:: AI Contact Email ::</title>
		</head>
		<body style='background: #fff;'>
		<table width='700px' border='0' cellpadding='7' cellspacing='0' style='border:1px solid #ccc; font:12px verdana;' align='center'>
		  <tr>
			<td colspan='2' align='left' bgcolor='#FFFFFF' style='border-bottom:1px solid #ccc;'><img src='https://ai.dotsquares.com/assets/img/ds-logo-blue.png' alt='' /></td>
		  </tr>";

			$emailContectTitle = '';
			$strEmailCont .= "<tr>
		  <td colspan='2' align='left' bgcolor='#FFFFFF' style='border-bottom:1px solid #ccc;'><b>AI $emailContectTitle Query</td>
		  </b></tr>";

			$strEmailCont .= "<tr>
			<td width='206' bgcolor='#F7F7F7' style='padding-left:10px;'><strong>Name :</strong></td>
			<td width='336' bgcolor='#F7F7F7'>" . $_REQUEST["name"] . "</td>
		  </tr>";

			if (isset($_REQUEST["email"]) && $_REQUEST["email"] != '' && $_REQUEST["email"] != 'Email') {
				$strEmailCont .= "<tr>
			<td width='206'  style='padding-left:10px;'><strong>Email :</strong></td>
			<td width='336' >" . $_REQUEST["email"] . "</td>
		  </tr>";
			}

			///////////////////////////////////////////////////////////////

			if (isset($_REQUEST["phone"]) && $_REQUEST["phone"] != '') {
				$strEmailCont .= "<tr>
			<td width='206' bgcolor='#F7F7F7' style='padding-left:10px;'><strong>Telephone Number :</strong></td>
			<td width='336' bgcolor='#F7F7F7' >" . $_REQUEST["phone"] . "</td>
		  </tr>";
			}

		
		if (isset($_REQUEST["country"]) && $_REQUEST["country"] != '') {
				$strEmailCont .= "<tr>
				<td width='206' bgcolor='#F7F7F7' style='padding-left:10px;'><strong>Country :</strong></td>
				<td width='336' bgcolor='#F7F7F7' >" . $_REQUEST["country"] . "</td>
				</tr>";
			}


		////////////////////////////////////////////////////////////////////////////////////////

			if (isset($_REQUEST["message"]) && $_REQUEST["message"] != '') {
				$strEmailCont .= "<tr>
						<td width='206'  style='padding-left:10px;' valign='top'><strong>Message :</strong></td>
						<td width='336' >" . $_REQUEST["message"] . "</td>
					  </tr>";
			}

			$strEmailCont .= "<tr>
						<td width='206'  style='padding-left:10px;' valign='top'><strong>IP Adress :</strong></td>
						<td width='336' >" . $_SERVER['REMOTE_ADDR'] . "</td>
					 </tr>";

			$strEmailCont .= "</table>
		</body>
		</html>";
			// echo $strEmailCont; die;
			// Header
			$headers = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\n";
			$headers .= "From:info@dotsquares.com<info@dotsquares.com>\n";
			//$headers .= "From:pankaj.belwal@dotsquares.com.com<pankaj.belwal@dotsquares.com>\n";

			//$headers .= "Cc:pmo@teaminindia.com,bankim@dotsquares.com,bankim.chandra@gmail.com,bahul@dotsquares.com,bahul.chandra@gmail.com,omkar@dotsquares.com,dsenquiries@binarydrive.com,rahul.verma@dotsquares.com,verona@dotsquares.com, info@dotsquares.com\n";
			//$headers .= "Bcc:rahul.verma@dotsquares.com\n";			
			//$to = "pmo@dotsquares.com";
			
			 //$to = "pankaj.belwal@dotsquares.com";
			 // $to = "surendra.parihar@dotsquares.com";
			 $to = "archit.dada@dotsquares.com";
			
			$mailResult = wp_mail($to, "Enquiry from ai Website", $strEmailCont, $headers);

			if($mailResult){
				$responce['email'] = true;
			}else{
				$responce['email'] = false;
			}

			if($_SERVER['HTTP_HOST']=='ai.dotsquares.com') {
				$client = 'http://dsc.dotsquares.com/Leadservercurl/select_member_info';
			} else {
				// $client = new nusoap_client('https://dsc.dotsquares.com/Leadserverr/select_member_info/wsdl');
				$client = 'http://uatdsc.dotsquares.com/Leadservercurl/select_member_info';
			}
			$searchUrl = '';
			$params = array(
				'lead_name' => "Lead from ai.dotsquares.com by ".$_REQUEST['name'],
				'contact_name' => $_REQUEST['name'],
				'email_id' => $_REQUEST['email'],
				'company_name' => '',
				'company_address' => '',
				'phone' => $_REQUEST['phone'],
				'quote_for' => '',
				'summary_work_required' => $_REQUEST['message'],
				'detail_specification' => '',
				'country' => isset($_REQUEST['country'])?$_REQUEST['country']:'',
				'source' => 'ai.dotsquares.com',
				'lead_quality' => 'M',
				'lead_status' => 'Lead',
				'webservice_type' => 'inquiry',
				'source_website' => 'ai.dotsquares.com',
				'search_keywords' => '',
				'search_url' => 'https://ai.dotsquares.com',
				'gdpr_All' => 1,
				'gdpr_Offers_and_Events' => 0,
				'gdpr_Marketing' => 1,
				'gdpr_Important_Technical_Updates' => 1,
				'gdpr_latitude' => '1',
				'gdpr_longitude' => '1',
				'gdpr_ip' => $_SERVER['REMOTE_ADDR']
			);

			$fields_string = http_build_query($params);
			//open connection
			$ch = curl_init();

			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, $client);
			curl_setopt($ch,CURLOPT_POST, 1);
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

			//execute post
			$result = curl_exec($ch);

			if($result){
			$responce['type'] = 'success';
			}else{
				$responce['type'] = 'fail';
			}
			
			curl_close($ch);
			//exit;

			echo json_encode($responce);
			wp_die();
		
	
} else {
	header("Location:https://ai.dotsquares.com/");
    $responce['msg'] = "Something else";
	$responce['type'] = 'error';
	//echo $res['type'];
	echo json_encode($responce);	
	// header("Location:index.php#enquire-section");
	//exit;
	wp_die();
} 
?>