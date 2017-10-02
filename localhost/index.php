<?php 
class bd{
	public $mysqli;

    public function connect(){//Функция подключения ,при вызове передаём настройки с данными от бд
        $this->mysqli = new mysqli('localhost','root','230115coder','admin_ctrl');//подключение к бд
        $this->mysqli->set_charset("utf8");//установка кодировки
    }
	public function q($data){
		return $this->mysqli->query($data);	
	}
	public function q1($data){
		$result=$this->q($data);
		$row=$result->fetch_assoc();
		return $row;
	}
	public function q8($data){
		$result=$this->q($data);
		$arr=array();
		while($arr[]=$result->fetch_assoc()){
		}
		return $arr;
}
}
$bd = new bd;
$bd->connect();
if(!isset($_REQUEST['act'])){?><form>
Проект: <input type=radio name=act value="project"/>
Спонсор: <input type=radio name=act value="user"/>
<input type=submit name=sub/>
</form> <?php }else{
	if(!isset($_REQUEST['send'])){
	switch($_REQUEST['act']){
		case 'project':
		?>
		<form>
		<input type=hidden name=act value=<?php echo $_REQUEST['act'];?> />
		<input type=hidden name=send /> 
		Автор:<input type=text name=name_a />
		Проект<input type=text name=name_p />
		Шагов<input type=text name=steps />
		<input type=submit />
		</form>
		<?php
		break;
		case 'user':
		?>
		<form>
		<input type=hidden name=act value=<?php echo $_REQUEST['act'];?> />
		<input type=hidden name=send /> 
		Имя:<input type=text name=name_a />
		address<input type=text name=address />
		<input type=submit />
		</form>
		<?php
		break;
		
	}}else{
		switch($_REQUEST['act']){
			case 'project':
			break;
			case 'user':
			break;
		}
	}
	
}?>
<?php
$res=$bd->q8('select * from projects');
foreach($res as $k=>$v){
	echo $v['proj_name']."\n";
}
?>




<?php


$url = "http://52.30.47.67:6869/addresses/";
$ch = curl_init($url);                                                                     
   curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                     
   // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                                                                      
 
    $result = curl_exec($ch);
	print_r($result);
    $data=json_decode($result);
	echo "balance ".$data->balance/100000000;
?>