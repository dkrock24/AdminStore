<?php
/***************************************************************************
*
Transactel
- Powered by Telus -
*
***************************************************************************/
class MySQLException extends Exception {}
bx_import('BxDolModuleDb');

class TrlGlobalreportDb extends BxDolModuleDb {
    var $_oConfig;

    function TrlGlobalreportDb(&$oConfig) {
        parent::BxDolModuleDb();
        $this->_oConfig = $oConfig;
    }

    function getAllip()
    {
    	$data 		= array();
    	$query 		= "SELECT * FROM trl_global_report_config where status=1";
		$aSettings 	=  $this->getAll($query);
		return $aSettings;
    }

    function getInfoQuery($id){
    	$query 		= "SELECT * FROM trl_global_report_config where id_global_report='".$id."' ";
		$aData 		=  $this->getAll($query);
		return $aData;
    }

    function getTypeChart(){
    	$query 		= "SELECT * FROM trl_global_report_chart";
		$aData 		=  $this->getAll($query);
		return $aData;
    }

    function getUpdateQuerys($aData)
    {
    	$type_query =  mysql_real_escape_string($aData[5]);
    	$query 		= "UPDATE `trl_global_report_config` conf SET 
    				conf.menu_name='".$aData[1]."',
    				conf.title='".$aData[2]."',
    				conf.icon='".$aData[3]."',
    				conf.description='".$aData[4]."',
    				conf.query='$type_query',
    				conf.chart_type_id=".$aData[6].",
    				conf.status=".$aData[7]."
    				where conf.id_global_report=$aData[0]
    				";
		return $this->query($query);
    }

    function getInsertNewQuery($data)
    {
    	$new_query 	= addslashes ($data[4]);
    	$query 		= "insert into trl_global_report_config 
    				(menu_name,title,icon,description,query,chart_type_id,status)
    				values('$data[0]','$data[1]','$data[2]','$data[3]','$new_query',$data[5],$data[6]);";
		$this->query($query);
    }

    function getUltimeID(){
    	$result 	= "select MAX(id_global_report) as id from trl_global_report_config";
		$info 		= $this->getAll($result);
		return $info;
    }
    function getInsertParameterQuery($input_title,$input_name,$input_type,$id){

    	$sql 		= "insert into trl_global_report_inputs (input_name,input_type,title,id_global_report,input_state)
    					values('$input_name','$input_type','$input_title','$id',1)";
    				$this->query($sql);
    }
    function getUpdateParameterQuery($input_title,$input_name,$input_type,$id){
    	$sql 		= "insert into trl_global_report_inputs (input_name,input_type,title,id_global_report,input_state)
    				values('$input_name','$input_type','$input_title','$id',1)";
    				$this->query($sql);
    }

    function getDeleteParameterQuery($id)
    {
    	$sql 		= "delete from trl_global_report_inputs where id_global_report ='".$id."'";
    	$this->query($sql);
    }

    function getParameterInputs($id){
    	$sql 		= "select * from trl_global_report_inputs where id_global_report='".$id."'";
    	$data 		= $this->getAll($sql);
    	return $data;
    }

    // Delete Query
    function getDeleteQuery($id)
    {
    	// Obteniendo el ID de la Query para borrar sus parametros
	    	$sql 		= "select id_global_report from trl_global_report_config where `id_global_report`='".$id."'";
	    	$data 		= $this->getAll($sql);
	    	$idQuery 	= $data[0]['id_global_report'];

    	// Borrando Parametros de las Querys
	    	$parameter 	= "DELETE FROM trl_global_report_inputs WHERE `id_global_report`='".$idQuery."'";
	    	$data 		= $this->query($parameter);

    	//Borrando La query
	    	$query 		= "DELETE FROM trl_global_report_config WHERE `id_global_report`='".$id."'";
			$aSettings 	=  $this->getAll($query);
			return $aSettings;
    }

    function getDataQuery($id)
    {
    	$data 			= array();
    	$query 			= "SELECT * FROM trl_global_report_config as Config
						left join trl_global_report_chart as Chart
						on Config.`chart_type_id`=Chart.global_report_chart_id
						where Config.`id_global_report`='".$id."'";
		$aSettings =  $this->getAll($query);
		return $aSettings;
    }

    function getInputsParameter($idInputs)
    {
    	$data 		= array();
    	$query 		= "SELECT * FROM trl_global_report_inputs where id_global_report='".$idInputs."'";
		$aSettings 	=  $this->getAll($query);
		return $aSettings;
    }

    function getBuilQuery($oParameter,$sTringQuery){
    	$query;
    	eval("\$query = \"$sTringQuery\";");
		$aSettings =  $this->getAll($query);
		return $aSettings;
    }

    function getDataChart($query)
    {
    	$data = array();
    	$query = "'".$query."'";
		$aSettings =  $this->getAll($query);
		return $aSettings;
    }

    function getAllConfig(){
		// $oDb = new BxDolDb();
		$query = "SELECT * FROM trl_global_report_config";
		return $this->getAll($query);
	}
}
