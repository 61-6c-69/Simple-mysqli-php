<?php
class DBM{
	public $CON;
	public $RESULT;
	public $FETCH_ARRAY_TMP;
	public $W_FETCH_ARRAY_TMP;
	
	public function __construct(){
		$this->CON=new mysqli(HOST,USER,PASS,DB);
		if(!$this->CON)
			die("\n error connect db");
	}
		//@ select db
	public function QUERY($qr,$params){
		$pre=$this->CON->prepare($qr);
		$tmp = array();
		if(count($params)>1){
			foreach($params as $key => $value) $tmp[$key] = &$params[$key];
			call_user_func_array(array($pre,'bind_param'),$tmp);
		}
		$pre->execute();
		echo $pre->error;
		$this->RESULT=$pre->get_result();
	}
	// @ num rows
	public function NUM_ROWS(){
		if($this->RESULT==null)
			return null;
		return $this->RESULT->num_rows;
	}
	// @ last insert id
	public function LAST_INSERT_ID(){
		if(!$this->CON)
			return null;
		return $this->CON->insert_id;
	}
	// @ fetch array
	public function FETCH_ARRAY(){
		if($this->RESULT==null)
			return null;
		if($this->FETCH_ARRAY_TMP!=null)
			return $this->FETCH_ARRAY_TMP;
		$this->FETCH_ARRAY_TMP=$this->RESULT->fetch_array();
		return $this->FETCH_ARRAY_TMP;
	}
	public function CLEAN_FETCH_ARRAY(){
		$this->FETCH_ARRAY_TMP=null;
	}
	// @ get value from name
	public function VALUE_FROM_NAME($name){
		$fet=$this->FETCH_ARRAY();
		if(isset($fet[$name]))
			return $fet[$name];
		else
			return null;
	}
	// @ get fetch array while
	public function W_FETCH_ARRAY($array_names){
		if($this->RESULT==null)
			return null;
		$w=array();
		while($wr=$this->RESULT->fetch_array()){
			$w_tmp=array();
			for($i=0;$i<=count($array_names)-1;$i++){
				$w_tmp[$array_names[$i]]=$wr[$array_names[$i]];
			}
			array_push($w,$w_tmp);
		}
		if($this->W_FETCH_ARRAY_TMP!=null)
			return $this->W_FETCH_ARRAY_TMP;
		return $w;
	}
}
?>
