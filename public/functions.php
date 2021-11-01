<?php

use Symfony\Component\HttpFoundation\Response;

function render_template($request): Response
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    require sprintf('./page/%s.php', $_route);
    return new Response(ob_get_clean());
}

function is_leap_year($year = null): bool
{
    if ($year === null) {
        $year = date('Y');
    }
    return !($year % 400) || (!($year % 4) && ($year % 100));
}