<?php

if (! function_exists('formatPrice')) {
    function formatPrice()
    {
        return 'Rp. ' . number_format($str, '0', '', '');
    }
}
