<?php
include 'newfiles/conn.php';
include "newfiles/common.php";

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/myfiles/dropdown2/plugins.css");

$doc->addScript(JURI::root( true )."/myfiles/dropdown2/jquery.js");
$doc->addScript(JURI::root( true )."/myfiles/dropdown2/jquery-ui.min.js");
$doc->addScript(JURI::root( true )."/myfiles/dropdown2/jquery.cooki.js");
$doc->addScript(JURI::root( true )."/myfiles/dropdown2/plugins.js");
$doc->addScript(JURI::root( true )."/myfiles/dropdown2/scripts.js");


$year = -1;
if(isset($_REQUEST['year']))	
	$year = $_REQUEST['year'];

$month = -1;
if(isset($_REQUEST['month']))	
	$month = $_REQUEST['month'];

$emp_type_id = -1;
if(isset($_REQUEST['emp_type_id']))	
	$emp_type_id = $_REQUEST['emp_type_id'];

if($month==1)
{
	$prev_year=$year-1;
	$previous_month=12;
}
else
{
	$prev_year=$year;
	$previous_month=$month-1;
}
$user = JFactory::getUser();

if(isset($_REQUEST['generate']) && isset($_REQUEST['emp_id']))
{
	$date = date('Y-m-d');
	$emp_ids = $_REQUEST['emp_id'];
	
	foreach($emp_ids as $emp_id)
	{
		$emp = getSingleRow("SELECT e.first_name, e.last_name, e.account_no, bank_id, employee_categories, ed.*  
						FROM `kiusc_employees` e 
						left join kiusc_emp_designations ed on ed.emp_id=e.id
						 WHERE e.id = '$emp_id' and e.is_payroll=1 and e.is_active=1 AND ed.is_current = 1") ;
		
		$account_no = $emp['account_no'];
		$bank_id = $emp['bank_id'];
		$employee_categories = $emp['employee_categories'];
		$designation_id = $emp['designation_id'];
		$acc_department_id = $emp['acc_department_id'];
		$adm_department_id = $emp['adm_department_id'];
		$employment_nature = $emp['employment_nature'];
		$mode_of_employment = $emp['mode_of_employment'];
		$employment_scale = $emp['employment_scale'];
		$pay_scale = $emp['pay_scale'];

		$is_arrears_exist = no_of_rows("SELECT * FROM `pr_emp_allowances` WHERE emp_id = '$emp_id' and allw_id=22") ;
		$basic = getSingleRow("SELECT * FROM `pr_emp_basic_pay` WHERE `emp_id` = '$emp_id'");
		if($is_arrears_exist == 0)
		{
			if(!($basic['id']) || ($basic['cur_basic_pay'] == 0))
			{
				echo "<font color='red'>Error:- ".$emp['first_name']." ".$emp['last_name']." - pay fixation required.</font> <br>";
				continue;
			}
		}
		$salary = getSingleRow("SELECT * FROM `pr_salary` WHERE `emp_id` = '$emp_id' and year = '$year' and month = '$month'");
		
		if($salary['is_approved'] == 1)
		{
			echo "<font color='red'>Error : ".$emp['first_name']." ".$emp['last_name']." - Salary is approved.</font> <br>";
			continue;
		}
		//// start transaction ////
		mysqli_autocommit($conn,FALSE);
		$roll_back = 0;
		
		///////////////
		//////Previous Salary Generated or not?

		$no_of_days_month = date('t');
		$no_of_days_month = getNumberOfDays($month);

		$query = "SELECT 
					MONTH(ed.date_of_joining) as date_of_joining_m, 
					YEAR(ed.date_of_joining) as date_of_joining_y,
					DAY(ed.date_of_joining) as date_of_joining_d 
						FROM `kiusc_employees` e
						JOIN kiusc_emp_designations ed ON e.id = ed.emp_id
						where e.`id` = '$emp_id' AND ed.is_current=1";

		$emp_perday = getSingleRow($query);

		$total_days= $no_of_days_month - $emp_perday['date_of_joining_d'] + 1; // +1 is for Include the day of Joining
		
		$date_of_joining_m = $emp_perday['date_of_joining_m'];
		$date_of_joining_y = $emp_perday['date_of_joining_y'];

		// if($date_of_joining_m == $previous_month && $date_of_joining_y == $prev_year)
		// {
		// 	$count = no_of_rows("SELECT * FROM `pr_salary` WHERE `emp_id` = '$emp_id' and year = '$prev_year' and month = '$previous_month'");
		// 	if($count == 0)
		// 	{
		// 		echo "<font color='red'>Ok : ".$emp['first_name']." ".$emp['last_name']."- Please Generate Previos Salary First!.</font> <br>";
		// 		$roll_back = 1;
		// 		continue;
		// 	}


		// }
		
		// echo $date_of_joining_m .' - '.$month.' = '.$date_of_joining_y .' - '. $year;
		if($date_of_joining_m > $month && $date_of_joining_y >= $year)
		{
			$count = no_of_rows("SELECT * FROM `pr_salary` WHERE `emp_id` = '$emp_id' and year = '$prev_year' and month = '$previous_month'");
			if($count == 0)
			{
				echo "<font color='red'>Ok : ".$emp['first_name']." ".$emp['last_name']."- Please Update Date of Joining!.</font> <br>";
				
				$roll_back = 1;
				continue;
			}


		}
		/////////////////////

		$basic_pay = $basic['cur_basic_pay'];
		$qualification_pay = $basic['cur_qualification_pay'];		
		$special_pay = $basic['cur_special_pay'];
		
		$allw_amounts = getSingleRow("SELECT SUM(ROUND(amount)) as all_amount 
										FROM `pr_emp_allowances`
										WHERE `emp_id` = '$emp_id'
										AND ( 
													`status` = 'Always' 
													OR ( 
														`status` != 'Always' 
														AND `start_year` <= '$year' 
														AND ( 
															(`start_month` <= '$month' AND `start_year` = '$year') 
															OR (`start_year` < '$year')
														) 
														AND ( 
															(`end_year` > '$year') 
															OR (`end_year` = '$year' AND `end_month` >= '$month') 
														) 
													) 
												)");

		$allw_amount = $allw_amounts['all_amount'];

		$pay_fixation = getSingleRow("SELECT * FROM `pr_pay_fixation` WHERE emp_id = '$emp_id'");
		$salary_percentage = $pay_fixation['salary_percentage'];
		
		$ded_amount = getSingleRow("SELECT SUM(ROUND(amount)) as ded_amount 
												FROM `pr_emp_deductions` 
												WHERE `emp_id` = '$emp_id' 
												AND ( 
													`status` = 'Always' 
													OR ( 
														`status` != 'Always' 
														AND `start_year` <= '$year' 
														AND ( 
															(`start_month` <= '$month' AND `start_year` = '$year') 
															OR (`start_year` < '$year')
														) 
														AND ( 
															(`end_year` > '$year') 
															OR (`end_year` = '$year' AND `end_month` >= '$month') 
														) 
													) 
												)");
		$ded_amount = $ded_amount['ded_amount'];

		////Salary fixation in %
		if(($salary_percentage) && $salary_percentage > 0)
		{
			$basic_pay = $basic_pay * ($salary_percentage/ 100);
			$qualification_pay = $qualification_pay * ($salary_percentage/ 100);
			$special_pay = $special_pay * ($salary_percentage/ 100);
			$allw_amount = $allw_amount * ($salary_percentage/ 100);
		}
		///////////Salary generation checking for few days
		if($date_of_joining_m == $month && $date_of_joining_y == $year)
		{
			
			$basic_pay = ($basic_pay/$no_of_days_month) * $total_days;
			$qualification_pay = ($qualification_pay/$no_of_days_month) * $total_days;
			$special_pay = ($special_pay/$no_of_days_month) * $total_days;
			$allw_amount = ($allw_amount/$no_of_days_month) * $total_days;
			$ded_amount = ($ded_amount/$no_of_days_month) * $total_days;

			// $net_amount = $basic_pay + $qualification_pay + $special_pay + $allw_amount - $ded_amount;
		}
		$net_amount = round($basic_pay + $qualification_pay + $special_pay + $allw_amount - $ded_amount);

		////////////////////
		if($salary['id'])
		{
			$ded_amounts = getSingleRow("SELECT * FROM `pr_emp_deductions` WHERE `emp_id` = '$emp_id'");

			ins_upd_del("UPDATE `pr_gpf_management` SET `gpf_amout`='".$ded_amounts['amount']."' WHERE emp_id='$emp_id'");

			$salary_id = $salary['id'];
			if(!ins_upd_del("DELETE FROM `pr_salary_details` WHERE `salary_id` = '$salary_id'"))
			{
				$roll_back = 1;
				echo "<font color='red'>Error:- cann't delete previous details.</font> <br>";
			}
			if(!ins_upd_del("UPDATE `pr_salary` SET `account_no`='$account_no', `bank_id`='$bank_id', `employee_categories`='$employee_categories', `designation_id`='$designation_id', `acc_department_id`='$acc_department_id', `adm_department_id`='$adm_department_id', `employment_nature`='$employment_nature', `mode_of_employment`='$mode_of_employment', `employment_scale`='$employment_scale', `pay_scale`='$pay_scale',`basic_pay`='$basic_pay',`qualification_pay`=$qualification_pay, `special_pay`=$special_pay, `allw_amount`='$allw_amount',`ded_amount`='$ded_amount',
						`net_amount`='$net_amount',`generate_date`='$date', `generate_user_id` = '$user->id' WHERE id = '$salary_id'"))
			{
				$roll_back = 1;
				echo "<font color='red'>Error:- cann't update salary.</font> <br>";
			}
		}
		else
		{
			if(!ins_upd_del("INSERT INTO `pr_salary`(`emp_id`, `account_no`, `bank_id`, `designation_id`, `acc_department_id`, `adm_department_id`, `employment_nature`, `mode_of_employment`, `employment_scale`, `pay_scale`, `employee_categories`, `year`, `month`, `basic_pay`,`qualification_pay` ,`special_pay`, `allw_amount`, `ded_amount`, `net_amount`, `generate_date`,`generate_user_id`) 
						VALUES ('$emp_id', '$account_no','$bank_id','$designation_id','$acc_department_id','$adm_department_id','$employment_nature','$mode_of_employment','$employment_scale','$pay_scale','$employee_categories','$year', '$month', '$basic_pay', '$qualification_pay', '$special_pay', '$allw_amount', '$ded_amount', '$net_amount', '$date', '$user->id')"))
			{
				$roll_back = 1;
				echo "<font color='red'>Error:- cann't save salary record.</font> <br>";
			}
			$salary_id = mysqli_insert_id($conn);
		}
		
		$allownces = getMultipleRows("SELECT * 
										FROM `pr_emp_allowances`
										WHERE `emp_id` = '$emp_id' 
										AND ( 
											`status` = 'Always' 
											OR ( 
												`status` != 'Always' 
												AND `start_year` <= '$year' 
												AND ( 
													(`start_month` <= '$month' AND `start_year` = '$year') 
													OR (`start_year` < '$year')
												) 
												AND ( 
													(`end_year` > '$year') 
													OR (`end_year` = '$year' AND `end_month` >= '$month') 
												) 
											) 
										)");
		foreach($allownces as $all)
		{
			$all_detail_amount= $all['amount'];
			if(($salary_percentage) && $salary_percentage > 0)
			{
				$all_detail_amount = $all_detail_amount * ($salary_percentage/ 100);
			}
			if($date_of_joining_m == $month && $date_of_joining_y == $year)
			{
				$all_detail_amount = ($all_detail_amount/$no_of_days_month) * $total_days;
			}

			if(!ins_upd_del("INSERT INTO `pr_salary_details`(`salary_id`, `allw_id`, `amount`, `deduction_id`) 
							VALUES ('$salary_id', '".$all['allw_id']."', '$all_detail_amount', '0')"))
			{
				$roll_back = 1;
				echo "<font color='red'>Error:- cann't save salary allownces.</font> <br>";
			}
		}
		
		$deductions = getMultipleRows("SELECT * 
											FROM `pr_emp_deductions` 
											WHERE `emp_id` = '$emp_id' 
											AND ( 
												`status` = 'Always' 
												OR ( 
													`status` != 'Always' 
													AND `start_year` <= '$year' 
													AND ( 
														(`start_month` <= '$month' AND `start_year` = '$year') 
														OR (`start_year` < '$year')
													) 
													AND ( 
														(`end_year` > '$year') 
														OR (`end_year` = '$year' AND `end_month` >= '$month') 
													) 
												) 
											)");
		foreach($deductions as $ded)
		{
			$ded_detail_amount=0;
			$ded_detail_amount= $ded['amount'];
			if($date_of_joining_m == $month && $date_of_joining_y == $year)
			{
				$ded_detail_amount = ($ded_detail_amount/$no_of_days_month) * $total_days;
			}
			if($ded['deduction_id'] == '11') // Loan Recovery id = 11
			{
				if(!ins_upd_del("UPDATE loan_repayment_schedule lrs
									JOIN loan_applications la 
										ON la.id = lrs.loan_id
									SET lrs.status = 'paid',
										lrs.paid_at = CURDATE()
									WHERE YEAR(lrs.due_date) = '$year'
									AND MONTH(lrs.due_date) = '$month'
									AND la.emp_id = '$emp_id'"))
				{
					$roll_back = 1;
					echo "<font color='red'>Error:- cann't update loan recovery.</font> <br>";
				}
			}
			if($ded['deduction_id'] == '1')
			{		
				if(!ins_upd_del("INSERT INTO `pr_gpf_management`(`emp_id`, `gpf_amout`, `dc`, `remarks`, `year`, `month`) VALUES ('$emp_id','$ded_detail_amount','+','Monthly GPF','$year', '$month')"))
				{
					$roll_back = 1;
					echo "<font color='red'>Error:- cann't save salary Monthly GPF.</font> <br>";
				}
				

				$emp_gpf = getSingleRow("SELECT * FROM `pr_gpf_recovery` where emp_id='$emp_id'");
				$recovery_to_date = $emp_gpf['recovery_to_date'];
				$monthly_recovery_amount = $emp_gpf['monthly_recovery_amount'];
				$is_recovered = $emp_gpf['is_recovered'];
				$recovery_end_year = $emp_gpf['recovery_end_year'];
				$recovery_end_month = $emp_gpf['recovery_end_month'];
				if($is_recovered == 1)
				{
					$remaining_amount = $recovery_to_date - $monthly_recovery_amount;
					
					if(!ins_upd_del("UPDATE `pr_gpf_recovery` SET `recovery_to_date`='$remaining_amount' WHERE emp_id='$emp_id'"))
					{
						$roll_back = 1;
						echo "<font color='red'>Error:- cann't Update salary Monthly GPF Recovery.</font> <br>";
					}

					if(!ins_upd_del("INSERT INTO `pr_gpf_management`(`emp_id`, `gpf_amout`, `dc`, `remarks`, `year`, `month`) VALUES ('$emp_id','$monthly_recovery_amount','+','Recovery','$year', '$month')"))
					{
						$roll_back = 1;
						echo "<font color='red'>Error:- cann't save salary Monthly GPF.</font> <br>";
					}
				}
				if($recovery_end_year == $year && $recovery_end_month == $month)
				{
					ins_upd_del("UPDATE `pr_gpf_recovery` SET `is_recovered`=0 WHERE emp_id='$emp_id'");
				}
			}
			
			if(!ins_upd_del("INSERT INTO `pr_salary_details`(`salary_id`, `allw_id`, `amount`, `deduction_id`) 
							VALUES ('$salary_id', '0', '$ded_detail_amount', '".$ded['deduction_id']."')"))
			{
				$roll_back = 1;
				echo "<font color='red'>Error:- cann't save salary deductions.</font> <br>";
			}
		}
		
		if($roll_back == 0)
		{
			mysqli_commit($conn);
			echo "<font color='green'>Ok : ".$emp['first_name']." ".$emp['last_name']."- Salary is generated.</font> <br>";
			// if($emp['new_emp'] == 1)
			// 	ins_upd_del("UPDATE `kiusc_employees` SET `new_emp`='0' WHERE id='$emp_id'");
		}
		else
		{
			mysqli_rollback($conn);
		}
		
	}
}

function getNumberOfDays($month) {
	// Year for which you want to find the number of days in the month
	$year = date('Y'); // Current year

	// Get the number of days in the month
	$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

	return $days;
}
?>


<form action="" method="POST">
    <table  class="table table-striped table-hover">
        <tr>
            <th> Year </th>
            <td>
                <select name="year" required>
                    <?php
					for($y = (date('Y')-2); $y<=date('Y')+1; $y++)
					{
						$sel = "";
						if($y == date("Y") and $year == -1)
							$sel = " selected ";
						
						if($y == $year)
							$sel = " selected ";
						
						echo "<option value='$y' $sel>$y</option>";
					}
					?>
                </select>
            </td>
        </tr>
        <tr>
            <th> Month </th>
            <td>
                <select name="month">
                    <?php
					$months_array = array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");
					foreach($months_array as $key=>$val)
					{
						$sel = "";
						if($key == $month)
							$sel = " selected ";
						
						echo "<option value='$key' $sel>$val</option>";
					}
					?>
                </select>
            </td>
        </tr>
        <tr>
            <th> Employee Type </th>
            <td>
                <select name="emp_type_id">
                    <option value='0'>All</option>
                    <option value='Admin Departments'>Admin Departments</option>
                    <option value='Academic Departments'>Academic Departments</option>
                </select>
            </td>
        </tr>
        <tr>
            <th> </th>
            <td><input type="submit" name="check" value="Check"></td>
        </tr>
    </table>
</form>
<?php
if($emp_type_id != -1)
{
	?>
	<hr>
	<font style='color:white; background-color:red; padding:12px'>Service Ends</font>
	<font style='color:white; background-color:gray; padding:12px'>Newly Added</font>
	<hr>

	<form action="" method="post">
		<input type="hidden" name="year" value="<?php echo $year ?>">
		<input type="hidden" name="month" value="<?php echo $month ?>">
		<input type="hidden" name="date" value="<?php echo $date ?>">

		<table width="100%" border="1px" class="table table-striped table-hover">
			<tr>
				<th>S.No</th>
				<th>Name</th>
				<th>Father Name</th>
				<th>CNIC</th>
				<th>Designation</th>
				<th>Scale</th>
				<th>Bank</th>
				<th>Account #</th>
				<th>Date of Joining</th>
				<th>Service End Date</th>
			</tr>
			<?php
			$sno = 0;

			// Base query for retrieving employee information
			$departmentCondition = ""; // Default is empty

			if ($emp_type_id === "Admin Departments") {
				$departmentCondition = "AND e.adm_department_id != 0";
			} elseif ($emp_type_id === "Academic Departments") {
				$departmentCondition = "AND e.acc_department_id != 0";
			}

			// Construct the query with the department condition if applicable
			$query = "SELECT 
						e.id, 
						e.first_name, 
						e.employment_nature, 
						e.last_name, 
						e.fname, 
						e.cnic, 
						e.account_no, 
						ed.employment_scale, 
						ed.pay_scale, 
						ed.date_of_joining, 
						d.designation, 
						e.bank_id, 
						CASE 
							WHEN e.employment_nature = 'regular' THEN e.service_end_date
							ELSE ed.service_end_date
						END AS service_end_date
					FROM 
						kiusc_employees e
					JOIN 
						kiusc_emp_designations ed 
						ON ed.emp_id = e.id
					JOIN 
						kiusc_designations d 
						ON d.id = ed.designation_id
					WHERE 
						ed.is_current = 1 
						AND e.is_payroll = 1 
						AND e.is_active = 1
						$departmentCondition
					ORDER BY 
						e.first_name";
			// Execute the optimized query
			$employees = getMultipleRows($query);

			foreach($employees as $emp)
			{
				$fixation = 1;
				$emp_id = $emp['id'];
				$bank_id = $emp['bank_id'];
				$service_end_date = $emp['service_end_date'];

				$emp_designations = getSingleRow("SELECT d.designation, ed.* FROM `kiusc_emp_designations` ed 
											JOIN kiusc_designations d ON d.id=ed.designation_id 
												WHERE ed.emp_id='$emp_id' AND ed.is_current=1");

				$pay_fixation = getSingleRow("SELECT * FROM `pr_pay_fixation` WHERE emp_id = '$emp_id'");
				$salary_percentage = $pay_fixation['salary_percentage'];
				
				$lastdate = date('Y-m-t',strtotime($year . '-' . $month . '-' . '14')); // last date of month
				
				$expire = "";
				$checked = " checked ";
				if($service_end_date < $lastdate)
				{
					$expire = " style='color:white; background-color:red'";
					$checked = " ";
				}
				
				$basic_pays = getSingleRow("SELECT * FROM `pr_emp_basic_pay` WHERE `emp_id` = '".$emp['id']."'");
				$basic_pay = $basic_pays['cur_basic_pay'];
				$qualification_pay = $basic_pays['cur_qualification_pay'];
				$special_pay = $basic_pays['cur_special_pay'];
				//echo $special_pay;
				
				$all_amount = getSingleRow("SELECT SUM(ROUND(amount)) as all_amount 
												FROM `pr_emp_allowances` 
												WHERE `emp_id` = '$emp_id' 
												AND ( 
													`status` = 'Always' 
													OR ( 
														`status` != 'Always' 
														AND `start_year` <= '$year' 
														AND ( 
															(`start_month` <= '$month' AND `start_year` = '$year') 
															OR (`start_year` < '$year')
														) 
														AND ( 
															(`end_year` > '$year') 
															OR (`end_year` = '$year' AND `end_month` >= '$month') 
														) 
													) 
												)");
												
				$all_amount = $all_amount['all_amount'];
				
				$ded_amount = getSingleRow("SELECT SUM(ROUND(amount)) as ded_amount 
												FROM `pr_emp_deductions` 
												WHERE `emp_id` = '$emp_id' 
												AND ( 
													`status` = 'Always' 
													OR ( 
														`status` != 'Always' 
														AND `start_year` <= '$year' 
														AND ( 
															(`start_month` <= '$month' AND `start_year` = '$year') 
															OR (`start_year` < '$year')
														) 
														AND ( 
															(`end_year` > '$year') 
															OR (`end_year` = '$year' AND `end_month` >= '$month') 
														) 
													) 
												)");
				// $ded_amount = getSingleRow("SELECT SUM(ROUND(amount)) as ded_amount FROM `pr_emp_deductions` WHERE `emp_id` = '".$emp['id']."'");
				$ded_amount = $ded_amount['ded_amount'];
				
				if(($salary_percentage) && $salary_percentage > 0)
				{
					$basic_pay = $basic_pay * ($salary_percentage/ 100);
					$qualification_pay = $qualification_pay * ($salary_percentage/ 100);
					$special_pay = $special_pay * ($salary_percentage/ 100);
					$all_amount = $all_amount * ($salary_percentage/ 100);
				}
				
				$net_amount = $basic_pay + $qualification_pay + $special_pay + $all_amount - $ded_amount;
				
				$generate = "style='color:black; background-color:yellow; padding:12px'";

				$salary = getSingleRow("SELECT * FROM `pr_salary` WHERE `emp_id` = '".$emp['id']."' and `year` = '$year' and `month` = '$month'");
				if($salary['id'])
				{
					$fixation = 0;
					$checked = " ";
					$generate = "style='color:white; background-color:green; padding:12px'";
				}
				// if(empty($salary) && $salary['post_user_id'] > 0)
				// 	continue;

				$newly_added = getSingleRow("SELECT * FROM `pr_salary` WHERE `emp_id` = '".$emp['id']."' and `year` <= '$year' and `month` <= '$month'");
				if(empty($newly_added))
				{
					$checked = " ";
					$generate = "style='color:white; background-color:gray; padding:12px'";
					$is_generated = getSingleRow("SELECT * FROM `pr_salary` WHERE `year` = '$year' and `month` = '$month' `post_user_id` > 0");
					// if(empty($is_generated))
					// 	continue;
				}
				$sno++;
				?>
				<tr <?php echo $generate ?>>
					<?php
					$banks = getSingleRow("SELECT * FROM kiusc_banks WHERE id = '$bank_id'");
					$bank_name = $banks['bank_name'];
					?>
					<td><?php echo $sno ?></td>
					<td><?php echo $emp['first_name'] .' '. $emp['last_name']?></td>
					<td><?php echo $emp['fname'] ?></td>
					<td><?php echo $emp['cnic'] ?></td>
					<td><?php echo $emp_designations['designation']?></td>
					<td><?php echo $emp_designations['employment_scale'].' ( '.$emp_designations['pay_scale'].' )'?></td>
					<!-- Conditional cell styling for bank name and account number -->
					<td style="background-color: <?php echo empty($bank_name) ? 'red' : 'inherit'; ?>">
						<?php echo $bank_name ?>
					</td>
					<td style="background-color: <?php echo empty($emp['account_no']) ? 'red' : 'inherit'; ?>">
						<?php echo $emp['account_no'] ?>
					</td>
					<td><?php echo $emp['date_of_joining'] ?></td>
					<td<?php echo $expire ?>><?php echo $emp['service_end_date'] ?></td>
				</tr>
				<?php
			}

			?>
		</table>
		<input type="submit" name="generate" value="Generate" onclick="return confirm('Are sure you want to proceed?')">
	</form>
	<?php
}
?>
<style>
.chzn-drop>ul {
    background-color: white !important;
}

span {
    color: black;
}
</style>
<script language="JavaScript">

$("#select-all").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

</script>