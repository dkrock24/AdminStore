 <?php
/***************************************************************************
*
Transactel
- Powered by Telus -
*
***************************************************************************/
bx_import('BxDolModule');

class TrlGlobalreportModule extends BxDolModule {
	

    // Constructor
    function TrlGlobalreportModule($aModule)
    {
        parent::BxDolModule($aModule);
    }
    
    function actionHome()
    {    	
        $this->_oTemplate->pageStart();
        bx_import ('PageMain', $this->_aModule);
        $sClass = $this->_aModule['class_prefix'] . 'PageMain';
        $oPage 	= new $sClass ($this);
    	$this->_oTemplate->addCss('ads.css');  

    	echo "<script src='".BX_DOL_URL_ROOT."/modules/transactel/globalreport/js/all.min.js'></script>";    	
    	$aVars = array ('numero' => 'Demo1',  );
    	echo $this->_oTemplate->parseHtmlByName('demo', $aVars);
    	$this->_oTemplate->pageCode(_t('Globalreport'), true);
    }
   
    function actionAdministration($action="")
    {
    	if($action==""){
    		$action="Report";
    	}
    	$this->drawAdmin($action);
    }

    function drawAdmin($action)
    {
    	if(!$GLOBALS['logged']['admin'])
    	{
    		$this->_oTemplate->displayAccessDenied();
    		return;
    	}   
    	
    	$aForm = array();
		$oForm = new BxTemplFormView ($aForm);
        $this->_oTemplate->pageStart();

		$aMenu = array(
            'account_options' => array(
                'title' => _t('_setting_queries'), 
                'href' => BX_DOL_URL_ROOT  . 'm/globalreport/administration/SettingQueries',               
                '_func' => array ('name' => 'actionAdd', 'params' => array(false)),	
            )            
            ,
            'Report' => array(
                'title' => _t('_global_report'), 
                'href' => BX_DOL_URL_ROOT  . 'm/globalreport/administration/Report', 
                '_func' => array ('name' => 'actionDemo', 'params' => array(false)),  
            ),
            'Setting Charts' => array(
                'title' => _t('_help_charts'), 
                'href' => BX_DOL_URL_ROOT  . 'm/globalreport/administration/helpCharts', 
                '_func' => array ('name' => 'actionDemo', 'params' => array(false)),  
            )
		);

		if($action == 'SettingQueries')
		{            
			$sContent = $this->SettingQueries();
        }  
        if($action == 'LoadParameters')
		{            
			$sContent = $this->LoadParameters();
        }         
        if($action == 'SettingParameter')
		{            
			$sContent = $this->SettingParameter();
        }       
        if($action == 'Report')
        {
        	$sContent = $this->Report();
        }    
        if($action == 'settingCharts')
        {
        	$sContent = $this->settingCharts();
        }
        if($action == 'Chart')
        {
        	$sContent = $this->Chart();
        } 
        if($action == 'ShowChart')
        {
        	$sContent = $this->ShowChart();
        } 
        if($action == 'updateForm')
        {
        	$sContent = $this->UpdateForm();
        }
        if($action == 'addQuery')
        {
        	$sContent = $this->addQuery();
        } 
        if($action == 'helpCharts')
        {
        	$sContent = $this->helpCharts();
        }       
        //$js .= $this->_oTemplate->addJs(array('globalReport.js'), true);       
        $sCss = $this->_oTemplate->addCss(array('demo_table.css'),true);
        $this->_oTemplate->pageStart(); 
    	echo $this->_oTemplate->adminBlock ($js.$sCss.$sContent, _t("_main"),  $aMenu);
		$this->_oTemplate->pageCodeAdmin(_t('Global Report'));	
    }

    function helpCharts()
    {
    	$table_start = '<div class="container">';

		$table_body .= '<div class="row">
							<table width="100%">
								<tr class="row_head">
									<td width="20%">Action</td>
									<td>Example</td>
								</tr>
								<tr>
									<td>Add Query</td>
									<td>
										<p>
										[1]<br>
										Todas las querys deben ser creadas bajo un formato especifico
										ya que es posible tener que pasarle parametros y aqui se muestra
										la forma adecuada.<br>
										Los parametros deben tener el formato $oParameter[], en las
										llaves se procede a colocar el numero del parametro,
										Ejemplo: Parametro1 = $oParameter[0], Parametro2 = $oParameter[1]
										etc. <br><br>

										[2]<br>
										El Parametro debe de colocarse entre comillas simples dado que
										una funcion lo esta escapando y de no ser asi mostraria un error 
										al querer insertar la query. Los parametros deben de colocrse en
										el orden que se coloquen en la query
										Ejemplo: \'$oParameter[0]\'
										</p>
									</td>
								</tr>
							</table>
						</div>';

		$table_bottom = '</div>';
		return $table_start .$table_body.$table_bottom;
    }

