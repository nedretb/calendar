<?php

class Calendar{
    private $day_of_week;
    private $date_info;
    private $num_days;
    private $days_of_week;
    private $month;
    private $year;

    public function __construct($month, $year, $days_of_week = array('Nedjelja', 'Ponedjeljak', 'Utorak', 'Srijeda', 'Cetvrtak', 'Petak', 'Subota')){
        $this->month = $month;
        $this->year = $year;
        $this->days_of_week = $days_of_week;
        $this->num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->date_info = getdate(strtotime('first day of', mktime(0,0,0, $this->month, 1, $this->year)));
        $this->day_of_week = $this->date_info['wday'];
    }

    public function show(){
        echo date('L');
        $output = '<table class="calendar">';
        $output .= '<caption>' . $this->date_info['month'] . ' ' . $this->year . '</caption>';
        $output .= '<tr>';

        foreach($this->days_of_week as $day){
            $output .= '<th class="header">' . $day . '</th>';
        }

        $output .= '</tr><tr>';

        if($this->day_of_week > 0){
            $before = $this->day_of_week;
            $before_table =0;
            if($this->date_info['month'] == "May" || $this->date_info['month'] == "July" || $this->date_info['month'] == "October" || $this->date_info['month'] == "December"){
                $before_table = 31 - $this->day_of_week;
            }
            else if($this->date_info['month'] == "April" || $this->date_info['month'] == "June" || $this->date_info['month'] == "September"
            || $this->date_info['month'] == "October" || $this->date_info['month'] == "November" || $this->date_info['month'] == "February" || $this->date_info['month'] == "January"
            || $this->date_info['month'] == "August"){
                $before_table = 32 - $this->day_of_week;
            }
            else if($this->date_info['month'] == "March"){
                if(((($this->year % 4) == 0) && ((($this->year % 100) != 0) || (($this->year % 400) == 0)))){
                    $before_table = 30 - $this->day_of_week;
                }
                else{
                    $before_table = 29 - $this->day_of_week;
                }
            }
            while($before > 0){
                $output .= '<td class="left">' . $before_table . '</td>';
                $before--;
                $before_table++;

            }
        }

        $current_day = 1;

        while($current_day <= $this->num_days){
            if($this->day_of_week == 7){
                $this->day_of_week = 0;
                $output .= '</tr><tr>';
            }

            $output .= '<td class="day">' . $current_day . '</td>';

            $current_day++;
            $this->day_of_week++;
        }

        if($this->day_of_week != 7){
            $days_left = 7 - $this->day_of_week;
            while($days_left != 0){
                $output .= '<td class="left">' .$days_left . '</td>';
                $days_left--;
            }
            
        }

        $output .= '</tr>';
        $output .= '</table>';

        echo $output;
    }
}
?>