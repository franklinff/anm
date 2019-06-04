<?php
/**
 * Class_converttounicode.php
 * @author    Aatish Gore <aatish15@gmail.com>
 * @copyright Aatish Gore
 */

namespace App\Classes;
use Exception;

/**
 * Class ConvertToUnicode
 * This class converts the kruti font to unicode font in php
 */
Class ConvertToUnicode {
    private $array_one = ["ñ", "Q+Z", "sas", "aa", ")Z", "ZZ", "‘", "’", "“", "”", "å", "ƒ", "„", "…", "†", "‡", "ˆ", "‰", "Š", "‹", "¶+", "d+", "[+k", "[+", "x+", "T+", "t+", "M+", "<+", "Q+", ";+", "j+", "u+", "Ùk", "Ù", "ä", "–", "—", "é", "™", "=kk", "f=k", "à", "á", "â", "ã", "ºz", "º", "í", "{k", "{", "=", "«", "Nî", "Vî", "Bî", "Mî", "<î", "|", "K", "}", "J", "Vª", "Mª", "<ªª", "Nª", "Ø", "Ý", "nzZ", "æ", "ç", "Á", "xz", "#", ":", "v‚", "vks", "vkS", "vk", "v", "b±", "Ã", "bZ", "b", "m", "Å", ",s", ",", "_", "ô", "d", "Dk", "D", "[k", "[", "x", "Xk", "X", "Ä", "?k", "?", "³", "pkS", "p", "Pk", "P", "N", "t", "Tk", "T", ">", "÷", "¥", "ê", "ë", "V", "B", "ì", "ï", "M+", "<+", "M", "<", ".k", ".", "r", "Rk", "R", "Fk", "F", ")", "n", "/k", "èk", "/", "Ë", "è", "u", "Uk", "U", "i", "Ik", "I", "Q", "¶", "c", "Ck", "C", "Hk", "H", "e", "Ek", "E", ";", "¸", "j", "y", "Yk", "Y", "G", "o", "Ok", "O", "'k", "'", "\"k", "\"", "l", "Lk", "L", "g", "È", "z", "Ì", "Í", "Î", "Ï", "Ñ", "Ò", "Ó", "Ô", "Ö", "Ø", "Ù", "Ük", "Ü", "‚", "ks", "kS", "k", "h", "q", "w", "`", "s", "S", "a", "¡", "%", "W", "•", "·", "∙", "·", "~j", "~", "\\", "+", " ः", "^", "*", "Þ", "ß", "(", "¼", "½", "¿", "À", "¾", "A", "-", "&", "&", "Œ", "]", "~ ", "@"];
    private $array_two = ["॰", "QZ+", "sa", "a", "र्द्ध", "Z", "\"", "\"", "'", "'", "०", "१", "२", "३", "४", "५", "६", "७", "८", "९", "फ़्", "क़", "ख़", "ख़्", "ग़", "ज़्", "ज़", "ड़", "ढ़", "फ़", "य़", "ऱ", "ऩ", "त्त", "त्त्", "क्त", "दृ", "कृ", "न्न", "न्न्", "=k", "f=", "ह्न", "ह्य", "हृ", "ह्म", "ह्र", "ह्", "द्द", "क्ष", "क्ष्", "त्र", "त्र्", "छ्य", "ट्य", "ठ्य", "ड्य", "ढ्य", "द्य", "ज्ञ", "द्व", "श्र", "ट्र", "ड्र", "ढ्र", "छ्र", "क्र", "फ्र", "र्द्र", "द्र", "प्र", "प्र", "ग्र", "रु", "रू", "ऑ", "ओ", "औ", "आ", "अ", "ईं", "ई", "ई", "इ", "उ", "ऊ", "ऐ", "ए", "ऋ", "क्क", "क", "क", "क्", "ख", "ख्", "ग", "ग", "ग्", "घ", "घ", "घ्", "ङ", "चै", "च", "च", "च्", "छ", "ज", "ज", "ज्", "झ", "झ्", "ञ", "ट्ट", "ट्ठ", "ट", "ठ", "ड्ड", "ड्ढ", "ड़", "ढ़", "ड", "ढ", "ण", "ण्", "त", "त", "त्", "थ", "थ्", "द्ध", "द", "ध", "ध", "ध्", "ध्", "ध्", "न", "न", "न्", "प", "प", "प्", "फ", "फ्", "ब", "ब", "ब्", "भ", "भ्", "म", "म", "म्", "य", "य्", "र", "ल", "ल", "ल्", "ळ", "व", "व", "व्", "श", "श्", "ष", "ष्", "स", "स", "स्", "ह", "ीं", "्र", "द्द", "ट्ट", "ट्ठ", "ड्ड", "कृ", "भ", "्य", "ड्ढ", "झ्", "क्र", "त्त्", "श", "श्", "ॉ", "ो", "ौ", "ा", "ी", "ु", "ू", "ृ", "े", "ै", "ं", "ँ", "ः", "ॅ", "ऽ", "ऽ", "ऽ", "ऽ", "्र", "्", "?", "़", ":", "‘", "’", "“", "”", ";", "(", ")", "{", "}", "=", "।", ".", "-", "µ", "॰", ",", "् ", "/"];
    private $modified_substring = '';
    public function __constuct(){
    }
    public function setStringToConvert($stringtoconvert = ''){
        if($stringtoconvert == '' || is_null($stringtoconvert)){
//            throw new Exception('String cannot be blank');
            $this->modified_substring = "Testing";
        }
        $this->modified_substring = $stringtoconvert;
    }
    public function convert_to_unicode2($stringtoconvert = '') {
        $this->setStringToConvert($stringtoconvert);
        $array_one_length = count($this->array_one);
        $text_size = strlen($this->modified_substring);
        $processed_text = '';
        $sthiti1 = 0;
        $sthiti2 = 0;
        $chale_chalo = 1;
        $max_text_size = 6000;
        while ($chale_chalo == 1) {
            if ($sthiti2 < ($text_size - $max_text_size)) {
                $sthiti1 = $sthiti2;
                $sthiti2 += $max_text_size;
                while (mb_substr($this->modified_substring,$sthiti2,1,'utf-8') != ' ') {
                    $sthiti2--;
                }
            } else {
                $sthiti2 = $text_size;
                $chale_chalo = 0;
            }
            $modified_substring = mb_substr($this->modified_substring,$sthiti1, $sthiti2,'utf-8' )  ;
            $modified_substring = $this->replace_symbols();
            $processed_text .= $modified_substring;
            $this->modified_substring = $processed_text;
        }
        return $this->modified_substring;
    }
    private function replace_symbols() {
        $modified_substring = $this->modified_substring;
        $array_one_length = count($this->array_one);
        if ($modified_substring != "") {
            for ($input_symbol_idx = 0; $input_symbol_idx < $array_one_length; $input_symbol_idx++) {
                $idx = true;
                while ($idx) {
                    $modified_substring = str_replace($this->array_one[ $input_symbol_idx ] , $this->array_two[$input_symbol_idx],$modified_substring );
                    $idx = mb_strpos($modified_substring,$this->array_one[$input_symbol_idx],0,"utf-8");
                }
            }
            $modified_substring = $this->stringReplace($modified_substring,"/±/g", "Zं");
            $modified_substring = $this->stringReplace($modified_substring,"/Æ/g", "र्f");
            $position_of_i = 1; //ToDo: problem point
            while ($position_of_i) {
                $position_of_i = mb_strpos($modified_substring,'f',0,'utf-8');
                $charecter_next_to_i = mb_substr($modified_substring,$position_of_i + 1,1,"utf-8");
                $charecter_to_be_replaced = "f" . $charecter_next_to_i;
                $modified_substring = $this->stringReplace($modified_substring,$charecter_to_be_replaced, $charecter_next_to_i . "ि");
                $position_of_i = mb_strpos($modified_substring,"/f/", $position_of_i + 1,"utf-8");
            }
            $modified_substring = $this->stringReplace($modified_substring,"/Ç/g", "fa");
            $modified_substring = $this->stringReplace($modified_substring,"/É/g", "र्fa");
            $position_of_i = mb_strpos($modified_substring,"fa",0,"utf-8");
            while ($position_of_i) {
                $charecter_next_to_ip2 = mb_substr($modified_substring,$position_of_i + 2,1,"utf-8");
                $charecter_to_be_replaced = "fa" . $charecter_next_to_ip2;
                $modified_substring = $this->stringReplace($modified_substring,$charecter_to_be_replaced, $charecter_next_to_ip2 . "िं");
                $position_of_i = mb_strpos($modified_substring,"/fa/",$position_of_i + 2,"utf-8");
            }
            $modified_substring = $this->stringReplace($modified_substring,"/Ê/g", "ीZ");
            $position_of_wrong_ee = mb_strpos($modified_substring,"ि्",0,"utf-8");
            while ($position_of_wrong_ee ) {
                $consonent_next_to_wrong_ee = mb_substr($modified_substring,$position_of_wrong_ee + 2,1,"utf-8");
                $charecter_to_be_replaced = "ि्" . $consonent_next_to_wrong_ee;
                $modified_substring = $this->stringReplace($modified_substring,$charecter_to_be_replaced, "्" . $consonent_next_to_wrong_ee . "ि");
                $position_of_wrong_ee = mb_strpos($modified_substring,"/ि्/", $position_of_wrong_ee + 2,'utf-8');
            }
            $set_of_matras = "अ आ इ ई उ ऊ ए ऐ ओ औ ा ि ी ु ू ृ े ै ो ौ ं : ँ ॅ";
            $position_of_R = mb_strpos($modified_substring,"Z",0,"utf-8");
            while ($position_of_R) {
                $probable_position_of_half_r = $position_of_R - 1;
                $charecter_at_probable_position_of_half_r = mb_substr($modified_substring,$probable_position_of_half_r,1,"utf-8");
                while (mb_strpos($set_of_matras, $charecter_at_probable_position_of_half_r,0,"utf-8") !==false) {
                    $probable_position_of_half_r = $probable_position_of_half_r - 1;
                    $charecter_at_probable_position_of_half_r = mb_substr($modified_substring,$probable_position_of_half_r,1,"utf-8");
                }
                $charecter_to_be_replaced =mb_substr($modified_substring,$probable_position_of_half_r, ($position_of_R - $probable_position_of_half_r),"utf-8");
                $new_replacement_string = "र्" . $charecter_to_be_replaced;
                $charecter_to_be_replaced = $charecter_to_be_replaced . "Z";
                $modified_substring = $this->stringReplace($modified_substring,$charecter_to_be_replaced, $new_replacement_string);
                $position_of_R = mb_strpos($modified_substring,"Z",0,"utf-8");
            }
        }
        return $modified_substring;
    }
    private function stringReplace($actual_string,$string1,$string2){
        return mb_ereg_replace($string1,$string2,$actual_string);
    }
}