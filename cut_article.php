<?php 
    function cut_article($string, $count) {
        if (strlen($string) > $count) {
            $cutted = substr($string, 0, $count);
            $cutted .= '...';
            return $cutted;
        }
        else {
            return $string;
        }
    }
?>