<link href="newfiles/hr/faculty_list/css/styles.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<?php

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui/demo/demo.css");

$doc->addScript(JURI::root(true) . "/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root(true) . "/jquery-easyui/jquery.easyui.min.js");
$doc->addScript(JURI::root(true) . "/jquery-easyui/datagrid-filter.js");
//$doc->addScript(JURI::root( true )."/myfiles/students/myScripts.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';

if (checkPermission(JFactory::getUser(), "HRM") == 0) {
    echo "You dont have right to access this page!";
    return;
}
$emp_id = 0;
if (isset($_REQUEST['emp_ids'])) {
    $emp_id = $_REQUEST['emp_ids'];
}

if ($emp_id > 0) {

    $emp = mysqli_query($conn, "SELECT * FROM `kiusc_employees` e join kiusc_designations d on d.id=e.designation_id where e.id='$emp_id'");
    $emp = mysqli_fetch_assoc($emp);
    ?>
	<style>
		#leftmenu:hover
		{
			background-color: #e5e5e5 !important;
		}
	</style>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
		<div class="border-end bg-white" id="sidebar-wrapper">
			<div class="sidebar-heading border-bottom bg-light">Resume</div>
			<div class="list-group list-group-flush">
				<input type="button" class="list-group-item list-group-item-action list-group-item-light p-3" onclick="smoothScroll(document.getElementById('second'))" value="Designations" style="color: #0d6efd; font-weight: bold; background-color: aliceblue;" id="leftmenu"/>
				<input type="button" class="list-group-item list-group-item-action list-group-item-light p-3" onclick="smoothScroll(document.getElementById('third'))" value="Education" style="color: #0d6efd; font-weight: bold; background-color: aliceblue;" id="leftmenu"/>
			</div>
		</div>
				<!-- Page content wrapper-->
		<div id="page-content-wrapper">
				<!-- Top navigation-->
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<div class="container-fluid">
					<button class="btn btn-primary glyphicon glyphicon-list" id="sidebarToggle"></button>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<h2>Personal Information</h2>
					</div>
				</div>
			</nav>

				<!-- Page content-->
			<div class="container">
					<div class="team-single">
						<div class="row justify-content-center">
							<div class="col-lg-4 col-md-5 xs-margin-30px-bottom">
								<div class="team-single-img">
									<img src="<?php echo ($emp['picture'] != "") ? 'newfiles/hr/pictures/' . $emp['picture'] : 'newfiles/jobs/pictures/pic.jpg'; ?>" alt="" class="img-thumbnail mx-auto d-block rounded-circle" width="150px" height="150px">
								</div>
								<div class="bg-light-gray padding-30px-all md-padding-25px-all sm-padding-20px-all text-center">
									<div class="card-body p-1-9 p-xl-5">
										<div class="mb-4" style="margin-bottom: -2.5rem !important;">
										<h3 class="h4 mb-0"><?php echo $emp['first_name'] . ' ' . $emp['last_name'] ?></h3>
										<span class="text-primary"><?php echo $emp['designation'] ?></span>
									</div>
								</div>
										<h5 class="margin-10px-bottom font-size24 md-font-size22 sm-font-size20 font-weight-600 img-fluid my-5"><i class="far fa-envelope me-3 fa-1x amber-text pr-3" aria-hidden="true" style="color: #0d6efd;"></i><?php echo $emp['email'] ?></h5>
										<?php
											$cell2 = "";
												if ($emp['cell_no2'] != null) {
											$cell2 = '/ ' . $emp['cell_no2'];
												}

												?>
										<h5 class="margin-10px-bottom font-size24 md-font-size22 sm-font-size20 font-weight-600 img-fluid my-5"><i class="fas fa-mobile-alt  me-3 fa-1x amber-text pr-3" aria-hidden="true" style="color: #0d6efd;"></i><?php echo $emp['cell_no1'] . $cell2 ?></h5>
										<h5 class="margin-10px-bottom font-size24 md-font-size22 sm-font-size20 font-weight-600 img-fluid my-5"><i class="fas fa-map-marker-alt  me-3 fa-1x amber-text pr-3" aria-hidden="true" style="color: #0d6efd;"></i><?php echo $emp['permanant_address'] ?></h5>
							</div>
						</div>
						<div class="col-lg-8 col-md-7">
							<div class="container">
							
								<dl class="row">
									<dt class="col-sm-3">Father Name</dt>
									<dd class="col-sm-9"><?php echo $emp['fname'] ?></dd>

									<dt class="col-sm-3">CNIC</dt>
									<dd class="col-sm-9"><?php echo $emp['cnic'] ?></dd>

									<dt class="col-sm-3">Passport Number</dt>
									<dd class="col-sm-9"><?php echo $emp['passport_no'] ?></dd>

									<dt class="col-sm-3">Nationality</dt>
									<dd class="col-sm-9"><?php echo $emp['nationality'] ?></dd>

									<dt class="col-sm-3">Current Address</dt>
									<dd class="col-sm-9"><?php echo $emp['current_address'] ?></dd>

									<dt class="col-sm-3">Country</dt>
									<dd class="col-sm-9"><?php echo $emp['country'] ?></dd>

									<dt class="col-sm-3">District</dt>
									<dd class="col-sm-9"><?php echo $emp['district'] ?></dd>

									<dt class="col-sm-3">Tehsil</dt>
									<dd class="col-sm-9"><?php echo $emp['tehsil'] ?></dd>

									<dt class="col-sm-3">City or Town</dt>
									<dd class="col-sm-9"><?php echo $emp['city_town'] ?></dd>

									<dt class="col-sm-3">Gender</dt>
									<dd class="col-sm-9"><?php echo $emp['gender'] ?></dd>

									<dt class="col-sm-3">Marital Status</dt>
									<dd class="col-sm-9"><?php echo $emp['marital_status'] ?></dd>

									<dt class="col-sm-3">Date of Birth</dt>
									<dd class="col-sm-9"><?php echo $emp['dob'] ?></dd>

									<dt class="col-sm-3">Official Email</dt>
									<dd class="col-sm-9"><?php echo $emp['official_email'] ?></dd>
									<?php
									if($emp['acc_department_id'] != 0)
									{
										$depart = mysqli_query($conn, "SELECT * FROM kiusc_departments where id=".$emp['acc_department_id']);
									}
									else
									{
										$depart = mysqli_query($conn, "SELECT * FROM kiusc_admin_departments where id=".$emp['adm_department_id']);
									}
									
									$depart = mysqli_fetch_assoc($depart);
									?>
									<dt class="col-sm-3">Department</dt>
									<dd class="col-sm-9"><?php echo $depart['name'] ?></dd>

									<dt class="col-sm-3">Date of Joining</dt>
									<dd class="col-sm-9"><?php echo $emp['date_of_joining'] ?></dd>

									<dt class="col-sm-3">Service End Date</dt>
									<dd class="col-sm-9"><?php echo $emp['service_end_date'] ?></dd>

									<dt class="col-sm-3">Employement Nature</dt>
									<dd class="col-sm-9"><?php echo $emp['employment_nature'] ?></dd>

									<dt class="col-sm-3">Mode of Employement</dt>
									<dd class="col-sm-9"><?php echo $emp['mode_of_employment'] ?></dd>

									<dt class="col-sm-3">Employement Scale</dt>
									<dd class="col-sm-9"><?php echo $emp['employment_scale'] ?></dd>
								</dl>
							</div>
						</div>

						<div class="col-md-12">

						</div>
					</div>
			</div>
		</div>
		<div id="second">
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<div class="container-fluid">
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<h2>Designations</h2>
					</div>
				</div>
			</nav>
			<table class="table table-hover">
				<thead>
					<tr>
					<th scope="col">#</th>
					<th scope="col">Designation</th>
					<th scope="col">Department Name</th>
					<th scope="col">Date of Joining</th>
					<th scope="col">Service End Date</th>
					<th scope="col">Employement Nature</th>
					<th scope="col">Mode of Employement</th>
					<th scope="col">Employement Scale</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i=1;
				$emp_desgs = mysqli_query($conn, "SELECT * FROM `kiusc_emp_designations` ed join kiusc_designations d on d.id=ed.designation_id where ed.emp_id='$emp_id'");
				while($emp_desg = mysqli_fetch_assoc($emp_desgs))
				{
				?>
					<tr>
					<th scope="row"><?php echo $i ?></th>
					<td><?php echo $emp_desg['designation'] ?></td>
					<?php
					if($emp_desg['acc_department_id'] != 0)
					{
						$depart = mysqli_query($conn, "SELECT * FROM kiusc_departments where id=".$emp_desg['acc_department_id']);
					}
					else
					{
						$depart = mysqli_query($conn, "SELECT * FROM kiusc_admin_departments where id=".$emp_desg['adm_department_id']);
					}
					
					$depart = mysqli_fetch_assoc($depart);
					?>
					<td><?php echo $depart['name'] ?></td>
					<td><?php echo $emp_desg['date_of_joining'] ?></td>
					<td><?php echo $emp_desg['service_end_date'] ?></td>
					<td><?php echo $emp_desg['employment_nature'] ?></td>
					<td><?php echo $emp_desg['mode_of_employment'] ?></td>
					<td><?php echo $emp_desg['employment_scale'] ?></td>
					</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
		</div>
		<div id="third">
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<div class="container-fluid">
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<h2>Education</h2>
					</div>
				</div>
			</nav>
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Degree Name</th>
						<th scope="col">Title</th>
						<th scope="col">Year of Passing</th>
						<th scope="col">Institute</th>
						<th scope="col">Institute Country</th>
						<th scope="col">Examining Institute</th>
						<th scope="col">Examining Institute</th>
						<th scope="col">Transcript #</th>
						<th scope="col">Result Decleration Date</th>
						<th scope="col">Title of Research</th>
						<th scope="col">Discipline</th>
						<th scope="col">Sub Discipline</th>
						<th scope="col">Specialized Area</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i=1;
				$emp_edus = mysqli_query($conn, "SELECT * FROM `kiusc_emp_educations` where emp_id='$emp_id'");
				while($emp_edu = mysqli_fetch_assoc($emp_edus))
				{
				?>
					<tr>
					<th scope="row"><?php echo $i ?></th>
					<td><?php echo $emp_edu['degree_name'] ?></td>
					<td><?php echo $emp_edu['degree_title'] ?></td>
					<td><?php echo $emp_edu['year_of_passing'] ?></td>
					<td><?php echo $emp_edu['institute'] ?></td>
					<td><?php echo $emp_edu['institute_country'] ?></td>
					<td><?php echo $emp_edu['examinig_institue'] ?></td>
					<td><?php echo $emp_edu['examinig_institue_country'] ?></td>
					<td><?php echo $emp_edu['transcript_no'] ?></td>
					<td><?php echo $emp_edu['result_dec_date'] ?></td>
					<td><?php echo $emp_edu['title_of_research'] ?></td>
					<td><?php echo $emp_edu['discipline'] ?></td>
					<td><?php echo $emp_edu['sub_discipline'] ?></td>
					<td><?php echo $emp_edu['specialized_area'] ?></td>
					</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
		</div>
	</div>

<?php
}
?>
<script>
	window.smoothScroll = function(target) {
		var scrollContainer = target;
		do { //find scroll container
			scrollContainer = scrollContainer.parentNode;
			if (!scrollContainer) return;
			scrollContainer.scrollTop += 1;
		} while (scrollContainer.scrollTop == 0);
		
		var targetY = 0;
		do { //find the top of target relatively to the container
			if (target == scrollContainer) break;
			targetY += target.offsetTop;
		} while (target = target.offsetParent);
		
		scroll = function(c, a, b, i) {
			i++; if (i > 30) return;
			c.scrollTop = a + (b - a) / 30 * i;
			setTimeout(function(){ scroll(c, a, b, i); }, 20);
		}
		// start scrolling
		scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
	}
</script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="newfiles/jobs/faculty_list/js/scripts.js"></script>
    </body>
</html>

