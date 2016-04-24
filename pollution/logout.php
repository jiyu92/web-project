<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: insert_utf.html"); // Redirecting To Home Page
}
?>