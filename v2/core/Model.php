<?php

trait Model {
    use Database;

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
}