    function actionDemo()
    {
    	$this->_oTemplate->pageStart();
		$aVars = array ('numero' => 'Demo1',  );
    	echo $this->_oTemplate->parseHtmlByName('demo', $aVars);
    	$this->_oTemplate->pageCode(_t('Globalreport'), true);
    }

    function Report()
    {
    	$Jquery 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/jquery-1.9.1.min.js';
    	$Exporting 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/modules/exporting.js';
    	$Highcharts 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/highcharts.js';
    	$sStringUrl 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/globalReport.js';
    	$sStringUrlCss 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/fonts/css/fontello.css';
		echo '<script type="text/javascript" src="'.$Jquery.'"></script>';		
        echo '<script type="text/javascript" src="'.$Highcharts.'"></script>';	
        echo '<script type="text/javascript" src="'.$sStringUrl.'"></script>';        
        echo '<link rel="stylesheet" type="text/css" href="'.$sStringUrlCss.'">';
        echo '<script type="text/javascript" src="'.$Exporting.'"></script>';

        $aSettings = $this->_oDb->getAllip();
        $num_row = count($aSettings);

		$table_start = '
		<div class="container">
			<div class="row1">';

			if($aSettings==null)
			{
   				$table_body .= '
	                	<div class="enlace" >
	                		<div style="font-size:15px;">No existen Registros o Estan Desabilitados</div>
	                	</div>';
   			}

			foreach($aSettings as $value)
   			{
   				$table_body .= '
	                	<div class="enlace views" id="'.$value['id_global_report'].'">
	                	<div style="font-size: 40px;" class="'.$value['icon'].'"></div>'.$value['title'].'</div>';
			}

			//--------Codigo donde se genera la vista de las menu de graficas
			//echo $sAdminUrl = BX_DOL_URL_ADMIN;
			$table_body .= '
         	</div>
         	<hr style="border: 2px solid rgba(47, 13, 72, 0.63);">
	        <div class="row2">
	        	<div id="forms"></div>
	        	<div id="graficas">
	        		<div class="container"></div>
	        	</div>

	        </div>';

		$table_bottom = '</div>';
		return $table_start .$table_body.$table_bottom;
	}    

	/*
	* Esta funcion muestra la lsita de todas las querys existentes
	*/
	function SettingQueries()
	{
		$Jquery 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/jquery-1.9.1.min.js';
    	$Exporting 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/modules/exporting.js';
    	$Highcharts 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/highcharts.js';
    	$sStringUrl 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/globalReport.js';
    	$sStringUrlCss 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/fonts/css/fontello.css';
		echo '<script type="text/javascript" src="'.$Jquery.'"></script>';			
		echo '<script type="text/javascript" src="'.$Exporting.'"></script>';	
        echo '<script type="text/javascript" src="'.$Highcharts.'"></script>';	
        echo '<script type="text/javascript" src="'.$sStringUrl.'"></script>';        
        echo '<link rel="stylesheet" type="text/css" href="'.$sStringUrlCss.'">';
        echo '<script src="http://code.highcharts.com/modules/exporting.js"></script>';

		$aSettings = $this->_oDb->getAllConfig();

		$table_start = '
		<div class="container">
			<div class="row">
			
				<table width="100%">
					<thead class="head">
						<tr >
							<td width="15%">Name</th>
							<td width="15%">Title</th>
							<td width="25%">Description</th>
							<td width="5%">State</th>
							<td width="10%">
							<a href="addQuery"><div class="back_3" ><i class="icon-plus-circle icon"></i>Add</div></a>
							</td>
						</tr>
					</thead>
                ';

			foreach($aSettings as $value)
   			{
   				$table_body .= '	                	
	            <tr class="bar_buttom">
	                <td class="bar_buttom" width="15%">'.$value['menu_name'].'</td>
	                <td class="bar_buttom" width="15%">'.$value['title'].'</td>
	                <td class="bar_buttom" width="25%">'.$value['description'].'</td>
	                <td class="bar_buttom" width="5%">';
	                	if($value['status']==1){
	                		$table_body .= 'Active';
	                	}
	                	else{
	                		$table_body .= 'Inactive';
	                	}
	                $table_body .= 
	                '</td>	                			
	                <td class="bar_buttom" width="10%"><div class="edit_query" href="#" id='.$value['id_global_report'].'><i class="icon-edit icon"></i> Edit</div></td>
	            </tr>	              	      
            	';
			}

			$table_body .= '
			</table>
	   
	        </div>
            	';

		$table_bottom = '</div>';		
		return $table_start .$table_body.$table_bottom;
	}

