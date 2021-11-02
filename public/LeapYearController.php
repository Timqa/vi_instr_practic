<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
  public function indexAction($year): Response
  {
    echo 123;
    if (is_leap_year($year)) {
      return new Response('Да, это высокосный год');
    } else {
      return new Response('Нет, это не высокосный год');
    }
  }
}