<?php

session_start();
$_SESSION['loose'] = False;
$_SESSION['win'] = False;
$_SESSION['start'] = False;
$_SESSION['codeUser'] = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	lunchGame();
	$_SESSION["historic"] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['start'] = true) {

	$_SESSION['codeUser'] = $_GET['codeUser'];
	if (strlen($_SESSION['codeUser']) == 4) {
		array_push($_SESSION["historic"], $_SESSION["codeUser"]);
		checkInput();
	}
}

/**
 * lunchGame
 *
 * @var int $number
 *
 * Génère aléatoirement un nombre de 4 chiffres
 * lance la fonction checkInput
 */
function lunchGame()
{
	$_SESSION['try'] = 0;
	$_SESSION['tracking'] = [];
	$_SESSION['restTry'] = 10;
	if ($_SESSION["code"] != '') {
		unset($_SESSION["code"]);
		$_SESSION["code"] = '';
	}
	for ($i=0; $i <= 3; $i++) {
		$number = rand(0, 9);
		$_SESSION["code"].=$number;
	}
	$_SESSION['start'] = True;
}

/**
 * codeInput
 * @var int $try
 * @var str $code
 * @var str $input
 * This function checks user input for a 4-digit code and allows 10 attempts to guess the correct code.
 */

 
function checkInput()
{
	if ($_SESSION['try'] < 9) {

		if ($_SESSION['codeUser'] == $_SESSION["code"]) {
			$_SESSION['win'] = True;
		} else {
			checkChar($_SESSION['codeUser'], $_SESSION["code"]);
			$_SESSION['try'] ++;
			$_SESSION['restTry'] -= 1;
		}
	} elseif (strlen($_SESSION["codeUser"]) != 4) {
		$_SESSION['codeUser'] = 'Essai perdu';
	} else {
		$_SESSION['restTry'] = 0;
		$_SESSION['loose'] = True;
	}
}

/**
 * checkChar 
 * @param $input = $_SESSION['codeUser']
 * @param $code = $_SESSION["code"]
 * @var array $arrayCode
 * @var array $arrayInput
 * @var array $notExist
 * The function checks if characters in an input string exist in a code string and outputs whether they
 * are in the correct position or not.
 */
function checkChar($input, $code)
{
	$arrayInput = str_split($input);
	$arrayCode = str_split($code);
	$notExist = array_diff($arrayInput, $arrayCode);
	$traking = '';
    for ($i = 0; $i<count($arrayInput); $i++) {
        if (!in_array($arrayInput[$i], $notExist) && $arrayInput[$i] == $arrayCode[$i]) {
			$traking.= 'o';
        } elseif (!in_array($arrayInput[$i], $notExist) && $arrayInput[$i] != $arrayCode[$i]) {
			$traking.= 'x';
        } else {
			$traking.= '_';
        }
    }
	array_push($_SESSION['tracking'], $traking);
}