	/*
	* Esta funcion carga la Vista luego que se define la query se manda a definir los parametros
	*/
	function SettingParameter()
	{
		$Jquery 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/jquery-1.9.1.min.js';
    	$Exporting 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/modules/exporting.js';
    	$Highcharts 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/highcharts.js';
    	$sStringUrl 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/globalReport.js';
    	$sStringUrlCss 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/fonts/css/fontello.css';
		echo '<script type="text/javascript" src="'.$Jquery.'"></script>';			
		echo '<script type="text/javascript" src="'.$Exporting.'"></script>';	
        echo '<script type="text/javascript" src="'.$Highcharts.'"></script>';	
        echo '<script type="text/javascript" src="'.$sStringUrl.'"></script>';        
        echo '<link rel="stylesheet" type="text/css" href="'.$sStringUrlCss.'">';

        $info = $this->_oDb->getUltimeID();
		$id = $info[0]['id'];

		$table_start = '
		<div class="container">
			<div class="row">
				
				<input type="hidden" id="numero">
				<br>
				<form id="parameter_form">
					<table border="0" width="100%" id="headers" class="row_head">
					<tr >
						<td width="25%">Input Title</td>
						<td width="25%">Input Name</td>
						<td width="25%">Input Type</td>
						<td width="15%" ><div id="addInputs" class="back_2"><i class="icon-plus white"></i>Add Input</div></td>
					</tr>

				</table>

					<div id="parametros">
					</div>		
					<input type="button" value="Save" name="set_data" id="addParameter">
				</form>				
                ';

			$table_body .= '
	        </div>
            	';

		$table_bottom = '</div>';		
		return $table_start .$table_body.$table_bottom;
	}

	/*
	* Esta funcion Contiene la logica de como se guarda el formulario de parametro de cada Query
	*/
	function ActionSaveParameters($data)
	{
		$input_name	='';
		$input_type	='';
		$input_title='';

		$contador = $_POST['numero'];		
		$longitud = 0;
		$numeroCampos=$contador*1;
		$bloque=0;
		$_flat=1;
		$dataId = 		$info = $this->_oDb->getUltimeID();
		$id =  $dataId[0]['id'];
		$this->_oDb->getDeleteParameterQuery($id);
		while ($longitud < $numeroCampos)
		{
			if($bloque==3)
			{
				$bloque=0;
			}

			if($_flat==1){
				 $input_title=$_POST['data'][$longitud]['value'];
			}
			if($_flat==2){
				 $input_name=$_POST['data'][$longitud]['value'];
			}
			if($_flat==3){
				 $input_type=$_POST['data'][$longitud]['value'];
			}

			$_flat++;
			if($_flat==4){
				$this->_oDb->getInsertParameterQuery($input_title,$input_name,$input_type,$id);
				$_flat=1;
			}

			$longitud++;	
			$bloque++;	
				
		}
	}

