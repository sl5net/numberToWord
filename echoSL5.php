<?php
//examples();
function examples()
{
    header('Content-Type: text/html; charset=utf-8');
    if (0) {
        $i = 0;
            echo "$i =";
            $n = new echoSL5($i);
            #print_r($n);
            $n->getDigAt(5);
            $n->speak();
            echo " <br>";
//        exit;
    }
    if (1) {
        for ($i = 9; $i <= 22; $i++) {
            echo "$i =";
            $n = new echoSL5($i);
            #print_r($n);
            $n->speak_utf8();
            echo " <br>";

        }
    }

    if (1) {
        for ($i = 29; $i <= 31; $i++) {
            echo "$i =";
            $n = new echoSL5($i);
            #print_r($n);
            $n->speak();
            echo " <br>";
        }
    }
    if (1) {
        for ($i = 99; $i <= 101; $i++) {
            echo "$i =";
            $n = new echoSL5($i);
            #print_r($n);
            $n->speak();
            echo " <br>";
        }
    }
    if (1) {
        for ($i = 999; $i <= 1001; $i++) {
            echo "$i =";
            $n = new echoSL5($i);
            #print_r($n);
            $n->speak();
            echo " <br>";
        }
    }
    if (0) {
        for ($i = 1109; $i <= 1111; $i++) {
            echo "$i =";
            $n = new echoSL5($i);
            #print_r($n);
            $n->speak();
            echo " <br>";
        }
    }
    if (1) {
        for ($i = 9999; $i <= 10000; $i++) {
            echo "$i =";
            $n = new echoSL5($i);
            #print_r($n);
            $n->speak();
            echo " <br>";
        }
    }
    if (1) {
        for ($i = 99999; $i <= 100000; $i++) {
            echo "$i =";
            $n = new echoSL5($i);
            #print_r($n);
            $n->speak();
            echo " <br>";
        }
    }
    if (1) {
        for ($i = 10101008; $i <= 10101010; $i++) {
            echo "$i =";
            $n = new echoSL5($i);
            #print_r($n);
            $n->speak();
            echo " <br>";
        }
    }

    if (0) {
        gelb(__LINE__, __FILE__, $n->getDigAt(0));
        gelb(__LINE__, __FILE__, $n->getDigAt(1));
        gelb(__LINE__, __FILE__, $n->getDigAt(2));
        gelb(__LINE__, __FILE__, $n->getDigAt(3));
        gelb(__LINE__, __FILE__, $n->getDigAt(4));
    }
}

