<?php
/**
 * This is a Redis exntend class
 */

class Rediscache
{
	public static $instance = NULL;
	public static $linkHandle = array();

	var $redis;
	var $is_long_link=true;
	var $is_redis_work=false;


	//construct:connect redis
	public function __construct($host,$port,$auth)
	{


		$this->initRedis($host,$port,$auth);
	}

	/**
	 * Get a instance of MyRedisClient
	 *
	 * @param string $key
	 * @return object
	 */
    static function getInstance($configs)
    {
		if (!self::$instance) {
			self::$instance = new self($configs);
		}
		return self::$instance;
    }
    


	/**
	 * 初始化Redis
	 * $host,$port,$auth
	 */
	private function initRedis($host,$port,$auth=''){
		$obj = new Redis();
		//$db = intval($GLOBALS['distribution_cfg']['REDIS_PREFIX_DB']);
		if($this->is_long_link){
			$connect = $obj->pconnect($host,$port);
			if($connect){
				if($auth){
					$obj->auth($auth);
				}
				$this->redis = $obj;
			}else{
				exit("redis connect fail:".$connect);
			}
		}else{
			$connect = $obj->connect($host,$port);
			if($connect){
				if($auth){
					$obj->auth($auth);
				}
				$this->redis = $obj;
			}else{
				exit("redis connect fail:".$connect);
			}
		}
		/* if($db>0){
			$this->redis->select($db);
		} */

	}
    


	/**
	 * 获得redis Resources
	 *
	 * @param $key	 redis存的key/或随机值
	 * @param string $tag	master/slave
	 */
	public function getRedis(){
		return $this->redis;
	}
    

	
	/**
	 * 关闭连接
	 * pconnect 连接是无法关闭的
	 *  
	 *
	 * @return boolean
	 */
	public function close(){

		$this->redis->close();

		return true;
	}
	

	/**
	 * redis 字符串（String） 类型
	 * 将key和value对应。如果key已经存在了，它会被覆盖，而不管它是什么类型。
	 * @param $key
	 * @param $value
	 * @param $exp 过期时间
	 */
	public function set($key,$value,$exp=0){
		$redis = $this->redis;
		$redis->set($key,$value);
		!empty($exp) && $redis->expire($key,$exp);
	}

	public function set_lock($key,$value,$exp=10){
		return $this->redis->set($key,$value,array('nx', 'ex' => $exp));
	}
	/**
	 * redis 字符串（String） 类型
	 * 返回key的value。如果key不存在，返回特殊值nil。如果key的value不是string，就返回错误，因为GET只处理string类型的values。
	 * @param $key
	 */
	public function get($key){

		return $this->redis->get($key);
	}
	/**
	 * redis 字符串（String） 类型
	 * KEYS pattern
	 * 查找所有匹配给定的模式的键
	 * @param $is_key   默认是一个非正则表达试，使用模糊查询
	 * @param $key
	 */
	public function keys($key,$is_key=true){
		
		if ($is_key) {
			return $this->redis->keys("*$key*");
		}
		return $this->redis->keys("$key");
	}

	public function keys_searche($prefix,$search_name){
		return $this->redis->keys("$prefix*$search_name*");
	}
	/**
	 * 删除一个或多个key
	 * @param $keys  数组/ 数组以逗号拼接的string
	 */
	public function delete($keys){
		$this->redis->delete($keys);
	}
	/**
	 * redis 哈希表(hash)类型
	 * 返回哈希表 $key 中，所有的域和值。
	 * @param $key
	 *
	 */
	public function hGetAll($key){
		
		return $this->redis->hGetAll($key);
	}

