<?php 
  App::import('hogehoge', 'oauth', array('file' => 'OAuth/oauth_consumer.php'));
  class MemberController extends AppController
  {
    public
    $name = 'Member',
    $components = array('Auth');

    function beforeFilter()
    {
      $this->Auth->userModel = 'Member';
      $this->Auth->allow('index', 'login', 'twitter', 'twitter_callback');
      $this->Auth->fields = array('username' => 'access_token_key', 'password' => 'access_token_secret');
      $this->Auth->loginAction = '/member/';

      parent::beforeFilter();
    }

    public function index()
    {
      $auth = $this->Session->read('Auth');
      if(isset($auth['Member']['user_id'])) {
        $this->set('title_for_layout', $auth['Member']['user_name'] . 'さんのマイページ');
      } else {
        $this->set('title_for_layout', 'ゲストさんのマイページ');
        $this->render('guest_index');
      }
    }

    public function login()
    {
      $auth = $this->Session->read('Auth');
      if($auth['Member']['user_id']){
        $this->redirect('/member/');
      } else {
        $this->redirect('/member/twitter');
      }
    }

    public function logout()
    {
      $auth = $this->Session->read('Auth');
      if($auth['Member']['user_id']) {
        $this->Auth->logout();
        $this->redirect('/member/');
      }else{
        $this->redirect('/member/');
      }
    }

    public function twitter()
    {
      $consumer = $this->createConsumer();
      $requestToken = $consumer->getRequestToken('https://twitter.com/oauth/request_token','http://caloren.com/member/twitter_callback');//怪しい
      $this->Session->write('twitter_request_token',$requestToken);
      $this->redirect('https://twitter.com/oauth/authorize?oauth_token='.$requestToken->key);
    }  

    public function twitter_callback()
    {
      $consumer = $this->createConsumer();
      $requestToken = $this->Session->read('twitter_request_token');
      $accessToken = $consumer->getAccessToken('https://twitter.com/oauth/access_token', $requestToken);
      if($accessToken != ''){
        //Twitter からユーザーデータを取得
        $json = $consumer->get($accessToken->key, $accessToken->secret, 'http://twitter.com/account/verify_credentials.json',array());
        $twitterData = jason_decode($json, true);

        $consumer->post($accessToken->key, $accessToken->secret, 'http://twitter.com/statuses/update.json',array('status' => '接続しました'));

        $this->Member->update(
          Array(
            "user_id" => $twitterData['id_str'],
            "user_name" => $twitterData['screen_name'],
            "access_token_key" => $accessToken->key,
            "access_token_secret" => $accessToken->secret,
          )
        );

        $user['Member']["access_token_key"] = $accessToken->key;
        $user['Member']["access_token_secret"] = $accessToken->secret;

        if($this->Auth->login($user)){
          $this->Session->write('caloren_request_token', $this->getRequestToken());//怪しい
          $this->redirect('/member/');
        }
        $this->render('index');
      }else{
        $this->cakeError('error404');
      }
    }

    private function getRequestToken()
    {
      $auth = $this->Session->read('Auth');
      $token = md5($auth['Member']['created']. $auth['Member']['id'] . 'SixjDklLT5mRuDEgRZPGQxYxpy9kC7iI'); //怪しい
      return $token;
    }

    private function requestAuth()
    {
      $auth = $this->Session->read('Auth');
      $tokenAuth = $this->Session->read('caloren_request_token'); //怪しい
      $tokenTemp = $this->getRequestToken();
      if($tokenAuth == $tokenTemp){
        return true;
      } else {
        return false;
      }
    }

    private function createConsumer()
    {
      App::import('Vendor', 'oauth', array('file' => 'OAuth/oauth_consumer.php'));
      return new OAuth_Consumer('5NQodaEga8MThaZs2xr2g','GXQiryxprtOXq7QQEQwDp45uhTMyZeCuCPl4c82g838');
    }

  }
?>