class echoSL5
{
    private $n_int;
    private $n_str;
    private $n_speak; // result
    private $strlen;
    public function __construct($n_int)
    {
        $this->n_int = $n_int;
        $this->n_str = (string)$n_int;
        $this->strlen = strlen($this->n_str);
        $this->createDigArr();
//        var_export($this->digArr);

    }
    public function int2speaktxt()
    {

    }
    public function createDigArr()
    {
        for ($i = 0; $i < $this->strlen; $i++) {
            @$this->digArr[$i] = $this->getDigAt($i);
        }
    }
    public function getDigAt($p)
    {
        $a = floor($this->n_int / pow(10, $p + 1));
        $b = floor($this->n_int / pow(10, $p));
        return $b - $a * 10;
    }
    public function get_speak()
    {
        $s = '';
        if (floor($this->n_int / pow(10, 6)) > 0) {
            $s .= $this->speak3(9 - 1) . ' MILLIONEN';
        }
        else if (floor($this->n_int / pow(10, 3)) > 0) {
            $s .= $this->speak3(6 - 1) . ' TAUSEN';
        }
        else if ($this->n_int >= 0) {
            $s .= $this->speak3(3 - 1);
        }
        return $s;

    }
    public function get_speak_utf8()
    {
        $text = $this->get_speak();
        iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
        return $text;
    }
    public function speak()
    {
        echo $this->get_speak();

    }
    public function speak_utf8()
    {
        $text = $this->get_speak();
        iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
        echo $text;

    }
    public function speak_simple()
    {
        $s = '';
        for ($i = $this->strlen - 1; $i >= 0; $i--) {
            $s .= $this->speakAt($i);
        }

        return $s;
    }
    public function speak3($p)
    {
        $s = '';
        for ($i = $p; $i > $p - 3; $i--) {
            # hundert is einfach
            if (($i - 2) % 3 == 0) {
                $s1 = (@$this->digArr[$i] > 0) ? $this->speakAt($i, 3) . ' hundert ' : '';
            } else {
                if (($i - 1) % 2 == 0 && (@$this->digArr[$p - 3] > 0 || @$this->digArr[$p - 1] > 0)) {
                    $und = (@$this->digArr[$p - 2] > 0 && $i < $p - 2) ? 'und' : '';
                    if (@$this->digArr[$i] > 1) {
                        $s2 = $und . $this->speakAt($i, 2) . ((@$this->digArr[$i] == 3) ? 'sig' : 'zig');
                    } else {
                        if (@$this->digArr[$i] > 0 && @$this->digArr[$p] > 0) {
                            $s2 = $this->speakAt($i, 4) . '';
                        } else {
                            if (@$this->digArr[$p - 2] == 0) {
                                $s2 = '';
                            }
                        }
                    }
                } else {
                    if (true) {
                        if (@$this->digArr[$i] > 0) {
                            $s3 = $this->speakAt($i) . '';
                        } else {
                            $s3 = '';
                        }
                    }
                }
            }
            $dig12 = @$this->digArr[$p - 1] * 10 + @$this->digArr[$p - 2];
//            rot(__LINE__,__FILE__,$dig12 ,'');
            if($dig12==0 AND $this->strlen==1){
                $s3 = '';
                $s2 = $this->speakAt(0);
            }else
            if ($dig12 >= 10 && $dig12 <= 19) {
                $s3 = '';
                if ($dig12 == 12) {
                    $s2 = 'zwölf';
                }else
                if ($dig12 == 11) {
                    $s2 = 'elf';
                }else
                if ($dig12 == 10) {
                    $s2 = 'zehn';
                }else
                {
                    $s2 = $this->speak3(1) ;
                }
            }

            $s = @"$s1$s3$s2";
        }

        return $s;
    }
    private function speakAt($p, $norm = 1)
    {
        $s = array();
        #if($norm==1)
        $s = array(
            0 => "null",
            1 => "eins",
            2 => "zwei",
            3 => "drei",
            4 => "vier",
            5 => "fünf",
            6 => "sechs",
            7 => "sieben",
            8 => "acht",
            9 => "neun",
            10 => "zehn"
        );
//        gelb(__LINE__, __FILE__, $norm);
        if ($norm == 2) {
            $s[1] = ">ein<";
            $s[2] = "zwan";
            $s[10] = "einhundert";
        } else {
            if ($norm == 4) {
                $s[1] = "zehn";
                $s[2] = "zwan";
                $s[10] = "einhundert";
            } else {
                if ($norm == 3) {
                    $s[1] = "ein";
                }
            }
        }
//        if(!$this->getDigAt($p))return $s[0];
        return $s[$this->getDigAt($p)];
        switch ($p) {
            case 0:
                return $s[$this->getDigAt($p)];
        }
        #echo $this->getMillion().' Million ' . $this->getThousand() . ' Thousand '.$this->getHundred(). ' Hundred and '. $this->getTen().$this->getOne();
    }
}

//exit;

############################################################
############################## Erster Versuch ab hier.
############################################################

//for ($i = 1; $i <= 80; $i++) {
//    echo convertNumber2germanLongText($i) . '<br>';
//}


#rot(__LINE__,__FILE__,$number2germanLongText_OneDigit[0],'x');

