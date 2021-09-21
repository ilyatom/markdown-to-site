<?php


include_once 'app/models/md.php';
$md = new Md();
$sectionId = $md::getSectionId();
$chapterId = $md::getChapterId();

// получили GET 
$filename = '';
$dir = '';
if(isset($_GET[$chapterId])) {
    $filename = filter_var($_GET[$chapterId], FILTER_SANITIZE_STRING);
}
if(isset($_GET[$sectionId])) {
    $dir = filter_var($_GET[$sectionId], FILTER_SANITIZE_STRING);
}

// собрали данные
$md::init($dir,$filename);
$content = $md::getFileContent();
$tableofcontents = $md::getTableOfContents();

// потестировали
//echo $md::test();

// передали данные виду
return include_once 'app/views/test.php';