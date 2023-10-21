<?php

function sanitizeInput($input){
    return htmlentities(htmlspecialchars(trim($input)));
}