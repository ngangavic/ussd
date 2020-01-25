<?php
session_start();

echo 'Session ID is: '.$_SESSION['id'];
echo '</br>';
echo 'The phone number is: '.$_SESSION['phone'];