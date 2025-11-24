<?php 


class Calendar {  

   
     
    /**
     * Constructor
     */
    public function __construct(){     
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }
     
    /********************* PROPERTY ********************/  
    private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
     
    private $currentYear=0;
     
    private $currentMonth=0;
     
    private $currentDay=0;
     
    private $currentDate=null;
     
    private $daysInMonth=0;
     
    private $naviHref= null;
	
	public $hijriYear = 0;
     
    /********************* PUBLIC **********************/  
        
    /**
    * print out the calendar
    */
	
    public function show($conn) {
        
         
		 $year=null;
        if(null==$year&&isset($_GET['year'])){
 
            $year = $_GET['year'];
         
        }else if(null==$year){
 
            $year = date("Y",time());  
         
        }          
         $month=null;
        if(null==$month&&isset($_GET['month'])){
 
            $month = $_GET['month'];
         
        }else if(null==$month){
 
            $month = date("m",time());
         
        }                  
         
        $this->currentYear=$year;
         
        $this->currentMonth=$month;
         
        $this->daysInMonth=$this->_daysInMonth($month,$year);  
         
        $content='<div id="calendar">'.
                        '<div class="box">'.
                        $this->_createNavi($conn).
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label">'.$this->_createLabels().'</ul>';   
                                $content.='<div class="clear"></div>';     
                                $content.='<ul class="dates">';    
                                 
                                $weeksInMonth = $this->_weeksInMonth($month,$year);
                                // Create weeks in a month
                                for( $i=0; $i<$weeksInMonth; $i++ ){
                                     
									
                                    //Create days in a week
                                    for($j=1;$j<=7;$j++){
                                        $content.=$this->_showDay($conn, $i*7+$j);
									   
										
                                    }
									
                                }
                                 
                                $content.='</ul>';
                                 
                                $content.='<div class="clear"></div>';     
             
                        $content.='</div>';
                 
        $content.='</div>';
        return $content;   
    }
     
    /********************* PRIVATE **********************/ 
    /**
    * create the li element for ul
    */
    private function _showDay($conn, $cellNumber){
         
        if($this->currentDay==0){
             
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
                     
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
                 
                $this->currentDay=1;
                 
            }
        }
         
        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
             
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
             //dateToHijri($this->currentDay)
            $islamic = dateToHijri($conn, $this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay));
			$cellContent = $this->currentDay . "<font size='4px' color='red'>(".$islamic['isl_day'].")</font>";
             
			 
            $this->currentDay++;   
             
        }else{
             
            $this->currentDate =null;
 
            $cellContent=null;
        }
             
         
        return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
    }
     
    /**
    * create navigation
    */
    private function _createNavi($conn){
         
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
         
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
         
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
         
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
		
		$islamic = dateToHijri($conn, $this->currentYear.'-'.$this->currentMonth.'-'.'01');
		
		$this->hijriYear = $islamic['isl_year'];
         ///////////////////////////////////////////////////////////
        return
            '<div class="header">'.
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                    '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).' <font color="red">('.$islamic['isl_year'].'</font>'.' <font color="red">'.$islamic['isl_month'].')</font></span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }
         
    /**
    * create calendar week labels
    */
    private function _createLabels(){  
                 
        $content='';
         
        foreach($this->dayLabels as $index=>$label){
             
            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
 
        }
         
        return $content;
    }
     
     
     
    /**
    * calculate number of weeks in a particular month
    */
    private function _weeksInMonth($month=null,$year=null){
         
        if( null==($year) ) {
            $year =  date("Y",time()); 
        }
         
        if(null==($month)) {
            $month = date("m",time());
        }
         
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);
         
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
         
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
         
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
         
        if($monthEndingDay<$monthStartDay){
             
            $numOfweeks++;
         
        }
         
        return $numOfweeks;
    }
 
    /**
    * calculate number of days in a particular month
    */
    private function _daysInMonth($month=null,$year=null){
         
        if(null==($year))
            $year =  date("Y",time()); 
 
        if(null==($month))
            $month = date("m",time());
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }
	
	public function getDaysInMonth($month, $year)
	{
		return $this->_daysInMonth($month,$year);
	}
     
}
function dateToHijri($conn, $date)
{
	$select = "SELECT * FROM `lms_islamic_calander` WHERE date = (select max(date) from lms_islamic_calander where `date`<='$date' and date!='0000-00-00')";
	
	$res = mysqli_query($conn, $select);
	$fdate = mysqli_fetch_array($res);
	
	$islDay=0;
	
	$date = date_create($date);
	$fd = date_create($fdate['date']);
	for($i = $fd; $i<=$date; $i = date_modify($i,"+1 day"))
	{
		$islDay++;
	}
	
	$year = $fdate['hijri_year'];
	$month = $fdate['hijri_month'];
	$month_no = islMonthNametoNo($month);
		
	return array('isl_day'=>$islDay, 'isl_month'=>$month, 'isl_year'=>$year, 'isl_month_no'=>$month_no);
//	$isDArray=array(d=>$islDay,m=>islm, y=isly)
 //    return $isDArray;
}
function hijriToDate($conn, $isl_day, $isl_month_no, $islYear)
{
	$month = islMonthNotoName($isl_month_no);
	$cal = mysqli_query($conn, 'SELECT * FROM `lms_islamic_calander` WHERE `hijri_year` = "'.$islYear.'" and `hijri_month` = "'.$month.'"');
	$cal = mysqli_fetch_assoc($cal);
	
	$first = $cal['date'];
	$first = date_create($first);
	$event_date = date_modify($first, "+" . $isl_day - 1  . " day");
	
	
	return date_format($event_date,'d-m-Y');
	
	
	//return;
}

