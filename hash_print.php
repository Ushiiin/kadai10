<?php

$input = "test1";

$hashed_input = password_hash($input, PASSWORD_DEFAULT);

echo $hashed_input;