function convertNumber2germanLongText($nummerINT)
{
    $n = new echoSL5($nummerINT);
    $text = $n->get_speak_utf8();

    return $text;

    $bugit = false;

    $number2germanLongText_1Digit = array(
        '0' => "null",
        '1' => "eins",
        '2' => "zwei",
        '3' => "drei",
        '4' => "vier",
        '5' => "f�nf",
        '6' => "sechs",
        '7' => "sieben",
        '8' => "acht",
        '9' => "neun",
        '10' => "zehn"
    );


    $germanLongText = $nummerINT;
    echo '<hr>';
    #echo length("Test");
    # Knapp daneben. StringLength war es nicht. strlen ist richtig. 09-05-07_11-26

    $nummerINT_len = strlen($nummerINT);
    $nummerINT_str = "" . $nummerINT . "";
    #blau($fromline.'�'.__line__,__FILE__, array(('$nummerINT_str')=>$nummerINT_str) );

    preg_match_all("/\d/", $nummerINT_str, $aPreTemp);
    if (!$aPreTemp) {
        rot($fromline . '�' . __line__, __FILE__, "", 'x');
    }


    # das Array von redundanten Informationen befreien.
    $a = array_reverse($aPreTemp[0]);
    $count_a = count($a);

    # Array in dem diese Ergebnisse abgelegt werden sollen. Sp�ter werden diese Einzelergebnisse wieder zusammengesetzt.
    $at = $a;

    #blau($fromline.'�'.__line__,__FILE__, array( '$a'=>$a, '$at'=>$at) );

    $notaus = 10;
    for ($i = 0; $i < $count_a; $i += 2) {
        if ($notaus-- < 0 || !count($a) || !count($at[$i])) {
            rot($fromline . '�' . __line__, __FILE__, "\$notaus=$notaus", 'x');
        }

        $at[$i] = $number2germanLongText_1Digit[$a[$i]];
        if ($bugit) {
            gelb($fromline . '�' . __line__, __FILE__, '$at[$i]=' . $at[$i]);
            gelb($fromline . '�' . __line__, __FILE__, '$a[$i]=' . $a[$i]);
        }

        $number2germanLongText_2Digit = $number2germanLongText_1Digit;
        $number2germanLongText_2Digit['1'] = "zehn";
        $number2germanLongText_2Digit['2'] = "zwan";
        $number2germanLongText_2Digit['10'] = "einhundert";

        $number2germanLongText_3Digit = $number2germanLongText_1Digit;
        #$number2germanLongText_3Digit['1'] = "zehn"; $number2germanLongText_2Digit['2'] = "zwan"; $number2germanLongText_2Digit['10'] = "einhundert";

        for ($ii = 2; $ii <= 9; $ii++) {
            if ($ii == 3) {
                $z = 'und' . $number2germanLongText_1Digit[$ii] . 'sig';
            }
            if ($ii >= 4 || $ii == 2) {
                $z = 'und' . $number2germanLongText_1Digit[$ii] . 'zig';
            }
            $number2germanLongText_2Digit[$ii] .= $z;

            #$number2germanLongText_3Digit[$ii] .= 'hundert';
        }


        # Jetzt Ausnahmen behandeln:
        # Die 0 wird nur geschrieben, wenn die Zahl wirklich genau gleich Null ist.
        if ($a[$i] == '0') {
            # den Fall null behandeln:
            if ($i > 0) {
                $at[$i] = '';
            }

        }


        # Zahlen wie: 10 11 12 behandeln.
        #gelb($fromline.'�'.__line__,__FILE__, $at[$i].'=$at[$i]='.$at[$i] );
        $two = $a[$i + 1] . $a[$i];
        if ($bugit) {
            gelb($fromline . '�' . __line__, __FILE__, '$two=' . $two);
        }
        if ($i == 2 && $a[$i + 1] == 1 && $a[$i] >= 0 && $a[$i] <= 2) {
            $at[$i] = '';
            if ($two == 10) {
                $at[$i + 1] = 'zehn';
            }
            if ($two == 11) {
                $at[$i + 1] = 'elf';
            }
            if ($two == 12) {
                $at[$i + 1] = 'zw�lf';
            }
        } else {




            # Zahlen wie: 13 14 ... 19 20 behandeln:

            # die beiden Zahlen tauschten:
            #$t1 = $at[$i];			$t2 = $at[$i+1];
            #$at[$i] = $t2; 			$at[$i+1] = $t1;

            $at[$i + 1] = ''; # die Zehner stellen schreibe ich von Hand.
            #if($a[$i+1] == 1){
            #gelb($fromline.'�'.__line__,__FILE__, $i );
            $at[$i] .= $number2germanLongText_2Digit[$a[$i + 1]];

            if ($a[$i] == 0) {
                $at[$i] = str_replace('nullund', '', $at[$i]);
            }

        }

        #blau($fromline.'�'.__line__,__FILE__, " ergebnis = ". implode('',$at) );

    }

    return implode('', $at);


}


function my_exit()
{
    ob_end_flush();
    exit;
    # ob_end_flush --  Leert (schickt/sendet) den Ausgabe-Puffer und deaktiviert die Ausgabe-Pufferung
}

