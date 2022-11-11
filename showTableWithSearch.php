<?php

require 'inc/LibraryController.php';

$name = $_GET['search'];

$library = new LibraryController();

$books = $library->index($name);