	/**
	 * redis 哈希表(hash)类型
	 * 批量填充HASH表。不是字符串类型的VALUE，自动转换成字符串类型。使用标准的值。NULL值将被储存为一个空的字符串。
	 * 
	 * 可以批量添加更新 value,key 不存在将创建，存在则更新值
	 * 
	 * @param  $key
	 * @param  $fieldArr
	 * @return
	 * 如果命令执行成功，返回OK。
	 * 当key不是哈希表(hash)类型时，返回一个错误。
	 */
	public function hMSet($key,$fieldArr){
		
		return $this->redis->hmset($key,$fieldArr);
	}
	/**
	 * Gets a value from the hash stored at key.
	 * If the hash table doesn't exist, or the key doesn't exist, FALSE is returned.
	 *
	 * @param   string  $key
	 * @param   string  $hashKey
	 * @return  string  The value, if the command executed successfully BOOL FALSE in case of failure
	 * @link    http://redis.io/commands/hget
	 */
	public function hGet($key, $hashKey) {
		return $this->redis->hGet($key,$hashKey);
	}
	/**
	 * Adds a value to the hash stored at key. If this value is already in the hash, FALSE is returned.
	 *
	 * @param string $key
	 * @param string $hashKey
	 * @param string $value
	 * @return int
	 * 1 if value didn't exist and was added successfully,
	 * 0 if the value was already present and was replaced, FALSE if there was an error.
	 * @link    http://redis.io/commands/hset
	 * @example
	 * <pre>
	 * $redis->delete('h')
	 * $redis->hSet('h', 'key1', 'hello');  // 1, 'key1' => 'hello' in the hash at "h"
	 * $redis->hGet('h', 'key1');           // returns "hello"
	 *
	 * $redis->hSet('h', 'key1', 'plop');   // 0, value was replaced.
	 * $redis->hGet('h', 'key1');           // returns "plop"
	 * </pre>
	 */
	public function hSet( $key, $hashKey, $value ) {
		return $this->redis->hSet($key, $hashKey, $value);
	}

	public function hMGet( $key, $hashKeys ) {
		return $this->redis->hMGet($key,$hashKeys);
	}

	public function hIncrBy( $key, $hashKey, $value){
		return $this->redis->hIncrBy( $key, $hashKey, $value);
	}
	/**
	 * redis 哈希表(hash)类型
	 * 向已存在于redis里的Hash 添加多个新的字段及值
	 * 
	 * @param  $key			redis 已存在的key
	 * @param  $field_arr	kv形数组
	 */
	public function hAddFieldArr($key,$field_arr){
		foreach ($field_arr as $k=>$v){

			$this->hAddFieldOne($key, $k, $v);
		}
	}
	
	/**
	 * 向已存在于redis里的Hash 添加一个新的字段及值
	 * @param  $key
	 * @param  $field_name
	 * @param  $field_value
	 * @return bool
	 */
	public function hAddFieldOne($key,$field_name,$field_value){
		
		return $this->redis->hsetnx($key,$field_name,$field_value);
	}
	
	/**
	 * 向Hash里添加多个新的字段或修改一个已存在字段的值
	 * @param $key
	 * @param $field_arr
	 */
	public function hAddOrUpValueArr($key,$field_arr){
		foreach ($field_arr as $k=>$v){
			$this->hAddOrUpValueOne($key, $k, $v);
		}
	}
	/**
	 * 向Hash里添加多个新的字段或修改一个已存在字段的值
	 * @param  $key
	 * @param  $field_name
	 * @param  $field_value
	 * @return boolean 
	 * 1 if value didn't exist and was added successfully, 
	 * 0 if the value was already present and was replaced, FALSE if there was an error.
	 */
	public function hAddOrUpValueOne($key,$field_name,$field_value){
		
		return $this->redis->hset($key,$field_name,$field_value);
	}
	
	/**
	 *  删除哈希表key中的多个指定域，不存在的域将被忽略。
	 * @param $key
	 * @param $field_arr
	 */
	public function hDel($key,$field_arr){
//		foreach ($field_arr as $var){
//			$this->hDelOne($key,$var);
//		}
		$keys = array();
		if(is_array($field_arr)){
			array_unshift($field_arr,$key);
			$keys = $field_arr;
		}else{
			$keys = array($key,$field_arr);
		}
		return call_user_func_array(array($this->redis, "hDel"),$keys);
	}
	