function js_alert($zeile = '', $file = '', $text = '', $code = 'h')
{
    $text = str_replace("'", "\'", $text);
    if (!preg_match('/h/', $code)) {
        # HTML- Tags werden drin gelassen.
        $temp = '/([^\\\\])<[^<>]*?>/si';
        $text = str_replace("\n", '\\n', preg_replace($temp, "$1", $text));
    }
    $text = preg_replace("/<br>/is", '\\n', $text);
    $text = preg_replace("/<\/?(b|p|hr)>/is", '', $text);
    $file_kurz = preg_replace("-.*[\\\\/]-is", '', $file);
    if (preg_match('/n/', $code)) {
        # Die Zeilen werden durchnummeriert.
        $code .= 'p';
        $temp = explode("\n", $text);
        $count = count($temp);
        $l = strlen($count);
        for ($i = 0; $i < $count; $i++) {
            $ii = $i + 1;
            while (strlen($ii) < $l) {
                $ii = '0' . $ii;
            }
            if ($temp[$i]) {
                $temp[$i] = $ii . ":" . $temp[$i];
            }
        }
        $text = implode("\n", $temp);
    }
    if (preg_match('/p/', $code)) {
        $text = preg_replace("/[\r\f\n\t]/", '\\n', $text);
    } else {
        $text = preg_replace("/[\r\f\n\t]/", ' ', $text);
    }
    if (preg_match('/e/', $code)) {
        #$text = htmlentities($text);
    }
    if (is_int($zeile)) {
        $zeile = 'Zeile = ' . $zeile;
    }
    if (preg_match('/r/', $code)) {
        # r steht f?r return
        return array(
            "<script language='JavaScript'>",
            "alert( '$zeile $file_kurz" . '\\n' . "$text');",
            "</script>"
        );
    } else {
        echo "<script language='JavaScript'>
	alert( '$zeile $file_kurz" . '\\n' . "$text');
	</script>";
    }
}

#blau($fromline.'?'.__line__,__FILE__, '???????????' , 'j'  );
#gelb($fromline.'?'.__line__,__FILE__, '???????????' , 'j'  );
function farbtabelle($zeile, $file, $text, $code, $farbe, $wort_bgcolor_ar, $width = '100%')
{
    # n - Zeilennummerierung
    # e - htmlentities
    # p - pre
    # f - textarea
    # j - jump
    # v - var_export
    # x - exit
    #echo "<h2>$code=\$code</h2>" ;
    global $SERVER_NAME;
    if ($SERVER_NAME != 'localhost') {
        unset($file);
    }
    $file_kurz = preg_replace("-.*[\\\\/]-is", '', $file);

    unset($rows1, $rows2);

    if (is_array($text) || is_object($text)) {
        $text = var_export($text, true);
        $is_php = true;
    } else {
        $is_php = (strpos($text, '?' . '>'));
    }
    if (preg_match('/h/', $code)) {
        preg_match_all('/\n/', $text, $e);
        $rows1 = count($e[0]);
        if (substr(phpversion(), 0, 1) > 4) {
            $text = highlight_string($text, true);
        }
        #echo "$rows1 != $rows2";
    }
    if (preg_match('/n/', $code)) {
        if (preg_match('/h/', $code)) {
            $text = preg_replace('/<br(\s\/)?' . '>/is', "\n", trim($text));
            preg_match_all('/\n/', $text, $e);
            $rows2 = count($e[0]);
            # && eregi('h',$code)
        }
        $offset = ($rows1 != $rows2) ? -1 : 0;

        # Die Zeilen werden durchnummeriert.
        $code .= 'p';
        $temp = explode("\n", $text);
        $count = count($temp);
        $l = strlen($count);
        for ($i = 0; $i < $count; $i++) {
            if (!$ii = $i + 1 + $offset) {
                continue;
            }
            while (strlen($ii) < $l) {
                $ii = '0' . $ii;
            }
            if ($temp[$i]) {
                $temp[$i] = $ii . ":" . $temp[$i];
            }
        }
        $text = implode("\n", $temp);
    }
    if (preg_match('/p/', $code)) {
        $pre1 = '<pre>';
        $pre2 = '</pre>';
    }
    if (preg_match('/f/', $code)) {
        $colsMax = get_colsMax($text);
        $pre1 = '<textarea cols="'.$colsMax.'" rows="5">';
        $pre2 = '</textarea>';
    } elseif ($is_php) {
        $text = str_replace(array('&lt;?', '?&gt;'), '', highlight_string('<?' . $text . '?>', true));
    }
    if (preg_match('/e/', $code)) {
        $text = htmlentities($text);
    }
    if (is_array($wort_bgcolor_ar)) {
        # die schl?ssel sind gleichzeitig die Strings die mit der Hintergrundfarbe der zugeh?rigen Werte ersetzt werden.
        while (list($string, $bgcolor) = each($wort_bgcolor_ar)) {
            $text = str_replace(
                $string,
                '<span style="border: 1px solid #BEBEBE; background-color:' . $bgcolor . '">' . $string . '</span>',
                $text
            );
        }
    }

    if (preg_match('/b/', $code)) {
        $text = str_replace(array('  ', "\n"), array('&nbsp; ', "<br>\n"), $text);
    }

    # beschreibt die dicke des Tabellenrandes
    $tbl_border = (preg_match("/\d+/", $code, $digit)) ? $digit[0] : 1;

    #echo "$code , $farbe";
    if (is_int($zeile)) {
        $zeile = 'Zeile = ' . $zeile;
    }
    $strlen_status = strlen($zeile . $file_kurz);
    $strlen_text = strlen($text);
    $status_zeile = '<td valign="top" bgcolor="#FFFFFF" nowrap><font color="Black"><font size="-1">' . $zeile .
        '<br><font size="-2"><a href="' . $file . '" target="o">' . $file_kurz . '</a></font></font></td>';
    $text_zeile = '<td bgcolor="#' . $farbe . '" width="' . $width . '"><font color="Black">' . $pre1 . $text . $pre2 . '</font></td>';
    echo '<table border="' . $tbl_border . '" cellspacing="0" cellpadding="0" width="' . $width . '"><tr>';
    if ($strlen_status * 12 > $strlen_text) {
        echo $status_zeile . $text_zeile;
    } else {
        echo $status_zeile . '</tr><tr>' . $text_zeile;
    }
    echo '</tr></table>';
    if (preg_match('/x/', $code)) {
        echo "<b> - E <u>X</u> I T - </b>";
        my_exit();
    }
    if (preg_match('/j/', $code)) {
        # es soll gleich zu dieser meldung gesprungen werden.
        #echo '</tr><tr><td>';
        $name = 'f' . mktime();
        echo '<form name="' . $name . '">' .
            '<input type="Button" style="font-size: 9px; color: black; border: 0px White; background: White;" name="' . $name . '" value="Jump"></form>' .
            '<script language="JavaScript">
         document.forms["' . $name . '"].elements["' . $name . '"].focus();
         </script>';
        #echo '</td>';
    }
}