	/*
	* Esta funcion carga el formulario para agregar una Query
	*/
	function addQuery()
	{
    	$sStringUrl 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/globalReport.js';
    	$sStringUrlCss 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/fonts/css/fontello.css';
    	$Exporting 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/modules/exporting.js';
        echo '<script type="text/javascript" src="'.$sStringUrl.'"></script>';  
        echo '<script type="text/javascript" src="'.$Exporting.'"></script>';  
        echo '<link rel="stylesheet" type="text/css" href="'.$sStringUrlCss.'">';

		$typeChart = $this->_oDb->getTypeChart();
		$data .= '<form id="addData"><table class="table">';

				$data .= "
						<tr>
							<td class='row_head'>
								<a href='SettingQueries'><div class='back'><i class='icon-left white'></i>Back</div></a>
								<div class='back' name='get_data' id='addQuery'><i class='icon-ok-circle white'></i>Save</div>
							</td>
						</tr>
						";

				$data .= '<tr>
							<td>
								<tr><td class="txt"><span class="name"></span>Name</td></tr>
								<tr><td><input class="txt_box" type="text" name="name" value=""></td></tr>
							</td>
						</tr>';
				$data .= '<tr>
							<td>
								<tr><td class="txt"><span class="title"></span>Title</td></tr>
								<tr><td><input class="txt_box" type="text" name="title" value=""></td></tr>
							</td>
						</tr>';
				$data .= '<tr>
							<td>
								<tr><td class="txt"><span class="icon2"></span>Icon</td></tr>
								<tr><td><input class="txt_box" type="text" name="icon" id="icon-input" value=""></td></tr>
								
								<tr>
									<td>
									<span class="zoom"><i class="icon-chart-pie"></i><span class="i-name ">icon-chart-pie</span></span>
									<span class="zoom"><i class="icon-chart-bar"></i><span class="i-name">icon-chart-bar</span></span>
									<span class="zoom"><i class="icon-chart-pie-alt"></i><span class="i-name">icon-chart-pie-alt</span></span>
									
									</td>
								</tr>
							</td>
						</tr>';
				$data .= '<tr>
							<td>
								<tr><td class="txt"><span class="description"></span>Description</td></tr>
								<tr><td><textarea rows="6" cols="80" name="description"></textarea></td></tr>
							</td>
						</tr>';
				$data .= '<tr>
							<td>
								<tr><td class="txt"><span class="query"></span>Query</td></tr>
								<tr><td><textarea rows="6" cols="80" name="query"></textarea></td></tr>
							</td>
						</tr>';
				
				$data .= '<tr>
							<td>
								<tr><td class="txt" >Chart Type</td></tr>
								<tr><td><select name="chart" class="txt_box">';
										foreach ($typeChart as $chart)
										{
												$data .= "<option value='".  $chart['global_report_chart_id']."'>".$chart['chart_type']."</option>";							
										}
								$data .= '</select></td></tr>
								</td>
							</tr>';
				$data .= '<tr>
							<td>
								<tr><td class="txt">State</td></tr>
								<tr><td>
								<select name="state" class="txt_box">									
										<option value="1">Enable</option>
										<option value="0">Disable</option>';
				
								$data .='</select></td></tr>
								</td>
							</tr>';
				$data .= '<tr>
							<td>
								<tr><td class="txt"></td></tr>
								<tr><td><dvi class="addSuccess"></div></td></tr>
							</td>
						</tr>';
		
		$data .= '</table></form>';

		return $data ;
	}

	/*
	* Esta funcion Muestra el Formulario donde se actualiza una Query
	*/
	function ActionshowQuerys()
	{

		$Jquery 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/jquery-1.9.1.min.js';
    	$Exporting 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/modules/exporting.js';
    	$Highcharts 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/highcharts.js';
    	$sStringUrl 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/globalReport.js';
    	$sStringUrlCss 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/fonts/css/fontello.css';
		echo '<script type="text/javascript" src="'.$Jquery.'"></script>';			
        echo '<script type="text/javascript" src="'.$sStringUrl.'"></script>';
         echo '<script type="text/javascript" src="'.$Exporting.'"></script>';
        echo '<link rel="stylesheet" type="text/css" href="'.$sStringUrlCss.'">';


        $id 		= $_POST['id'];		
		$aRows 		= $this->_oDb->getInfoQuery($id);
		$typeChart 	= $this->_oDb->getTypeChart();
		
		$data .= "";
		$data .= "<form id='updateData'><table class='table'>";

				$data .= "
						<tr>
							<td class='row_head'>
								<a href='SettingQueries'><div class='back'><i class='icon-left white'></i>Back</div></a>
								<div class='back' name='".$id."' id='deleteQuery'><i class='icon-cancel white'></i>Delete</div>
								<div class='back' name='get_data' id='update'><i class='icon-ok-circle white'></i>Save</div>
							</td>
						</tr>
						";

				$data .= "<input class='txt_box' type='hidden' name='id' value='".$id."'";
				$data .= "<tr>
							<td>
								<tr><td class='txt'>Name</td></tr>
								<tr><td><input class='txt_box' type='text' name='name' value='".  $aRows[0]['menu_name']."'></td></tr>
							</td>
						</tr>";
				$data .= "<tr>
							<td>
								<tr><td class='txt'>Title</td></tr>
								<tr><td><input class='txt_box' type='text' name='title' value='".  $aRows[0]['title']."'></td></tr>
							</td>
						</tr>";
				$data .= "<tr>
							<td>
								<tr><td class='txt'>Icon</td></tr>
								<tr><td><input class='txt_box' type='text' name='icon' id='icon-input' value='".  $aRows[0]['icon']."'></td></tr>
								<tr><td><div class='search_icon'><span class='icon-search'></span>Search Icon</div></td></tr>
								<tr><td><span class='icon_catalog'></span></td></tr>
							</td>
						</tr>";
				$data .= "<tr>
							<td>
								<tr><td class='txt'>Description</td></tr>
								<tr><td><textarea rows='6' cols='80' name='description'>".$aRows[0]['description']."</textarea></td></tr>
							</td>
						</tr>";
				$data .= "<tr>
							<td>
								<tr><td class='txt'>Query</td></tr>
								<tr>
									<td><textarea rows='6' cols='80' name='query'>".$aRows[0]['query']."</textarea>
										<br><a href='LoadParameters?id=$id'><div class='back'>Update Parameters</div></a>
									</td>
								</tr>
							</td>
						</tr>";
				$data .= "<tr>
							<td>
								<tr><td class='txt' >Chart Type</td></tr>
								<tr><td><select name='chart' class='txt_box'>";
										foreach ($typeChart as $chart) {
											if($aRows[0]['chart_type_id']==$chart['global_report_chart_id'])
											{
												$data .= "<option value='".  $chart['global_report_chart_id']."'>".$chart['chart_type']."</option>";		
											}										
										}
										foreach ($typeChart as $chart) {
											if($aRows[0]['chart_type_id']!=$chart['global_report_chart_id'])
											{
												$data .= "<option value='".  $chart['global_report_chart_id']."'>".$chart['chart_type']."</option>";		
											}										
										}
								$data .= "</select></td></tr>
								</td>
							</tr>";
				$data .= "<tr>
							<td>
								<tr><td class='txt'>State</td></tr>
								<tr><td>
								<select name='state' class='txt_box'>";
									if($aRows[0]['status']==0){
										$data .= "<option value='0'>Disable</option>";
										$data .= "<option value='1'>Enable</option>";
									}else{
										$data .= "<option value='1'>Enable</option>";
										$data .= "<option value='0'>Disable</option>";
									}	
								$data .="</select></td></tr>
								</td>
							</tr>";			
		
		$data .= "</table></form><div class='ddd'></div>";

		echo $data ;
	}

