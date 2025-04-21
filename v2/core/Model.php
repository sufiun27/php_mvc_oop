<?php

trait Model {
    use Database;

    protected $limit 		= 10;
	protected $offset 		= 0;
	protected $order_type 	= "desc";
	protected $order_column = "id";
	public $errors 		= [];



    public function whoami(){
        echo "i am main Model name space: core/Model";
    }

    public function insert($data)
	{
		
		/** remove unwanted data **/
		if(!empty($this->allowedColumns))
		{
			foreach ($data as $key => $value) {
				
				if(!in_array($key, $this->allowedColumns))
				{
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);

		$query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).")";
		$this->query($query, $data);

		return false;
	}

	public function first($data, $data_not = [])
	{
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			$query .= $key . " = :". $key . " && ";
		}

		foreach ($keys_not as $key) {
			$query .= $key . " != :". $key . " && ";
		}
		
		$query = trim($query," && ");

		$query .= " limit $this->limit offset $this->offset";
		$data = array_merge($data, $data_not);
		
		$result = $this->query($query, $data);
		if($result)
			return $result[0];

		return false;
	}
}