/**
 * @return int
 */
function get_colsMax(&$t)
{
    $colsMax = 88;
    return $colsMax;
//    for ($i = 1; $i <= 5; $i++) {
//        if(strlen($colsMax[i]))
//    }
}

function weis($zeile, $file, $text, $code = '', $c = false, $wort_bgcolor_ar = false)
{
    if (!$c) {
        $c = 'ffffff';
    }
    farbtabelle($zeile, $file, $text, $code, $c, $wort_bgcolor_ar);
}

function blau($zeile, $file, $text, $code = '', $c = false, $wort_bgcolor_ar = false)
{
    if (!$c) {
        $c = '66CCFF';
    }
    farbtabelle($zeile, $file, $text, $code, $c, $wort_bgcolor_ar);
}

function rot($zeile, $file, $text, $code = '', $c = false, $wort_bgcolor_ar = false)
{
    if (!$c) {
        $c = 'FFCC99';
    }
    farbtabelle($zeile, $file, $text, $code, $c, $wort_bgcolor_ar);
}

function BIG_gelb($zeile, $file, $text, $code = '', $c = false, $wort_bgcolor_ar = false)
{
    if (!$c) {
        $c = 'FFFFCC';
    }
    farbtabelle($zeile, $file, $text, $code, $c, $wort_bgcolor_ar);
}

function gelb($zeile, $file, $text, $code = '', $c = false, $wort_bgcolor_ar = false)
{
    if (!$c) {
        $c = 'FFFFCC';
    }
    farbtabelle($zeile, $file, $text, $code, $c, $wort_bgcolor_ar);
}

function green($zeile, $file, $text, $code = '', $c = false, $wort_bgcolor_ar = false)
{
    if (!$c) {
        $c = '32CD32';
    }
    farbtabelle($zeile, $file, $text, $code, $c, $wort_bgcolor_ar);
}

function pink($zeile, $file, $text, $code = '', $c = false, $wort_bgcolor_ar = false)
{
    if (!$c) {
        $c = 'FFB6C1';
    }
    farbtabelle($zeile, $file, $text, $code, $c, $wort_bgcolor_ar);
}

#   /gelb\(\s*\$fromline\.'�'\.__line__\s*,\s*__FILE__\s*,\s*/is
# mit
# 	\\1($fromline.'�'.__line__,__FILE__, \\2
#   /(?:gelb|weis|blau|BIG_gelb|rot)\(\s+\$fromline\.'�'\.__line__\s*,\s*/is
# mit
# 	\\1($fromline.'�'.__line__,__FILE__, \\2

# Ersetze
#   /(gelb|weis|blau|BIG_gelb|rot)\(\s*\$fromline\.'�'\.__line__\s*,\s*([^_])/is
#   /(gelb|weis|blau|BIG_gelb|rot)\(\s*(?:\$fromline)?\.'�'\.__line__\s*,\s*([^_])/is
# mit
# 	\\1($fromline.'�'.__line__,__FILE__, \\2