	/*
	*  Esta funcion sirve para cargar los parametros definidos por cada query,
	*  se puede agregar parametro o quitar
	*/
	function LoadParameters()
	{
		
		$Jquery 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/jquery-1.9.1.min.js';
    	$Exporting 		= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/modules/exporting.js';
    	$Highcharts 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/graficas/highcharts.js';
    	$sStringUrl 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/globalReport.js';
    	$sStringUrlCss 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/fonts/css/fontello.css';
		echo '<script type="text/javascript" src="'.$Jquery.'"></script>';			
		echo '<script type="text/javascript" src="'.$Exporting.'"></script>';	
        echo '<script type="text/javascript" src="'.$Highcharts.'"></script>';	
        echo '<script type="text/javascript" src="'.$sStringUrl.'"></script>';        
        echo '<link rel="stylesheet" type="text/css" href="'.$sStringUrlCss.'">';


        $id = $_GET['id'];
		$dataParameter =  $this->_oDb->getParameterInputs($id);
        
		$table_start = '
		<div class="container">
			<div class="row">			
				 
				<table border="0" width="100%" id="headers" class="row_head">
					<tr >
						<td width="25%">Input Title</td>
						<td width="25%">Input Name</td>
						<td width="25%">Input Type</td>
						<td width="15%" ><div id="addInputs" class="back_2"><i class="icon-plus white"></i>Add Input</div></td>
					</tr>
					<input type="hidden" id="numero" value="'.$id.'">
				</table>				
				<br>
				<form id="update_parameter_form">';
				$D="A";
				$E="B";
				$F="C";
				$contador=0;
					foreach ($dataParameter as $value)
					{
						$table_body .= '<div class="fila">
										<table width="100%"><table>
											<tr>
												<td><input type="text" name="'.$D.$contador.'" 	value="'.$value['title'].'"></td>
												<td><input type="text" name="'.$E.$contador.'" value="'.$value['input_name'].'"></td>
												<td><input type="text" name="'.$F.$contador.'" value="'.$value['input_type'].'"></td>
												<td><pan class="row_input2"><i class="icon-cancel-circle"></i>Remove</span></td>
											</tr>
										</table>
										</div>';
										$contador+=1;
					}
		$table_body .= '
						<span id="parametros"></span>
						<table>
							<tr>						
								<td>
									<a href="#" name="'.$id.'" id="aa"><div class="back">Back</div></a>
								</td>
								<td>
									<a href="#" name="'.$contador.'" id="update_form_parameter"><div class="back">Save</div></a>
								</td>
								<td></td>
								<td></td>
							</tr>	
						</table>
				</form>';

			$table_body .= '</div>';

		$table_bottom = '</div>';		
		return $table_start .$table_body.$table_bottom;
	}

