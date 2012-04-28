<?php 
class Member extends AppModel
{
  var $name = 'Member';
  var $userTable = 'members';

  //うまい具合にメンバの登録・更新ができる関数

  public function update($member_data)
  {
    $member = $this->find('first', array('conditions' => array('user_id' => $member_data['user_id'])));
    if($member) {
      $member_data['id'] = $member['Member']['id'];
    }
    $this->create();
    $this->save(Array("Member" => $member_data));
  }
}
?>