#   /(?:gelb|weis|blau|BIG_gelb|rot)\(\s+__line__\s*,\s*/is
# mit
# 	\\1($fromline.'�'.__line__,__FILE__, \\2
//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
function html_email($nach, $subject, $inhalt, $from = '')
{
    global $SERVER_NAME;
    if (!$nach || (!$subject && !$inhalt)) {
        global $config;
        $nach_temp = ($from) ? $from : @$config[diverses][programmer_email];
        text_email(
            $nach_temp,
            'Es wurden nicht alle Parameter an Function html_email �bergeben.',
            "\$nach=$nach\n\n subject=\n" . $subject . "\n\n" . "\n inhalt=\n\n" . $inhalt . "\n from=\n" . $from,
            'info@l-cip.com'
        );
    }
    if (!$from) {
        $from = $SERVER_NAME;
    }
    if (!$nach) {
        global $config;
        $nach = @$config[diverses][programmer_email];
    }
    @mail(
        $nach,
        $SERVER_NAME . ' | ' . $subject,
        $inhalt,
        "from: " . $from . "\n" .
        "Content-Type: text/html\nContent-Transfer-Encoding: 8bit\n" .
        "X-Mailer: PHP " . phpversion()
    );
}

function text_email($nach, $subject = '', $inhalt = '', $from = '')
{
    global $SERVER_NAME;
    if (!$nach || (!$subject && !$inhalt)) {
        text_email(
            $nach,
            'Es wurden nicht alle Parameter an Function html_email �bergeben.',
            "subject=\n" . $subject . "\n\n" . "\n inhalt=\n\n" . $inhalt . "\n from=\n" . $from,
            'info@l-cip.com'
        );
    }
    if (!$from) {
        $from = $SERVER_NAME;
    }
    if (!$nach) {
        global $config;
        $nach = @$config[diverses][programmer_email];
    }
    # Entferne Tags
    $inhalt = preg_replace("/<br>/i", "\n", $inhalt);
    $inhalt = preg_replace("/<[^>]+>/", '', $inhalt);
    $inhalt .= "\n\n** P.S.: In diesem Text wurden alle HTML-Tags entfernt. Und der <br> Tag in einen Zeilenumbruch umgewandelt.\nAll dies der besseren Lesbarkeit wegen.**";
    @mail(
        $nach,
        $SERVER_NAME . ' | ' . $subject,
        $inhalt,
        "from: " . $from . "\n" .
        "MIME-Version: 1.0\n" .
        "Content-Type: text/plain;
 charset=\"iso-8859-1\"\n" .
        "Content-Transfer-Encoding: 7bit\n" .
        "X-Mailer: PHP " . phpversion()
    );
}

# Funktionen zum Logfile
function addtolog($fromline, $string)
{
    global $hLog;
    if (!$hLog) {
        rot(
            "",
            "function addtolog : \$hLog=$hLog. File- Handle existiert nicht. Aufruf aus: " . $fromline . ". \$string=$string. EXIT",
            ''
        );
        my_exit();
    }
    $hell1 = explode(' ', "c d e f");
    $dark1 = explode(' ', "0 1 2 3");
    $dark2 = $hell2 = array();
    for ($i = 0;
         $i < 256;
         $i += count($hell1)) {
        for ($k = 0;
             $k < count($hell1);
             $k++) {
            $hell2[] = $hell1[$k];
            $dark2[] = $dark1[$k];
        }
    }
    for ($i = 0;
         $i < 6;
         $i++) {
        $z[$i] = ord(substr($string, $i, 1));
        $bgcolor .= $hell2[$z[$i]];
        $color .= $dark2[$z[$i]];
    }
    # ord ('Z') = 90    # ord ('z') = 122   # ord ('a') = 97   # ord ('A') = 65
    $temp = "<table border=0 cellspacing=0 cellpadding=0 bgcolor='#" . $bgcolor .
        "' width='100%'><tr><td><b> Zeile: " . $fromline . "</b><span style='color:#$color'> " . $string . "</span></td></tr></table>";
    fwrite($hLog, $temp);
    #js_alert( $fromline.'�'.__line__ , "\$hLog=$hLog , $temp" , 'e' );
}

function debug($fromline, $string)
{
    global $debugging_flag, $hLog;
    if (!$debugging_flag || !$hLog) {
        return;
    } else {
        addtolog($fromline, $string);
    }
}