	/**
	 * 删除哈希表key中的一个指定域，不存在的域将被忽略。
	 * 
	 * @param $key
	 * @param $field
	 * @return BOOL TRUE in case of success, FALSE in case of failure
	 */
	public function hDelOne($key,$field){
		
		return $this->redis->hdel($key,$field);
	}
	
	/**
	 * 重命名key
	 * 
	 * @param $oldkey
	 * @param $newkey
	 */
	public function renameKey($oldkey,$newkey){

		return $this->redis->rename($oldkey,$newkey);
	}
	
	/**
	 * 删除一个或多个key
	 * @param $keys
	 */
//	public function delKey($keys){
//		if(is_array($keys)){
//			foreach ($keys as $key){
//				$this->redis->del($key);
//			}
//		}else {
//			$this->redis->del($keys);
//		}
//	}
	/**
	 * 添加一个字符串值到LIST容器的顶部（左侧），如果KEY不存在，曾创建一个LIST容器，如果KEY存在并且不是一个LIST容器，那么返回FLASE。
	 * 
	 * @param unknown $key
	 * @param unknown $val
	 */
	public function lPush($key,$val){


	 return	$this->redis->lPush($key,$val);
	}

	public function rPush($key,$field_arr){
	//	$keys =array($key,$vals);
		if(is_array($field_arr)){
			array_unshift($field_arr,$key);
			$keys = $field_arr;
		}else{
			$keys = array($key,$field_arr);
		}
	//	return	$this->redis->rPush($key,$val);
		return call_user_func_array(array($this->redis, "rPush"), $keys);
	}
	/**
	 * 返回LIST顶部（左侧）的VALUE，并且从LIST中把该VALUE弹出。
	 * @param unknown $key
	 */
	public function lPop($key){
		
		return $this->redis->lPop($key);
	}

	public function lGetRange($key,$start,$end){
	 return	$this->redis->lGetRange($key,$start,$end);
	}
	public function lRange($key,$start,$end){
		return	$this->redis->lRange($key,$start,$end);
	}

	/**
	 * 批量的添加多个key 到redis
	 * @param $fieldArr
	 */
//	public function mSetnx($fieldArr){
//
//		$this->redis->mSetnx($fieldArr);
//	}
	/*
	 * 检查给定 key 是否存在。
	 * 若 key 存在，返回 1 ，否则返回 0 。
	 */
	public function exists($key){
		
		return $this->redis->exists($key);
	}

	/*
	 *将 key 中储存的数字值增一。
	 *如果 key 不存在，那么 key 的值会先被初始化为 0 ，然后再执行 INCR 操作。
	 */
	public function incr($key){
		
		$this->redis->incr($key);
	}

	/*
	 *  取得所有指定键的值。如果一个或多个键不存在，该数组中该键的值为假
	 *  @param $keys
	 *  返回值：返回包含所有键的值的数组
	 */
	public function getMultiple($keys){
		if(is_array($keys)){
			$keys_array = array();
			foreach($keys as  $key){
				$keys_array[] = $key;
			}
			return	$this->redis->getMultiple($keys_array);
		}else{
			return false;
		}
	}
	//====Set  有序集合=====
	public function sAdd($key,$value1){

		return $this->redis->sAdd($key,$value1);
	}

	public function srem($key,$value1){

		return $this->redis->srem($key,$value1);
	}

	public function sMembers($key){

		return $this->redis->sMembers($key);
	}

	public function sismember($key,$value){
		return $this->redis->sIsMember($key,$value);
	}

	public function  sCard($key){
		return $this->redis->sCard($key);
	}
	//回一个所有指定键的交集。如果只指定一个键，那么这个命令生成这个集合的成员。如果不存在某个键，则返回FALSE。
	public function sinter( $keys){
		return call_user_func_array(array($this->redis, "sinter"), $keys);
	}

	//====SortedSet  有序集合=====

	/*
     * 构建一个集合(有序集合)
     * @param string $key 集合名称
     * @param  string $value1  值
	 * @param  int $score1  值
	 * return 被成功添加的新成员的数量，不包括那些被更新的、已经存在的成员。
     */
	public function zAdd($key,$score1,$value1){
		return $this->redis->zAdd($key,$score1,$value1);
	}

