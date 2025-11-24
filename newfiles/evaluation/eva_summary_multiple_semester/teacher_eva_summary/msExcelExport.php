


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();

require_once '../../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

include '../../../conn.php';
include "../../../common.php";



$evl_ids = $_REQUEST['evl_id']; // Array of evaluation IDs
$department = $_REQUEST['sel_dep_id'];

// Get department name
$department_name = mysqli_query($conn, "SELECT * FROM kiusc_departments WHERE id = '$department'");
$department_name = mysqli_fetch_assoc($department_name);
$dep_name = $department_name['name'];

// Fetch semester names for headers dynamically and map evl_id => semester name
$semesters = [];
foreach ($evl_ids as $eid) {
    $res = mysqli_query($conn, "SELECT s.sem_name FROM kiusc_evaluation e 
        JOIN kiusc_semesters s ON s.id = e.sem_id 
        WHERE e.id = '$eid'");
    $sem = mysqli_fetch_assoc($res);
    $semesters[$eid] = $sem['sem_name'];
}

// Fetch all active teachers in the selected department
$faculty = mysqli_query($conn, "SELECT first_name, last_name, user_id 
    FROM kiusc_employees 
    WHERE acc_department_id = '$department' AND is_active = 1");

// Pre-fetch course counts per teacher per evaluation ID
$course_counts = [];
while ($fac = mysqli_fetch_assoc($faculty)) {
    $uid = $fac['user_id'];

    foreach ($evl_ids as $sem_eid) {
        // Get semester ID for this evaluation
        $sem_id_res = mysqli_query($conn, "SELECT sem_id FROM kiusc_evaluation WHERE id = '$sem_eid'");
        $sem_id_row = mysqli_fetch_assoc($sem_id_res);
        $sem_id = $sem_id_row['sem_id'];

        // Count courses for this teacher in this semester excluding eva_cat_id=5
        $count_res = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM kiusc_course_offered cf
            WHERE cf.fac_id = '$uid' AND cf.sem_id = '$sem_id' AND cf.eva_cat_id != 5");
        $count_row = mysqli_fetch_assoc($count_res);
        $course_counts[$uid][$sem_eid] = $count_row['cnt'];
    }
}

// Reset faculty result pointer to start fetching again
mysqli_data_seek($faculty, 0);

//$src = '../../../../newfiles/uobs.png';
// <div style="text-align:center; margin-bottom:10px;">
//     <img src="' . $src . '" style="width:100px; height:auto; margin-bottom:10px;">
// </div>

$html = '
<div style="text-align:center; line-height:1.2; margin-bottom:10px;">
    <h2 style="margin: 5px 0; font-size:18px; font-weight:bold;">UNIVERSITY OF BALTISTAN, SKARDU</h2>
    <h3 style="margin: 4px 0; font-size:16px;">Directorate of the Quality Enhancement Cell</h3>
    <h3 style="margin: 4px 0; font-size:16px;">Consolidated Teaching Analysis Report</h3>
    <h4 style="margin: 4px 0; font-size:14px;">Students&#39; Feedback Summary</h4>
    <h2 style="margin: 5px 0; font-size:16px;">Department Name: ' . htmlspecialchars($dep_name) . '</h2>
</div>

<p style="text-align:justify; font-size:14px; line-height:1.6;">
    The Quality Enhancement Cell (QEC), University of Baltistan, Skardu, sincerely acknowledges the dedicated services of all faculty members at the University. Based on the students’ feedback data collected, evaluation reports for the following semesters have been compiled. The summary of the comprehensive teaching proficiency assessment is hereby forwarded for your kind perusal:
</p>
<div style="display: flex; font-size:14px; line-height:1.6; margin-top:10px; gap:40px;">
    <div style="display: flex; gap:15px;">
        <span>EXP: Exceptional (>= 85)</span>
        <span>EXL: Excellent (>= 80 and &lt; 85)</span>
        <span>VG: Very Good (>= 70 and &lt; 80)</span>
    </div>
    <div style="display: flex; gap:15px;">
        <span>G: Good (>= 60 and &lt; 70)</span>
        <span>SF: Satisfactory (>= 50 and &lt; 60)</span>
        <span>NIP: Needs improvement (&lt; 50)</span>
    </div>
</div>


<h3 style="text-align:left;">Teacher Wise Cumulative Evaluation Score:</h3>';

$html .= '<table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse; width: 100%;">';
$html .= '<thead><tr style="background-color:#f2f2f2;">';
$html .= '<th style="text-align:center;">S. No.</th>';
$html .= '<th style="text-align:left;">Teacher Name</th>';

// Dynamically add header columns for each semester (evaluation)
foreach ($evl_ids as $eid) {
    $sem_name = htmlspecialchars($semesters[$eid]);
    $html .= '<th style="text-align:center;">Courses (' . $sem_name . ')</th>';
    $html .= '<th style="text-align:center;">' . $sem_name . ' %</th>';
}

$html .= '<th style="text-align:center;">Cumulative %</th>';
$html .= '<th style="text-align:center;">Remarks</th>';
$html .= '</tr></thead><tbody>';

$serial = 1;

while ($fac = mysqli_fetch_assoc($faculty)) {
    $fac_name = $fac['first_name'] . ' ' . $fac['last_name'];
    $uid = $fac['user_id'];
    $teacher_scores = [];

    // Calculate score for each evaluation
    foreach ($evl_ids as $eid) {
        $courses = mysqli_query($conn, "SELECT cf.id 
            FROM kiusc_course_offered cf
            JOIN kiusc_evaluation e ON cf.sem_id = e.sem_id
            WHERE cf.fac_id = '$uid' 
              AND e.id = '$eid' 
              AND cf.eva_cat_id != 5");

        $total_score = 0;
        $valid_course_count = 0;

        while ($co = mysqli_fetch_assoc($courses)) {
            $category_scores = [];
            $category_questions = [];

            $answers = mysqli_query($conn, "SELECT * 
                FROM kiusc_eval_std es
                JOIN kiusc_eval_questions eq ON es.question_id = eq.id
                JOIN kiusc_eval_ques_category eqc ON eqc.id = eq.cat_id
                WHERE eqc.eval_type_id = 1 AND es.c_offer_id = '" . $co['id'] . "'");

            while ($ans = mysqli_fetch_assoc($answers)) {
                $cat = $ans['shortnmae'];
                $category_scores[$cat] = (isset($category_scores[$cat]) ? $category_scores[$cat] : 0) + $ans['ans'];
                $category_questions[$cat] = (isset($category_questions[$cat]) ? $category_questions[$cat] : 0) + 1;
            }

            if (empty($category_questions)) continue;

            $total_category_percentage = 0;
            foreach ($category_scores as $cat => $score) {
                $total_category_percentage += round(($score / ($category_questions[$cat] * 3)) * 100, 2);
            }

            $total_score += round($total_category_percentage / count($category_scores), 2);
            $valid_course_count++;
        }

        $final_score = $valid_course_count > 0 
            ? round($total_score / $valid_course_count, 2) 
            : null;
        $teacher_scores[$eid] = $final_score;
    }

    // Skip teachers without any valid scores
    $valid_scores = array_filter($teacher_scores, function($s) {
        return $s !== null;
    });
    if (count($valid_scores) == 0) continue;

    $html .= '<tr>';
    $html .= '<td style="text-align:center;">' . $serial++ . '</td>';
    $html .= '<td>' . htmlspecialchars($fac_name) . '</td>';

    // Output courses and scores for each semester (evaluation)
    foreach ($evl_ids as $eid) {
        $total_courses = isset($course_counts[$uid][$eid]) ? $course_counts[$uid][$eid] : 0;
        $score = isset($teacher_scores[$eid]) ? $teacher_scores[$eid] : null;
        $score_display = ($score !== null) ? $score . "%" : "N/A";

        $html .= '<td style="text-align:center;">' . $total_courses . '</td>';
        $html .= '<td style="text-align:center;">' . $score_display . '</td>';
    }

    // Calculate cumulative % as average of available semester scores
    $cumulative_scores = [];
    foreach ($teacher_scores as $score) {
        if ($score !== null) {
            $cumulative_scores[] = $score;
        }
    }

    if (count($cumulative_scores) > 0) {
    $cumulative_avg = round(array_sum($cumulative_scores) / count($cumulative_scores), 2);
    $cumulative_percent = $cumulative_avg . "%";

    // Determine remarks
    if ($cumulative_avg >= 85) {
        $remarks = "EXP";
    } elseif ($cumulative_avg >= 80) {
        $remarks = "EXL";
    } elseif ($cumulative_avg >= 70) {
        $remarks = "VG";
    } elseif ($cumulative_avg >= 60) {
        $remarks = "G";
    } elseif ($cumulative_avg >= 50) {
        $remarks = "SF";
    } else {
        $remarks = "NIP";
    }
        } else {
            $cumulative_percent = "N/A";
            $remarks = "N/A";
        }

        $html .= '<td style="text-align:center;">' . $cumulative_percent . '</td>';
        $html .= '<td style="text-align:center;">' . $remarks . '</td>';

    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Add signature block
$html .= '<br><br><br><br>';
$html .= '<div style="text-align:right; margin-top:60px; font-size:14px;">
    ___________________________<br>
    <strong>Additional Director QEC</strong><br>
    University of Baltistan, Skardu
</div>';


ob_end_clean();

$dompdf = new Dompdf();
$dompdf->set_option('isRemoteEnabled', true);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("$dep_name.pdf", ["Attachment" => true]);

exit;
