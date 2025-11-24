<?php

include "../conn.php";

$i = $_REQUEST['rows'];
$re = mysqli_query($conn,"select * from kiusc_degrees");




echo '
<tr>
	 <td>
      <select name="degree_id[]" style="width:140px">
	  			<option value=""> Select Degree </option>';
		while($deg = mysqli_fetch_assoc($re)): 
    		echo '<option value="'. $deg['id']. '" > '. $deg['degree_title'] . ' </option>';
    	endwhile;

echo '</select></td>
        
    <td>  <input type="text" name="institute[]" style="width:160px"/> </td>
    <td>  <input type="text" name="year[]" style="width:60px" /> </td>
    <td> Marks : <input type="radio" name="'.$i.'" id="type_marks'.$i.'" onclick="typeChange(this)" checked="checked"/>
		 GPA:<input type="radio" name="'.$i.'"  id="type_gpa'.$i.'" onclick="typeChange(this)" /> </td>
    <td>  <input type="text" name="obtained_marks[]" style="width:80px" class="'.$i.'" id="obtained_marks'.$i.'" onkeyup="perDivM(this)" /> </td>
    <td>  <input type="text" name="total_marks[]" style="width:80px" class="'.$i.'" id="total_marks'.$i.'" onkeyup="perDivM(this)" />  </td>
    <td>  <input type="text" name="gpa[]" style="width:60px" class="'.$i.'" id="gpa'.$i.'" readonly onkeyup="perDivGPA(this)" />  </td>
    <td>  <input type="text" name="total_gpa[]" style="width:70px" class="'.$i.'" id="total_gpa'.$i.'" readonly onkeyup="perDivGPA(this)" /> </td>
	 <td> <input type="text" name="division[]" id="division'.$i.'" style="width:75px" readonly/> </td>
    <td> <input type="text" name="percentage[]" id="percentage'.$i.'" style="width:80px" readonly/>  </td>
	<td> <input type="button" onclick="deleteRow(this, \'tbl_qual\')" value="Delete" /> </td>
</tr>';

?>