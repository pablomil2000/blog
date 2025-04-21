<?php
class UtilsController
{

    static public function loginRequired($loginUrl)
    {
        if (!isset($_SESSION['user'])) {
            UtilsController::redirect($loginUrl);
            exit;
        }
    }

    static public function redirect($route)
    {
        echo "<script>
            window.location.href = '$route';
        </script>";
    }

    static public function getSlug($str)
    {
        $str = strtolower(str_replace(' ', '-', $str));
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
        return $str;
    }


    static public function coinFlipper($datas)
    {
        $count = count($datas);
        $randomIndex = rand(0, $count - 1);
        return $datas[$randomIndex];
    }

    static public function formatDate($date, $format = 'yyyy-MM-dd')
    {
        return date($format, strtotime($date));
    }

    static public function getIntro($string, $fistCharacters = 20)
    {
        // get first 20 characters
        $intro = substr($string, 0, $fistCharacters);
        // add... characters
        if (strlen($string) > $fistCharacters) {
            $intro .= '...';
        }
        return $intro;
    }
}

class validatorController
{
    static public function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    static public function validateString($string)
    {
        return htmlspecialchars(trim($string));
    }

    static public function validateNumber($number)
    {
        if (is_numeric($number)) {
            return true;
        }
        return false;
    }

    static public function validateUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    static public function validateImage($image, $types = array('jpg', 'png'))
    {
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        if (in_array($ext, $types)) {
            return true;
        }
        return false;
    }


    static public function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    static public function validateFile($file, $types = array('txt', 'pdf'))
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if (in_array($ext, $types)) {
            return true;
        }
        return false;
    }

    static public function validatePassword($password, $minLength = 8)
    {
        return strlen($password) >= $minLength;
    }

    static public function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
