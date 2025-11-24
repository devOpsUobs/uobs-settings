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

// Fetch semester names for headers and identify Spring and Fall 2024 eval IDs
$semesters = [];
$spring_evl_id = null;
$fall_evl_id = null;

foreach ($evl_ids as $eid) {
    $res = mysqli_query($conn, "SELECT s.sem_name FROM kiusc_evaluation e 
        JOIN kiusc_semesters s ON s.id = e.sem_id 
        WHERE e.id = '$eid'");
    $sem = mysqli_fetch_assoc($res);
    $semesters[$eid] = $sem['sem_name'];

    if (stripos($sem['sem_name'], 'spring 2024') !== false) {
        $spring_evl_id = $eid;
    }
    if (stripos($sem['sem_name'], 'fall 2024') !== false) {
        $fall_evl_id = $eid;
    }
}

// Fetch all teachers in the selected department
$faculty = mysqli_query($conn, "SELECT first_name, last_name, user_id 
    FROM kiusc_employees 
    WHERE acc_department_id = '$department' AND is_active = 1");

// Pre-fetch course counts per teacher per semester (Spring and Fall 2024)
$course_counts = []; // [user_id][semester_evl_id] = count

while ($fac = mysqli_fetch_assoc($faculty)) {
    $uid = $fac['user_id'];
    foreach ([$spring_evl_id, $fall_evl_id] as $sem_eid) {
        if ($sem_eid === null) continue;
        // Get semester id from evaluation id
        $sem_id_res = mysqli_query($conn, "SELECT sem_id FROM kiusc_evaluation WHERE id = '$sem_eid'");
        $sem_id_row = mysqli_fetch_assoc($sem_id_res);
        $sem_id = $sem_id_row['sem_id'];

        $count_res = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM kiusc_course_offered cf
            WHERE cf.fac_id = '$uid' AND cf.sem_id = '$sem_id' AND cf.eva_cat_id != 5");
        $count_row = mysqli_fetch_assoc($count_res);
        $course_counts[$uid][$sem_eid] = $count_row['cnt'];
    }
}
// rewind faculty pointer
mysqli_data_seek($faculty, 0);

// Start building HTML
$html = '<h2 style="text-align:center;">Teacher-wise Evaluation Summary</h2>';
$html .= '<table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse; width: 100%;">';
$html .= '<thead><tr style="background-color:#f2f2f2;">';
$html .= '<th style="text-align:center;">S. No.</th>';
$html .= '<th style="text-align:left;">Teacher Name</th>';

// Add Spring 2024 columns if available
if ($spring_evl_id !== null) {
    $spring_sem_name = htmlspecialchars($semesters[$spring_evl_id]);
    $html .= '<th style="text-align:center;">Courses</th>';
    $html .= '<th style="text-align:center;">' . $spring_sem_name . ' %</th>';
}

// Add Fall 2024 columns if available
if ($fall_evl_id !== null) {
    $fall_sem_name = htmlspecialchars($semesters[$fall_evl_id]);
    $html .= '<th style="text-align:center;">Courses</th>';
    $html .= '<th style="text-align:center;">' . $fall_sem_name . ' %</th>';
}

// Add cumulative % column header
$html .= '<th style="text-align:center;">Cumulative %</th>';

$html .= '</tr></thead><tbody>';

$serial = 1;

// Loop faculty again for table body
while ($fac = mysqli_fetch_assoc($faculty)) {
    $fac_name = $fac['first_name'] . ' ' . $fac['last_name'];
    $uid = $fac['user_id'];
    $teacher_scores = [];

    // Calculate scores for all evals, but we only need Spring and Fall 2024 here
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
                $category_scores[$cat] = ($category_scores[$cat] ?? 0) + $ans['ans'];
                $category_questions[$cat] = ($category_questions[$cat] ?? 0) + 1;
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

    // Only show teachers with any score data
    $has_score = count(array_filter($teacher_scores, function($s) { return $s !== null; })) > 0;
    if (!$has_score) {
        continue;
    }

    $html .= '<tr>';
    $html .= '<td style="text-align:center;">' . $serial++ . '</td>';
    $html .= '<td>' . htmlspecialchars($fac_name) . '</td>';

    // Spring 2024 courses and %
    if ($spring_evl_id !== null) {
        $total_courses = $course_counts[$uid][$spring_evl_id] ?? 0;
        $score = $teacher_scores[$spring_evl_id];
        $score_display = ($score !== null) ? $score . "%" : "N/A";

        $html .= '<td style="text-align:center;">' . $total_courses . '</td>';
        $html .= '<td style="text-align:center;">' . $score_display . '</td>';
    }

    // Fall 2024 courses and %
    if ($fall_evl_id !== null) {
        $total_courses = $course_counts[$uid][$fall_evl_id] ?? 0;
        $score = $teacher_scores[$fall_evl_id];
        $score_display = ($score !== null) ? $score . "%" : "N/A";

        $html .= '<td style="text-align:center;">' . $total_courses . '</td>';
        $html .= '<td style="text-align:center;">' . $score_display . '</td>';
    }

    // Calculate cumulative %
    // Weighted average by number of courses, skip semesters with zero courses or null score
    $total_courses_all = 0;
    $weighted_score_sum = 0;

    foreach ([$spring_evl_id, $fall_evl_id] as $sem_eid) {
        if ($sem_eid === null) continue;

        $c = $course_counts[$uid][$sem_eid] ?? 0;
        $s = $teacher_scores[$sem_eid];

        if ($c > 0 && $s !== null) {
            $total_courses_all += $c;
            $weighted_score_sum += $c * $s;
        }
    }

    if ($total_courses_all > 0) {
        $cumulative_percent = round($weighted_score_sum / $total_courses_all, 2) . "%";
    } else {
        $cumulative_percent = "N/A";
    }

    $html .= '<td style="text-align:center;">' . $cumulative_percent . '</td>';

    $html .= '</tr>';
}

$html .= '</tbody></table>';

ob_end_clean();

$dompdf = new Dompdf();
$dompdf->set_option('isRemoteEnabled', true);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("evaluation_matrix_report.pdf", ["Attachment" => false]);

exit;
