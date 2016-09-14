<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/17/16
 * Time: 11:17 AM
 */

$post = isset($_POST['title']) ? $_POST['title'] : NULL;

$post = $_POST['title'] ?? NULL;