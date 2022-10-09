<?php
class clubhouse_general_fuc{
  private const DEF_API_URL='https://www.clubhouseapi.com/api/';
  private const DEF_JOIN_CHANNEL = 'join_channel';
  private const DEF_LEAVE_CHANNEL = 'leave_channel';
  private const DEF_JOIN_CLUB = 'join_club';
  private const DEF_LEAVE_CLUB = 'leave_club';
  private const DEF_FOLLOW_USER = 'follow';
  private const DEF_UNFOLLOW_USER = 'unfollow';
  private const DEF_SEND_CHANNEL_MESSAGE = 'send_channel_message';
  private const DEF_SHARE_CHANNEL = 'share_channel';
  private const DEF_UPDATE_CALL_STATUS = 'update_channel_user_status';
  private const DEF_AUDIENCE_REPLY = 'audience_reply';
  private const DEF_ACTIVE_PING = 'active_ping';
  private const DEF_ACCEPT_SPEAKER_INVITE = 'accept_speaker_invite';
  private const DEF_GET_CHANNEL = 'get_channel';
  private const CURL_POST_TIMEOUT= 60;

  private function post_request($url,$post_fields,$token,$connection_status='close'){
    try {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => 'gzip',
        //CURLOPT_MAXREDIRS => 10,
        //CURLOPT_TIMEOUT => self::CURL_POST_TIMEOUT,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        //CURLOPT_FRESH_CONNECT => true,
        CURLOPT_POSTFIELDS => $post_fields,
        CURLOPT_HTTPHEADER => array(
          'CH-Languages: en-US',
          'CH-Locale: en_US',
          'Accept: application/json',
          'Accept-Encoding: gzip, deflate',
          'CH-AppBuild: 2576',
          'CH-AppVersion: 1.0.0',
          'CH-UserID: 1387526936',
          'User-Agent: clubhouse/490 (iPhone; iOS 14.4; Scale/2.00)',
          'Connection: '.$connection_status,
          'Content-Type: application/json; charset=utf-8',
          'Cache-Control: no-cache',
          'Authorization: Token '.$token
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      $errors = curl_error($curl);
      $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      //print_r($response);//comment
      if($response_code==200){
        $obj = json_decode($response);
        if (isset($obj->success)) {
          if ($obj->success == true) {
            return array(true,'successfully');
          }else{
            return array(false,'error 1003');
          }
        }else{
          return array(false,'error 1002');
        }
      }else{
        return array(false,'error 1001');
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 1000');
    }
  }

  protected function join_channel($token,$channel){
    try {
      $url=self::DEF_API_URL.self::DEF_JOIN_CHANNEL;
      $data = '{
        "channel": "'.$channel.'"
      }';
      //$connection_status='alive';//comment
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 2000');
    }
  }

  protected function leave_channel($token,$channel){
    try {
      $url=self::DEF_API_URL.self::DEF_LEAVE_CHANNEL;
      $data = '{
        "channel": "'.$channel.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 3000');
    }
  }

  protected function join_club($token,$club_id,$source_topic_id='Hello',$message_body='null'){
    try {
      $url=self::DEF_API_URL.self::DEF_JOIN_CLUB;
      $data = '{
        "club_id": "'.$club_id.'",
        "source_topic_id": "'.$source_topic_id.'",
        "message_body": "'.$message_body.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 4000');
    }
  }

  protected function leave_club($token,$club_id){
    try {
      $url=self::DEF_API_URL.self::DEF_LEAVE_CLUB;
      $data = '{
        "club_id": "'.$club_id.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 5000');
    }
  }

  protected function follow_user($token,$user_id,$source=4){
    try {
      $url=self::DEF_API_URL.self::DEF_FOLLOW_USER;
      $data = '{
        "user_id": "'.$user_id.'",
        "source": "'.$source.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 6000');
    }
  }

  protected function unfollow_user($token,$user_id,$source=4){
    try {
      $url=self::DEF_API_URL.self::DEF_UNFOLLOW_USER;
      $data = '{
        "user_id": "'.$user_id.'",
        "source": "'.$source.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 7000');
    }
  }

  protected function send_msg_to_room_chat($token,$channel,$message='Hi'){
    //first join to channel
    try {
      $url=self::DEF_API_URL.self::DEF_SEND_CHANNEL_MESSAGE;
      $data = '{
        "channel": "'.$channel.'",
        "message": "'.$message.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 8000');
    }
  }

  protected function share_channel($token,$channel,$message='Hi'){
    //first join to channel
    try {
      $url=self::DEF_API_URL.self::DEF_SHARE_CHANNEL;
      $data = '{
        "channel": "'.$channel.'",
        "message": "'.$message.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 9000');
    }
  }

  protected function update_call_status($token,$channel,$is_on_call='true'){
    try {
      $url=self::DEF_API_URL.self::DEF_UPDATE_CALL_STATUS;
      $data = '{
        "channel": "'.$channel.'",
        "is_on_call": "'.$is_on_call.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 10000');
    }
  }

  protected function handrise($token,$channel,$raise_hands='true',$unraise_hands='false'){
    try {
      $url=self::DEF_API_URL.self::DEF_AUDIENCE_REPLY;
      $data = '{
        "channel": "'.$channel.'",
        "raise_hands": "'.$raise_hands.'",
        "unraise_hands": "'.$unraise_hands.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 11000');
    }
  }

  protected function active_ping($token,$channel){
    try {
      $url=self::DEF_API_URL.self::DEF_ACTIVE_PING;
      $data = '{
        "channel": "'.$channel.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 12000');
    }
  }

  protected function accept_speaker_invite($token,$channel,$user_id){
    try {
      $url=self::DEF_API_URL.self::DEF_ACCEPT_SPEAKER_INVITE;
      $data = '{
        "channel": "'.$channel.'",
        "user_id": "'.$user_id.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,'successfully');
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 13000');
    }
  }

  protected function get_channel($token,$channel){
    try {
      $url=self::DEF_API_URL.self::DEF_GET_CHANNEL;
      $data = '{
        "channel": "'.$channel.'"
      }';
      list($res_flg,$res_msg)=$this->post_request($url,$data,$token);
      if($res_flg){
        return array(true,$res_msg);
      }else{
        return array(false,$res_msg);
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 14000');
    }
  }
}

class clubhouse_sub_fuc extends clubhouse_general_fuc{