	public function zMAdd($key,$data){
		$array = array();
		$array[] = $key;
		foreach($data as $k => $v) {
			$array[] = $v;
			$array[] = $k;
		}
		$keys = array_values($array);
		return call_user_func_array(array($this->redis, 'zAdd'), $keys);
	}
	/**
	 * Returns the score of a given member in the specified sorted set.
	 *
	 * @param   string  $key
	 * @param   string  $member
	 * @return  float
	 * @link    http://redis.io/commands/zscore
	 * @example
	 * <pre>
	 * $redis->zAdd('key', 2.5, 'val2');
	 * $redis->zScore('key', 'val2'); // 2.5
	 * </pre>
	 * 查找 key中member的值
	 */
	public function zScore( $key, $member ) {
		return $this->redis->zScore( $key, $member );
	}


	/**
	 * Returns the cardinality of an ordered set.
	 *
	 * @param   string  $key
	 * @return  int     the set's cardinality
	 * @example
	 * <pre>
	 * $redis->zAdd('key', 0, 'val0');
	 * $redis->zAdd('key', 2, 'val2');
	 * $redis->zAdd('key', 10, 'val10');
	 * $redis->zCard('key');            // 3
	 * </pre>
	 */
	public function zCard($key){
		
		return $this->redis->zCard($key);
	}
	/**
	 * Returns the number of elements of the sorted set stored at the specified key which have
	 * scores in the range [start,end]. Adding a parenthesis before start or end excludes it
	 * from the range. +inf and -inf are also valid limits.
	 *
	 * @param   string  $key
	 * @param   string  $start
	 * @param   string  $end
	 * @return  int     the size of a corresponding zRangeByScore.
	 * @link    http://redis.io/commands/zcount
	 * @example
	 * <pre>
	 * $redis->zAdd('key', 0, 'val0');
	 * $redis->zAdd('key', 2, 'val2');
	 * $redis->zAdd('key', 10, 'val10');
	 * $redis->zCount('key', 0, 3); // 2, corresponding to array('val0', 'val2')
	 * </pre>
	 * score 值在 min 和 max 之间的成员的数量。
	 */
	public function zCount( $key, $start, $end ) {
		
		return $this->redis->zCount($key, $start, $end);
	}

	/**
	 * Increments the score of a member from a sorted set by a given amount.
	 *
	 * @param   string  $key
	 * @param   float   $value (double) value that will be added to the member's score
	 * @param   string  $member
	 * @return  float   the new value
	 * @example
	 * <pre>
	 * $redis->delete('key');
	 * $redis->zIncrBy('key', 2.5, 'member1');  // key or member1 didn't exist, so member1's score is to 0
	 *                                          // before the increment and now has the value 2.5
	 * $redis->zIncrBy('key', 1, 'member1');    // 3.5
	 * </pre>
	 * member 成员的新 score 值，以字符串形式表示。
	 */
	public function zIncrBy( $key, $value, $member ) {
		
		return $this->redis->zIncrBy( $key, $value, $member );
	}

	/**
	 * Returns a range of elements from the ordered set stored at the specified key,
	 * with values in the range [start, end]. start and stop are interpreted as zero-based indices:
	 * 0 the first element,
	 * 1 the second ...
	 * -1 the last element,
	 * -2 the penultimate ...
	 *
	 * @param   string  $key
	 * @param   int     $start
	 * @param   int     $end
	 * @param   bool    $withscores
	 * @return  array   Array containing the values in specified range.
	 * @link    http://redis.io/commands/zrange
	 * @example
	 * <pre>
	 * $redis->zAdd('key1', 0, 'val0');
	 * $redis->zAdd('key1', 2, 'val2');
	 * $redis->zAdd('key1', 10, 'val10');
	 * $redis->zRange('key1', 0, -1); // array('val0', 'val2', 'val10')
	 * // with scores
	 * $redis->zRange('key1', 0, -1, true); // array('val0' => 0, 'val2' => 2, 'val10' => 10)
	 * </pre>
	 * 指定区间内，带有 score 值(可选)的有序集成员的列表。
	 */
	public function zRange( $key, $start, $end, $withscores = null ) {
		
		return $this->redis->zRange( $key, $start, $end, $withscores) ;
	}
	public function zRevRange( $key, $start, $end, $withscores = null ) {

		return $this->redis->zRevRange( $key, $start, $end, $withscores) ;
	}