	/*
	* Esta funcion Manda a eliminar una query en el mantenimiento de las Querys ("delete")
	*/
	function ActionDeleteQuery()
	{
		$id = $_POST['id'];
		if($id!="")
		{
			$this->_oDb->getDeleteQuery($id);
		}
	}

	/*
	* Esta funcion recibe la informacion de la nueva query a insertar en BD ("add")
	*/
	function ActionAddNewQuery()
	{
		$data 	= array();
		$cadena = "";
		$_flat  = false;
		$resultado="";
		$buscar = array('delete','drop','alter','table','create','insert','update','replace','truncate');
		$data[0]= $_POST['name'];
		$data[1]= $_POST['title'];
		$data[2]= $_POST['icon'];
		$data[3]= $_POST['description'];
		$data[4]= $_POST['query'];
		$data[5]= $_POST['chart'];
		$data[6]= $_POST['state'];

		$cadena = $data[4];
		foreach ($buscar as $value){
			$resultado = stripos($cadena, $value);
			if($resultado !== FALSE)
			{
				$_flat=true;
			}
		}
		if($_flat==false){
			$oInsert = $this->_oDb->getInsertNewQuery($data);		
			$success ="SUCCESS !";
		}else{
			$success ="ERROR !";
		}		
		echo $success;
	}

	/*
	* Esta funcion Actualiza las Querys ("update")
	*/
	function ActionUpdateForm()
	{
		$data[0] = $_POST['id'];
		$data[1] = $_POST['name'];
		$data[2] = $_POST['title'];
		$data[3] = $_POST['icon'];
		$data[4] = $_POST['description'];
		$data[5] = $_POST['query'];
		$data[6] = $_POST['chart'];
		$data[7] = $_POST['state'];	

		$aSettings 	= $this->_oDb->getUpdateQuerys($data);
		$success = "SUCCESS !";
		echo $success;
	}

	function ActionSaveUpdateFormParameters()
	{
		$input_name	='';
		$input_type	='';
		$input_title='';

		$idReport =  $_POST['finaly'];

		$contador = $_POST['id'];	
		$this->_oDb->getDeleteParameterQuery($idReport);

		$longitud = 0;
		$numeroCampos=$_POST['longitud'];
		$bloque=0;
		$_flat=1;

		$id =  $dataId[0]['id'];
		while ($longitud < $numeroCampos)
		{
			if($bloque==3)
			{
				$bloque=0;
			}

			if($_flat==1){
				 $input_title=$_POST['data'][$longitud]['value'];
			}
			if($_flat==2){
				 $input_name=$_POST['data'][$longitud]['value'];
			}
			if($_flat==3){
				 $input_type=$_POST['data'][$longitud]['value'];
			}

			$_flat++;
			if($_flat==4){
				echo $input_title." ".$input_name." ".$input_type."<br>";
				$this->_oDb->getUpdateParameterQuery($input_title,$input_name,$input_type,$idReport);
				$_flat=1;
			}

			$longitud++;	
			$bloque++;	
				
		}

	}

	function alert()
	{
		echo PopupBox('mood_popup', _t('_mood_module'), _t('_mood_not_allowed'));		
		$aSettings = $this->_oDb->getAllConfig();

		$table_start = '
		<div class="container">
			<div class="row">
				<table width="100%">
					<thead>
						<tr class="head">
							<td width="15%">Name</th>
							<td width="15%">Title</th>
							<td width="25%">Description</th>
							<td width="5%">State</th>
							<td width="5%"></th>
						</tr>
					</thead>
                ';

			foreach($aSettings as $value)
   			{
   				$table_body .= '	                	
	            <tr>
					<td width="15%">'.$value['menu_name'].'</td>
	            </tr>	                	      
            	';
			}

			$table_body .= '
			</table>       
	                </div>
            	';

		$table_bottom = '</div>';		
		return $table_start .$table_body.$table_bottom;
		//echo PopupBox('mood_popup', _t('aaaa'), _t('aaa'));
	}