function islMonthNametoNo($month)
{
	if($month == 'Muharram')
		$month_no = 1;
	else if ($month=='Safar')
		$month_no=2;
	else if ($month=='Rabi al-awwal')
		$month_no=3;
	else if ($month=='Rabi al-thani')
		$month_no=4;
	else if ($month=='Jumada al-awwal')
		$month_no=5;
	else if ($month=='Jumada al-thani')
		$month_no=6;
	else if ($month=='Rajab')
		$month_no=7;
	else if ($month=='Sha\'ban')
		$month_no=8;
	else if ($month=='Ramadan')
		$month_no=9;
	else if ($month=='Shawwal')
		$month_no=10;
	else if ($month=='Dhu al-Qidah')
		$month_no=11;
	else if ($month=='Dhu al-Hijjah')
		$month_no=12;
return $month_no;
}
function islMonthNotoName($month_no)
{
	if($month_no == '1')
		$month = 'Muharram';
	else if ($month_no=='2')
		$month='Safar';
	else if ($month_no=='3')
		$month='Rabi al-awwal';
	else if ($month_no=='4')
		$month='Rabi al-thani';
	else if ($month_no=='5')
		$month='Jumada al-awwal';
	else if ($month_no=='6')
		$month='Jumada al-thani';
	else if ($month_no=='7')
		$month='Rajab';
	else if ($month_no=='8')
		$month='Sha\'ban';
	else if ($month_no=='9')
		$month='Ramadan';
	else if ($month_no=='10')
		$month='Shawwal';
	else if ($month_no=='11')
		$month='Dhu al-Qidah';
	else if ($month_no=='12')
		$month='Dhu al-Hijjah';
	
	return $month;
}
function monthNoToName($month_no)
{
	if($month_no == '1')
		$month = 'January';
	else if ($month_no=='2')
		$month='February';
	else if ($month_no=='3')
		$month='March';
	else if ($month_no=='4')
		$month='April';
	else if ($month_no=='5')
		$month='May';
	else if ($month_no=='6')
		$month='June';
	else if ($month_no=='7')
		$month='July';
	else if ($month_no=='8')
		$month='August';
	else if ($month_no=='9')
		$month='September';
	else if ($month_no=='10')
		$month='October';
	else if ($month_no=='11')
		$month='November';
	else if ($month_no=='12')
		$month='December';
	
	return $month;
}

?>