function dubious($fromline, $string)
{
    global $dubious_flag, $hLog;
    if (!$dubious_flag || !$hLog) {
        return;
    } else {
        addtolog($fromline, '<b>dubious event: </b> ' . htmlentities($string));
    }
    #js_alert( $fromline.'�'.__line__ , "\$fromline=$fromline , \$dubious_flag=$dubious_flag , \$string=$string" , 'e' );
}

function error($fromline, $file__, $string, $code = 'e')
{
    global $hLog, $fLogName, $PublicRootScript, $SERVER_NAME, $config;
    if ($hLog) {
        addtolog($fromline, '<b>error: </b> ' . $string);
        if ($SERVER_NAME == 'localhost' || $SERVER_NAME == 'logdata.go2000.de') {
            #echo "<h2>$code=\$code</h2>" ;
            rot($fromline . '  <b>error: </b>', $file__, nl2br($string), $code);
        }
        $file = $PublicRootScript . "/count_error_mail.txt";
        if (!$countELog = @fopen($file, "a+")) {
            echo "PHP-Script-Fehler : $file kann nicht erstellt oder ge�ffnet werden.";
        }
        $send_obergrenze = 1000;
        $mails = fgets($countELog, $send_obergrenze + 10);
        $nr_weekday = date("w", time());
        if (substr($mails, 0, 1) != $nr_weekday) {
            # Leere file, weil ein neuer Tag begonnen hat
            if (!$temp_ELog = @fopen($file, "w")) {
                echo "PHP-Script-Fehler : $file kann nicht erstellt oder ge�ffnet werden.";
            }
            @fwrite($temp_ELog, '');
            @fclose($temp_ELog);
        }
        $summails = strlen($mails);
        if ($countELog && $summails <= $send_obergrenze) {
            # Noch nicht mehr als $send_obergrenze error email versandt.
            if ($summails == $send_obergrenze) {
                $message = "Jetzt $send_obergrenze Error-Emails in $file gez�hlt. Es werden keine mehr versandt.";
                error($fromline . '�' . __line__, "$message");
            }
            # Speichere nummerische Darstellung des Wochentages . Sonntage = 0. ( date("w",time())  )
            # Wichtig ist halt das es einstellig ist, da die Stellen die Summe der Eintr�ge sp�ter ausmachen.
            fwrite($countELog, $nr_weekday);
            @fclose($countELog);
            if (!@$config[diverses][programmer_email]) {
                @$config[diverses][programmer_email] = 'lauffer@sl5.de';
            }
        }
        text_email(
            "@$config[diverses][programmer_email] ( Programmer )",
            "PHP-Script-Fehler (" . date("d.M.Y H:i:s", time()) . ' Uhr' . "): $fLogName",
            $fromline . ':<b>error:</b> ' . $string . '<br>',
            "@$config[diverses][programmer_email] ( Logfile )"
        );
        if ($SERVER_NAME == 'localhost') {
            gelb($fromline . '�' . __line__, $file__, "@$config[diverses][programmer_email] ( Programmer )", 'e');
        }
    }
}

global $GLOBAL;

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
function error_fdb($pre_addy_text = '', $id = false, $addy_text = '', $php_at_end = '', $str_replace_array = false)
{
    # Gibt Fehlermeldungen aus, welche in /dope/dope/file_db/data/dope_error_text.tbl.php niedergelegt sind.1
    # Wird Text �bergeben, aber keine $id wird nur der �bergebene Text ausgegeben.
    global $PublicRootScript, $GLOBAL;
    #global $GLOBAL ;
    if (!isset($GLOBAL[dope_error_text][text])) {
        #global $PublicRootScript , $GLOBAL ;
        require_once($PublicRootScript . '/dope/dope/file_db/data/dope_error_text.tbl.php');
        $GLOBAL[dope_error_text][text] = &$D;
    }
    if (!$pre_addy_text && !$id && !$addy_text) {
        $id = 1;
    }
    if ($id && !$GLOBAL[dope_error_text][lang]) {
        $GLOBAL[dope_error_text][lang] = 'german';
    }
    $lang = &$GLOBAL[dope_error_text][lang];
    $text = (isset($str_replace_array[0]) && isset ($str_replace_array[1]))
        ? str_replace(
            $str_replace_array[0],
            $str_replace_array[1],
            $pre_addy_text . $GLOBAL[dope_error_text][text][$id][$lang] . $addy_text
        )
        : $pre_addy_text . $GLOBAL[dope_error_text][text][$id][$lang] . $addy_text;

    # Am Ende klein die ID, damit man glech weis zu welchem Datensatz der Text geh�rt.
    if ($id) {
        $text .= '<font size=-2 color="#C0C0C0">(' . $id . ')</font>';
    }

    #gelb($fromline.'�'.__line__,$file__,array('$GLOBAL'=>$GLOBAL,'$D'=>$D) );
    #blau($fromline.'�'.__line__,$file__,array('$text'=>$text , '$str_replace_array'=>$str_replace_array ) );
    if (strtolower($php_at_end) == 'return') {
        return $text;
    }
    #gelb($fromline.'�'.__line__,$file__,array('$text'=>$text , '$php_at_end'=>$php_at_end, '$str_replace_array'=>$str_replace_array ) );

    $temp = $PublicRootScript . '/dope/dope/error-to-webbrowser.htm';
    $echoerror = @implode('', file($temp));
    if ($echoerror) {
        $echoerror = str_replace('[error_text]', $text, $echoerror);
    } else {
        gelb($fromline . '�' . __line__, __FILE__, "Template $temp konnte nicht gefunden werden.", '');
        $echoerror = $text;
    }
    echo $echoerror;
    rot($fromline . '�' . __line__, __FILE__, $text);
    #error( $fromline.'�'.__line__,__FILE__, $text );
}