	function ActionsettingCharts()
	{
			
		/********************************************************
		* ESTA FUNCION ES LLAMADA POR LA FUNCION AJAX DEL JS - globalReposrt.js *
		********************************************************/
		$id 		= $_POST['id'];
		$aSettings 	= $this->_oDb->getDataQuery($id);
		$data 		= array();
		foreach ($aSettings as $value)
		{
			$data['id_global_report'] 	= $value['id_global_report'];
			$data['descripcion'] 		= $value['description'];
			$data['query'] 				= $value['query'];
			$data['title'] 				= $value['title'];
			$data['chrarType'] 			= $value['chart_type'];
			$data['chrarFunction'] 			= $value['chart_function'];
		}

		/*
		* Retorna los inputs creados para enviar como parametros a la query
		*/

		$aInput = array();
		$aInputs = $this->_oDb->getInputsParameter($data['id_global_report']);		

		/*
		* Se envia la Query a la funcino de BD para que retorne el array de informacion
		*/

		//$aDataQuery = $this->_oDb->getDataChart($data['query']);
		$html .=  "
		<form id='plantilla'>
			<table width='100%'>
			<input type='hidden' class='idQuery' value='".$id."' name='idQuery'>
			";

				foreach ($aInputs as $value)
				{
					$html .="
					
					<tr>
						<td><span>".$value['title']."</span></div>
						<td>							
							<input class='". $value['input_name']. "' type='".$value['input_type']."' name='". $value['input_name']. "'>
						</td>
					</tr>";					
				}

				
				$html .="
				<tr>
				<td></div>
					<td>						
						<input type='button' value='Generate' name='get_data' id='save'>
					</td>
					
					
				</tr> 

				<h1 class='description'>".$data['title']."</h1>	

				</table>
		</form>
		<div id='cc'></div>
		";
		echo $html;
	}

	function ActionLoading(){
		$loading =  $GLOBALS['oAdmTemplate']->getImageUrl('load.gif');
		$html .="
		<div class='loading'>     		
	    	<img src='".$loading."'' />      			
	    </div>
	    ";
		echo $html;
	}

	function ActionShowchart()
	{

        $aSettings = $this->_oDb->getAllip();
        $num_row = count($aSettings);

		$table_start .= '<div class="total">';

				//* Inicio Proceso para obtener Data
				$id 		=  $_POST['idQuery'];
				$aSettings 	= $this->_oDb->getDataQuery($id);
				$data 		= array();

				foreach ($aSettings as $value)
				{
						$data['id_global_report'] 	= $value['id_global_report'];
						$data['descripcion'] 		= $value['description'];
						$data['query'] 				= $value['query'];
						$data['title'] 				= $value['title'];
						$data['chrarType'] 			= $value['chart_type'];
						$data['chartFunction'] 		= $value['chart_function'];
				}

				$type_chart 	= $data['chrarType'];
				$function 		= $data['chartFunction'];
				$description 	= $data['descripcion'];
		    	$aInput 		= array();
				$aInputs 		= $this->_oDb->getInputsParameter($id);
				$oParameter 	= array();

				foreach($aInputs as $values)
		   		{

		   				$oParameter[] = $_POST[$values['input_name']];

				}

				$aSettings 	= $this->_oDb->getDataQuery($id);
				$query 		= $aSettings[0]['query'];
				$builQuery 	= $this->_oDb->getBuilQuery($oParameter,$query);

			//* Fin Proceso para obtener Data
			//--------Codigo donde se genera la vista de las menu de graficas
			$this->ActionReport($builQuery,$type_chart,$function,$description);
	}

	/*
	*   En la funcion report deberia de hacer referencia 
	*	de forma dinamica  a la funciom que genera el grafico.
	*	que se mande a llamar luego del evento click del popoup
	*/	
	function ActionReport($dataChart,$type_chart,$function,$description)
	{		
		$a = $dataChart;
		if($type_chart=='Data Table')
		{
			$this->build_table($dataChart);
		}
		else
		{
			
			$this->myChart($dataChart,$type_chart,$function,$description);  
			$this->build_table($a);  
        }	
	}	

	function myChart($dataChart,$type_chart,$function,$description)
	{
			/************************************************************
			 *	Enlaces a las librerias de los JS (Jquery y HighCharts) *
			 ************************************************************/			
			$url = BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/generatorCharts.js';
	        echo '<script type="text/javascript" src="'.$url.'">        		
	        </script>';
	        $data 	= array();
	        $cont 	=0;
	        $alias 	= array();

	        foreach ($dataChart as $value) 
	        {
	        	foreach (array_keys($value) as $key)
	        	{        		
	            	$alias[] = $key;
	        	}
	        	break;
	        }

	        foreach ($dataChart as $value)
	        {
	        	foreach ($alias as $key)
	        	{
		        	$data[$cont][$key] = str_replace("'","",$value[$key] ) ;
	        	}
	        	$cont++;
	        }
	        $c = json_encode( $data, JSON_NUMERIC_CHECK );


	        echo '	<div id="chart" style="width: 100% !important;"></div>';
	        echo "	<script type='text/javascript'>

	        			var obj = JSON.parse('".$c."');
	        			typeChart(obj,'".$type_chart."','".$function."','".$description."');

	        		</script>";

	}

