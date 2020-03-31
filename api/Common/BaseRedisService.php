<?php


class BaseRedisService
{
    var $redis;

    var $prefix;
    var $auto_id_db;  //hash数据 存储 user_id  room_id  gift_id
 
    
    var $video_db; //:video_id  hash数据
    var $video_group_db; // hMSet 有 group:id:video_id
    
    
    var $user_db; //:user_id  hash数据
    var $user_hash_db; //所有会员数据 user_id hash数据 存储在线数据
    var $user_robot_db; //user_id  set数据 ,机器人的集合
    
    var $video_viewer_level_db;//:video_id  zset 房间观众列表,user_id:会员级别

    //======观众权重=========
    var $gz_level_weight = 1000; //等级权重
    var $gz_rz_weight = 500; //认证权重
    var $gz_real_weight = 2000000;//真人权重

    //  private $id;
    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function __construct()
    {
        if(isset($GLOBALS['redisdb'])){

            $this->redis = $GLOBALS['redisdb'];

        }else{
            $this->redis = new Rediscache($GLOBALS['distribution_cfg']['RDB_CLIENT'], $GLOBALS['distribution_cfg']['RDB_PORT'],$GLOBALS['distribution_cfg']['RDB_PASSWORD']);
        }

        $this->prefix = $GLOBALS['distribution_cfg']['REDIS_PREFIX'];
        $this->auto_id_db = $this->prefix.'auto_id_db';
  
        $this->user_db = $this->prefix.'user:';
        $this->user_hash_db = $this->prefix.'user_hash_db';
        $this->user_robot_db = $this->prefix.'user_robot';
        
        
        $this->video_db = $this->prefix.'video:';
        
        $this->video_viewer_level_db = $this->prefix.'video_viewer_level:';
        $this->video_group_db = $this->prefix.'video_group_db';
        
    }
    //获取最新的user_id
    public function get_user_id(){
        return $this->redis->hIncrBy($this->auto_id_db,'user_id',1);
    }
    //设置最新的user_id
    public function set_user_id($user_id){
        return $this->redis->hSet($this->auto_id_db,'user_id',$user_id);
    }
    //获取最新的video_id
    public function get_video_id(){
        return $this->redis->hIncrBy($this->auto_id_db,'video_id',1);
    }
    //设置最新的video_id
    public function set_video_id($video_id){
        return $this->redis->hSet($this->auto_id_db,'video_id',$video_id);
    }
    //获取最新的gift_id
    public function get_gift_id(){
    	return $this->redis->hIncrBy($this->auto_id_db,'gift_id',1);
        //return $this->redis->hGet($this->auto_id_db,'gift_id');
    }
    //设置最新的gift_id
    public function set_gift_id($gift_id){
        return $this->redis->hSet($this->auto_id_db,'gift_id',$gift_id);
    }
    //获取 auto_id_db hash 中　key的值
    public function get_auto_val($key){
        return $this->redis->hIncrBy($this->auto_id_db,$key,1);
    }
    //设置 auto_id_db hash 中　key的值
    public function set_auto_val($key,$val){
        return $this->redis->hSet($this->auto_id_db,$key,$val);
    }
    /*
     * 增加
     */
    public function insert($key,$data){
        filter_null($data);
        return $this->redis->hMSet($this->prefix.$key,$data);
    }
    /*
     *
     */
    public function delete($key){
        $this->redis->delete($this->prefix.$key);
    }

    /*
    * 更新
    */
    public function update($key,$data){
        filter_null($data);
        return $this->redis->hMSet($this->prefix.$key,$data);
    }
    /*
    *
    */
    public function incry($db,$key,$val){
        return $this->redis->hIncrBy($this->prefix.$db,$key,$val);
    }

    /*
     * 获取单个
     */
    public function getOne($key,$field){
        return $this->redis->hGet($this->prefix.$key,$field);
    }
    /*
     * 获取行
     */
    public function getRow($key,$fields=''){
        if(!$fields){
            return $this->redis->hGetAll($this->prefix.$key);
        }else{
            return $this->redis->hMGet($this->prefix.$key,$fields);
        }

    }

    public function set_lock($key,$value,$exp=10){
        $re = $this->redis->set_lock($key,$value,$exp);
        return $re;
    }

    public function keys_searche($search_name){
        return $this->redis->keys_searche($this->prefix,$search_name);
    }

    public function get_video_watch_num($vedio_id){
        $video_data = $this->redis->hMGet($this->video_db.$vedio_id,array('virtual_watch_number','robot_num','watch_number')) ;
        $virtual_watch_number = $video_data['virtual_watch_number'];
        $robot_num = $video_data['robot_num'];
        $watch_num = $video_data['watch_number'];
        $num  = $virtual_watch_number + $watch_num + $robot_num;
        return $num;
    }

   
    
}//类定义结束

?>