<?php


function sendGCM($title  , $message, $fcm_id , $p_id, $p_name) {
	//$message = utf8_decode($message);

    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array (
            'registration_ids' => array (
                     $fcm_id
            ),
          'priority' =>'high',
          'content_available' => true,

            'notification' => array (
			       "body" =>  $message,
      		   "title" =>  $title,
			       "click_action" => "FLUTTER_NOTIFICATION_CLICK",
					   "sound" => "default"

            ),
			 'data' => array (
					"page_id" => $p_id ,
					"page_name" => $p_name
//			'message' => 'Hello World!'
            )

    );
    $fields = json_encode ( $fields );

    $headers = array (
           // 'Authorization: key=' . "AIzaSyBUuLepXI4xjIuWBO78hagHX9ntj9j_mU4",
		    'Authorization: key=' . "AAAAfKpPgTk:APA91bHkrVs2fM8XCPoYnzhYLGOU3gSIcuiMc--Ubw3ogDEy3Ppdv61vNRgacIa6KUsKTK2DqcXoKbBpUEEX-QnJ3Zh17J_Z1dSmIcq9nq5syJ0Wv_SGjdAd_Cp9K3-NJrgyg54Fsi0D",
            'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
    return $result;
    curl_close ( $ch );
}


?>