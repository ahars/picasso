<?php

namespace Picasso\Helpers;

class Date{
    
    public static $days  = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi','Dimanche');
    public static $months    = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    public static function french($datetime){
        $tmstamp = strtotime($datetime); 
        $date = self::$days[date('N',$tmstamp)-1]." ".date('d',$tmstamp).' '.self::$months[date('n',$tmstamp)-1].' '.date('Y',$tmstamp);
        $date .= " à ".date('H:i',$tmstamp); 
        return $date; 
    }

}
