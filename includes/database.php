<?php

$connect = mysqli_connect('localhost','root', 'mypass', 'events');

if (mysqli_connect_errno()){
    exit('mysqli_connect_errno' .mysqli_connect_error());
}
