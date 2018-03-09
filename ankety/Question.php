<?php

    class Question
    {
        public static function fetch($conn)
        {


            $db = $conn->prepare("SELECT * FROM questions");
            $db->execute();
            $questions = $db->fetchAll();

            //$questions = Database::fetch('SELECT * FROM questions', null, 'ARRAY');
            $i = 0;

            foreach($questions as $q)
            {
                $questions[$i]['qst'] = explode(',', $q['questions']);
                $questions[$i]['vls'] = explode(',', $q['values']);
                $questions[$i]['fin'][0] = $questions[$i]['qst'];
                $questions[$i]['fin'][1] = [];

                foreach($questions[$i]['vls'] as $x)
                    array_push($questions[$i]['fin'][1], $x);

                unset($questions[$i]['questions']);
                unset($questions[$i]['values']);
                unset($questions[$i]['qst']);
                unset($questions[$i]['vls']);
                unset($questions[$i]['0']);
                unset($questions[$i]['1']);
                unset($questions[$i]['2']);
                unset($questions[$i]['3']);

                $i++;
            }

            return $questions;
        }
    }

?>