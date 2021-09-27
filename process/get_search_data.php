<?php
	include "../conn.php";
	include "../functions.php";
	
	extract($_POST);
	foreach($_POST as $key=>$val){
		$val = mysqli_real_escape_string($con, $val);
		$_POST[$key] = $val;
	}
	
	$vWhereString = '';
	
	if(isset($_POST['iCategoryId']) && $_POST['iCategoryId'] != ''){
		$vWhereString .= ' AND rg.iCategoryId = '.$iCategoryId;
	}
	
	if(isset($_POST['iSubCategoryId']) && $_POST['iSubCategoryId'] != ''){
		$vWhereString .= ' AND rg.iSubCategoryId = '.$iSubCategoryId;
	}
	
	
	if(isset($_POST['searchStr'])){
		$searchStr = $_POST['searchStr'];
		$vWhereString .= "
		AND (
			CONCAT(vFirstName, ' ', vLastName) LIKE '%".$searchStr."%' OR
			rg.vBusinessName LIKE '%".$searchStr."%' OR
			ct.name LIKE '%".$searchStr."%' OR
			st.name LIKE '%".$searchStr."%' OR
			rg.vKeywords LIKE '%".$searchStr."%'
		)
		";
	}
	
	$i=0;
	$sql_query = mysqli_query($con,"
		SELECT
			rg.iRegisterId,
			CONCAT(vFirstName, ' ', vLastName) as vFullName,
			rg.vBusinessName,
			ct.name as vCityName,
			st.name as vStateName,
			cm.name as vMainCategory,
			cs.name as vSubCategory
		FROM
			registrations as rg
			LEFT JOIN cities as ct ON ct.id = rg.iCityId
			LEFT JOIN states as st ON st.id = rg.iStateId
			LEFT JOIN category_main as cm ON cm.id = rg.iCategoryId
			LEFT JOIN category_sub as cs ON cs.id = rg.iSubCategoryId
		WHERE
			rg.eStatus = 'Approved' $vWhereString
		ORDER BY iRegisterId DESC
		LIMIT 10
	");
	
	while($row = mysqli_fetch_assoc($sql_query)){ $i++;
  ?>
  <tr>
	  <td><?=$i?></td>
	  <td><?=$row['vFullName']?></td>
	  <td><?=$row['vBusinessName']?></td>
	  <th><?=$row['vMainCategory']?> - <?=$row['vSubCategory']?></th>
	  <td><?=$row['vCityName']?></td>
	  <td><?=$row['vStateName']?></td>
	  <td><a href="javascript:(0)" class="get_data" data-id="<?=$row['iRegisterId']?>">View</a></td>
  </tr>
  <?php } ?>
	
