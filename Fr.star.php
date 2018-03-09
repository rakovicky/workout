<?php
namespace Fr;
ini_set("display_errors", "on");

class Star {

 
  public $default_config = array(

      "db" => array(
      "host" => "localhost",
      "username" => "skstreet-worko81",
      "password" => "123456",
      "name" => "skstreet-workout",
      "table" => "fr_star"
    )
  );
  
  
  public $config = array();
  
  public static function log($msg = ""){
    $log_file = __DIR__ . "/Francium.log";
    if(file_exists($log_file)){
      if($msg != ""){
        $message = "[" . date("Y-m-d H:i:s") . "] $msg";
        $fh = fopen($log_file, 'a');
        fwrite($fh, $message . "\n");
        fclose($fh);
      }
    }
  }
  
  public $id = null;
  
  public function __construct($config, $id = null){
    $this->config = array_merge($this->default_config, $config);
    
    try {
      $this->dbh = new \PDO("mysql:dbname=". $this->config['db']['name'] .";host=". $this->config['db']['host'] .";port=". $this->config['db']['port'], $this->config['db']['username'], $this->config['db']['password']);
      
      $this->id = $id;
      
    }catch(\PDOException $e) {
      /**
       * Couldn't connect to Database
       */
      self::log('Couldn\'t connect to database. Check \Fr\LS::$config["db"] credentials');
      return false;
    }
  }
  
  /**
   * Set a rate
   */
  public function addRating($user_id, $rating, $a_id){
    if($rating <= 5.0){
      $sql = $this->dbh->prepare("SELECT COUNT(1) FROM `{$this->config['db']['table']}` WHERE `user_id` = ? AND `rate_id` = ? AND article_id = ?");
      $sql->execute(array($user_id, $this->id, $a_id));

      if($sql->fetchColumn() == "0"){
        $sql = $this->dbh->prepare("INSERT INTO `{$this->config['db']['table']}` (`rate_id`, `user_id`, `rate`, `article_id`) VALUES(?, ?, ?, ?)");
        return $sql->execute(array($this->id, $user_id, $rating, $a_id));
      }else{
        $sql = $this->dbh->prepare("UPDATE `{$this->config['db']['table']}` SET `rate` = ? WHERE `user_id` = ? AND `rate_id` = ? AND article_id = ?");
        return $sql->execute(array($rating, $user_id, $this->id, $a_id));
      }
    }
  }
  
  public function getRating($html_class = "", $type = "html", $a_id){
    $sql = $this->dbh->prepare("SELECT * FROM `{$this->config['db']['table']}` WHERE `rate_id` = ? AND article_id = ?");
    $sql->execute(array($this->id, $a_id));
    $results = $sql->fetchAll(\PDO::FETCH_ASSOC);
    
    if(count($results) == 0){
      $rate_times = 0;
      $rate_value = 0;
      $rate_bg = 0;
    }else{
      foreach($results as $result){
        $rate_db[] = $result;
        $sum_rates[] = $result['rate'];
      }
      $rate_times = count($rate_db);
      $sum_rates = array_sum($sum_rates);
      $rate_value = $sum_rates/$rate_times;
      $rate_bg = (($rate_value)/5)*100;
    }
    
    if($type == "html"){
      $html = '<div class="Fr-star '. $html_class .'" data-id="' . $a_id . '" data-title="'. round($rate_value, 2) .' / 5 by '. $rate_times .' ratings" data-rating="'. $rate_value .'">';
        $html .= '<div class="Fr-star-value" style="width: '. $rate_bg .'%"></div>';
        $html .= '<div class="Fr-star-bg"></div>';
      $html .= '</div>';
      
      return $html;
    }else if($type == "rate_value"){
      return $rate_value;
    }else if($type == "rate_percentage"){
      return $rate_bg;
    }else if($type == "rate_times"){
      return $rate_times;
    }
  }
  
  public function userRating($user_id, $a_id){
    $sql = $this->dbh->prepare("SELECT `rate` FROM `{$this->config['db']['table']}` WHERE `user_id` = ? AND article_id = ?");
    $sql->execute(array($user_id, $a_id));
    return $sql->fetchColumn();
  }

  public function getRatingSum($a_id) {
    $sql = $this->dbh->prepare("SELECT `rate` FROM `{$this->config['db']['table']}` WHERE `article_id` = ?");
    $sql->execute(array($a_id));


    $ratings = $sql->fetchAll();
    $sum = 0;

    foreach($ratings as $rating) {
      $sum += $rating['rate'];
    }

    $count = $sql->rowCount();

    return round(($sum / $count), 2);
  }
}
