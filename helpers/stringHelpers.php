<?php

function capitalize($string)
{
    $words = explode(" ", $string);

    foreach ($words as $index => $word) {
        $words[$index] = ucfirst($word);
    }

    return implode(" ", $words);
}

function getFirstName($fullName)
{
    $nameParts = explode(" ", $fullName);
    return $nameParts[0];
}

function getFullLastName($name)
{
    $nameParts = explode(" ", $name);
    $stringsAfterFirstName = [];

    foreach ($nameParts as $namePart) {
        if ($namePart != $nameParts[0]) {
            $stringsAfterFirstName[] = $namePart;
        }
    }

    return implode(" ", $stringsAfterFirstName);
}

function randomNumber() {
    return mt_rand(1, 1000);
  }
?>