// Logfile aufmachen
if (@$config[diverses][log_flag]) {
    $fLogName = ($PATH_INFO) ? $PATH_INFO : $SCRIPT_NAME;
    $fLogName = substr($fLogName, strrpos($fLogName, '/') + 1) . '.log.htm';
    # 60 KB ist zu gro� f�r Email Prog... calypso schickt das unsch�n in ein Attachment
    $kb_filesize_border = ($SERVER_NAME == 'localhost') ? 0 : 15;
    $filesize = @filesize($fLogName);
    # Vielleicht existiert das file noch nicht. Dann wird es weiter unten noch erstellt. Daher besser keine Fehlermeldung bei @filesize( $fLogName ) ;
    if ($filesize > $kb_filesize_border * 1000) {
        # In Byte
        if ($filesize > $kb_filesize_border * 1000 * 30) {
            html_email(
                "@$config[diverses][programmer_email] ( Programmer )",
                "Logfile (" . date("d.M.Y H:i:s", time()) . ' Uhr' . "): $fLogName",
                "$fLogName ist gr��er als $kb_filesize_border * 1000 * 30 und wird damit als zu gro� f�r eine Email eingestuft.",
                "@$config[diverses][programmer_email] ( Logfile )"
            );
            if (!$hLog = @fopen($fLogName, "w")) {
                @mail(
                    $nach,
                    "PHP-Script-Fehler : $fLogName kann nicht erstellt oder ge�ffnet werden.",
                    $fLogName . " Kann nicht erstellt oder ge�ffnet werden. ",
                    "from: " . $from . "\n"
                );
            }
            @fclose($hLog);
        } else {
            if (!@$config[diverses][programmer_email]) {
                @$config[diverses][programmer_email] = 'lauffer@sl5.de';
            }
            html_email(
                "@$config[diverses][programmer_email] ( Programmer )",
                "Logfile (" . date("d.M.Y H:i:s", time()) . ' Uhr' . "): $fLogName",
                implode('', file($fLogName)),
                "@$config[diverses][programmer_email] ( Logfile )"
            );
            if (!$hLog = @fopen($fLogName, "w")) {
                @mail(
                    $nach,
                    "PHP-Script-Fehler : $fLogName kann nicht erstellt oder ge�ffnet werden.",
                    $fLogName . " Kann nicht erstellt oder ge�ffnet werden. ",
                    "from: " . $from . "\n"
                );
            }
            @fclose($hLog);
        }
    }
    if ($hLog = @fopen($fLogName, "a+")) {
        fwrite(
            $hLog,
            '<html><head><title>' . $fLogName .
            "</title>
      </head>
      <body>
      "
        );
        fwrite(
            $hLog,
            "<pre>$obj_script->path_transd=$obj_script->path_transd \n \$obj_site_out->adress_transd=$obj_site_out->adress_transd\n"
        );
        fwrite($hLog, date("d.M.Y H:i:s", time()) . ' Uhr' . "<br>\n");
    } else {
        $errortext = "Konnte Logfile ( $fLogName ) nicht �ffnen bzw. anlegen.<br>�berpr�fen Sie bitte, ob in Ihrem Ordner Schreibrechte gesetzt sind. (Tipp: chmod 0757 $fLogName )" .
            ' Istzustand: chmod = ' . decoct(fileperms($fLogName));
        error($fromline . '�' . __line__, __FILE__, $errortext);
        gelb($fromline . '�' . __line__, __FILE__, "$errortext", 'e');
    }
}

?>