	/**
	 * Deletes a specified member from the ordered set.
	 *
	 * @param   string  $key
	 * @param   string  $member1
	 * @param   string  $member2
	 * @param   string  $memberN
	 * @return  int     Number of deleted values
	 * @link    http://redis.io/commands/zrem
	 * @example
	 * <pre>
	 * $redis->zAdd('z', 1, 'v1', 2, 'v2', 3, 'v3', 4, 'v4' );  // int(2)
	 * $redis->zRem('z', 'v2', 'v3');                           // int(2)
	 * var_dump( $redis->zRange('z', 0, -1) );
	 * //// Output:
	 * // array(2) {
	 * //   [0]=> string(2) "v1"
	 * //   [1]=> string(2) "v4"
	 * // }
	 * </pre>
	 * 返回值:被成功移除的成员的数量，不包括被忽略的成员。
	 */
	public function zRem( $key, $member1 ) {
		
		return $this->redis->zRem( $key, $member1 );
	}
	//并集
	public function zUnionStore($new_key,$keys,$withscore=true,$AGGREGATE = 'min'){
		return $this->redis->zUnionStore($new_key,$keys,$withscore,$AGGREGATE);
	}
	//交集 保存到 destination 的结果集的基数。
	public function  zInterStore($new_key,$keys,$withscore = null,$AGGREGATE = 'max'){
		return $this->redis->zInterStore($new_key,$keys,$withscore,$AGGREGATE);
	}

	/**
	 * Returns the elements of the sorted set stored at the specified key which have scores in the
	 * range [start,end]. Adding a parenthesis before start or end excludes it from the range.
	 * +inf and -inf are also valid limits.
	 *
	 * zRevRangeByScore returns the same items in reverse order, when the start and end parameters are swapped.
	 *
	 * @param   string  $key
	 * @param   int     $start
	 * @param   int     $end
	 * @param   array   $options Two options are available:
	 *                      - withscores => TRUE,
	 *                      - and limit => array($offset, $count)
	 * @return  array   Array containing the values in specified range.
	 * @link    http://redis.io/commands/zrangebyscore
	 * @example
	 * <pre>
	 * $redis->zAdd('key', 0, 'val0');
	 * $redis->zAdd('key', 2, 'val2');
	 * $redis->zAdd('key', 10, 'val10');
	 * $redis->zRangeByScore('key', 0, 3);                                          // array('val0', 'val2')
	 * $redis->zRangeByScore('key', 0, 3, array('withscores' => TRUE);              // array('val0' => 0, 'val2' => 2)
	 * $redis->zRangeByScore('key', 0, 3, array('limit' => array(1, 1));                        // array('val2' => 2)
	 * $redis->zRangeByScore('key', 0, 3, array('limit' => array(1, 1));                        // array('val2')
	 * $redis->zRangeByScore('key', 0, 3, array('withscores' => TRUE, 'limit' => array(1, 1));  // array('val2' => 2)
	 * </pre>
	 */
	public function zRangeByScore( $key, $start, $end,  $options = array() ) {
		return $this->redis->zRangeByScore($key, $start, $end,$options);
	}

	public function srandmember($key,$num){
		return $this->redis->srandmember($key,$num);
	}

	public function multi($mode=Redis::MULTI) {
		if($this->is_redis_work) {
			return $this->redis->multi($mode);
		}else{
			return $this->redis;
		}
	}

	public function exec( ) {
		if($this->is_redis_work){
			$this->redis->exec();
		}else{
			return false;
		}

	}

	public function discard( ) {
		$this->redis->discard();
	}
	public function watch($key ) {
		
		$this->redis->watch($key);
	}



}
?>
