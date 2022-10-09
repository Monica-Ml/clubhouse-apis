<?php
require_once('modules/autoload.php');


$token_array=array('YourToken1','YourToken2','YourToken3'); // enter your tokens here
$channel=''; 								// enter target channel code
$token_count=(count($token_array))-1; 			// you can set how many token join to channel
join_to_channel($token_array,$channel,$token_count);

function join_to_channel($token_array,$channel,$token_count){
	try {
		if(!empty($token_array)){	
			if(!empty($channel)){
				if(!empty($token_count)){
					// join to channel
					$obj_clb_sub_fuc = new clubhouse_sub_fuc();
	        		list($res_flg,$res_msg)=$obj_clb_sub_fuc->sub_join_channel($token_count,$token_array,$channel);
	        		if(!$res_flg){
	        			echo 'joining failed -> '.$res_msg.'</br>';
	        		}else{
	        			echo 'successfully'.'</br>';
	        		}
      			}else{
					echo 'Error: channel is empty'.'</br>';
				}
			}else{
				echo 'Error: token count is empty'.'</br>';
			}
		}else{
			echo 'Error: token list is empty'.'</br>';
		}
	} catch (Exception $e) {
		//echo 'Caught exception: ',  $e->getMessage(), "\n";
	    echo 'token list - error 1000'.'</br>';
	}
}