  public function sub_join_channel($token_count,$token_array,$channel){
    try {
      for ($i = 0; $i <$token_count; $i++) {
        list($res_flg,$res_msg)=$this->join_channel($token_array[$i],$channel);
      }
      return array(true,'successfuly');
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 20');
    }
  }

  public function sub_send_msg_to_room_chat($token_count,$token_array,$channel,$message){
    try {
      for ($i = 0; $i <$token_count; $i++) {
        list($res_flg,$res_msg)=$this->send_msg_to_room_chat($token_array[$i],$channel,$message);
      }
      return array(true,'successfuly');
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 30');
    }
  }

  public function sub_share_channel($token_count,$token_array,$channel,$message){
    try {
      for ($i = 0; $i <$token_count; $i++) {
        list($res_flg,$res_msg)=$this->share_channel($token_array[$i],$channel,$message);
      }
      return array(true,'successfuly');
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 40');
    }
  }

  public function sub_get_moderator_ids($token,$channel){
    try {
      list($res_flg,$res_msg)=$this->get_channel($token,$channel);
      if($res_flg){
        $channel_info=$res_msg;
        $moderators_UserID_array = [];
        foreach ($channel_info['users'] as &$user_info) {
          if ($user_info['is_moderator'] == 'True'){
            array_push($moderators_UserID_array,$user_info['user_id']);
          }
        }
        if(!empty($moderators_UserID_array)){
          return array(true,$moderators_UserID_array);
        }else{
          return array(false,'error 52');
        }
      }else{
        return array(false,'error 51');
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 50');
    }
  }

  public function sub_speaker_invite_checker($token_array, $token_count, $channel){
    try {
      $counter = 0;
      foreach ($token_array as &$token) {
        $counter = $counter + 1;
        if ($counter <= $token_count){
          list($res_flg,$moderators_UserID_array)=$this->sub_get_moderator_ids($token,$channel);
          if($res_flg){
            foreach ($moderators_UserID_array as &$user_id) {
                list($res_speaker_invite_flg,$res_speaker_invite)=$this->accept_speaker_invite($token,$channel,$user_id);
            }
          }
        }
      }
      return array(true,'');
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 60');
    }
  }

  public function sub_leave_channel($token,$channel){
    try {
      list($res_flg,$res_msg)=$this->leave_channel($token,$channel);
      if($res_flg){
        return array(true,'');
      }else{
        return array(false,'error 51');
      }
    } catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
      return array(false,'error 60');
    }
  }
}