	function build_table($array)
	{
	    // start table
	    $cont=1;
	    $html = '<table class="build_table">';
	    $html .= '<tr><th>#</th>';
	    foreach($array[0] as $key=>$value)
	    {
	        $html .= '<th>' . $key . '</th>';
	    }
	    $html .= '</tr>';
	    foreach( $array as $key=>$value)
	    {
	        $html .= '<tr><td>'.$cont.'</td>';

	        foreach($value as $key2=>$value2)
	        {
	            $html .= '<td>' . $value2 . '</td>';
	        }
	        $html .= '</tr>';
	        $cont++;
	    }
	    $html .= '</table>';
	    echo  $html;
	}

	/*
	* Set de Iconos que sirven para cargar como imagen en el menu de las graficas
	*/
	function ActionIconCatalog()
	{
    	$sStringUrl 	= BX_DOL_URL_ROOT . 'modules/transactel/globalreport/js/globalReport.js';		
        echo '<script type="text/javascript" src="'.$sStringUrl.'"></script>';   
		$icon ='
		<div id="icons" class="container">			
			<div class="row">	
				<table>
					<tr>
						<td class="zoom"><i class="icon-search"></i><span class="i-name">icon-search</span></td>
						<td class="zoom"><i class="icon-mail"></i><span class="i-name">icon-mail</span></td>
						<td class="zoom"><i class="icon-heart"></i> <span class="i-name">icon-heart</span></td>
						<td class="zoom"><i class="icon-heart-empty"></i> <span class="i-name">icon-heart-empty</span></td>
					</tr>
					<tr>
						<td class="zoom"><i class="icon-star"></i> <span class="i-name">icon-star</span></td>
						<td class="zoom"><i class="icon-user"></i> <span class="i-name">icon-user</span></td>
						<td class="zoom"><i class="icon-video"></i> <span class="i-name">icon-video</span></td>
						<td class="zoom"><i class="icon-home"></i> <span class="i-name">icon-home</span></td>
					</tr>
					<tr>
						<td class="zoom"><i class="icon-picture"></i> <span class="i-name">icon-picture</span></td>
						<td class="zoom"><i class="icon-camera"></i> <span class="i-name">icon-camera</span></td>
						<td class="zoom"><i class="icon-ok"></i> <span class="i-name">icon-ok</span></td>
						<td class="zoom"><i class="icon-ok-circle"></i> <span class="i-name">icon-ok-circle</span></td>
					</tr>
					<tr>
						<td class="zoom"><i class="icon-cancel"></i> <span class="i-name">icon-cancel</span></td>
						<td class="zoom"><i class="icon-cancel-circle"></i> <span class="i-name">icon-cancel-circle</span></td>
						<td class="zoom"><i class="icon-plus"></i> <span class="i-name">icon-plus</span></td>
						<td class="zoom"><i class="icon-plus-circle"></i> <span class="i-name">icon-plus-circle</span></td>
					</tr>
					<tr>
						<td class="zoom"><i class="icon-minus"></i> <span class="i-name">icon-minus</span></td>
						<td class="zoom"><i class="icon-minus-circle"></i> <span class="i-name">icon-minus-circle</span></td>
						<td class="zoom"><i class="icon-help"></i> <span class="i-name">icon-help</span></td>
						<td class="zoom"><i class="icon-info"></i> <span class="i-name">icon-info</span></td>
					</tr>
					<tr>
						<td class="zoom"><i class="icon-chart-pie"></i> <span class="i-name">icon-chart-pie</span></td>
						<td class="zoom"><i class="icon-chart-bar"></i> <span class="i-name">icon-chart-bar</span></td>
						<td class="zoom"><i class="icon-chart-pie-alt"></i> <span class="i-name">icon-chart-pie-alt</span></td>						
						<td class="zoom"><i class="icon-home"></i> <span class="i-name">icon-home</span></td>	
					</tr>
				</table>	
			</div>
		</div>
		';

		echo $icon;
	}
	
}