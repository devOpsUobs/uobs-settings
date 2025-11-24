<?php

include "../../conn.php";

$i = $_REQUEST['rows'];
$re = mysqli_query($conn,"select * from kiusc_degrees");




echo '
<tr>
	 <td>
     	<input type="hidden" name="qual_id[]" value="" />
      <select name="degree_id[]" style="width:250px">
	  			<option value=""> Select Degree </option>';
		while($deg = mysqli_fetch_assoc($re)): 
    		echo '<option value="'. $deg['id']. '" > '. $deg['degree_title'] . ' </option>';
    	endwhile;

echo '</select></td>
        
    <td>  <input type="text" name="institute[]" style="width:170px"/> </td>
    <td>  <input type="text" name="year[]" style="width:70px" /> </td>
	 <td>  <input type="text" name="division[]" style="width:70px"/> </td>
    <td> Marks : <input type="radio" name="'.$i.'" id="type_marks'.$i.'" onclick="typeChange(this)" checked="checked"/>
		 GPA:<input type="radio" name="'.$i.'"  id="type_gpa'.$i.'" onclick="typeChange(this)" /> </td>
    <td>  <input type="text" name="obtained_marks[]" style="width:80px" id="obtained_marks'.$i.'" /> </td>
    <td>  <input type="text" name="total_marks[]" style="width:80px" id="total_marks'.$i.'" />  </td>
    <td>  <input type="text" name="gpa[]" style="width:70px" id="gpa'.$i.'" readonly />  </td>
    <td>  <input type="text" name="total_gpa[]" style="width:70px" id="total_gpa'.$i.'" readonly /> </td>
	 <td> <input type="text" name="major_subjects[]" style="width:170px"/> </td>
    <td> <input type="text" name="board[]" style="width:100px" />  </td>
</tr>';

?>