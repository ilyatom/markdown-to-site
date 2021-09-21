<?php

/*
 * Загрузите файлы markdown в папку mds
 * Все пары Папка-Файл должны быть уникальными
 * Для сортировки файлов и папок используйте числовые префиксы вида 1_, 2_ и так далее
 */

class Md {

    protected static $sectionId = 'section';
    protected static $chapterId = 'chapter';
    protected static $mdDir = './mds';
    protected static $coreSection = 'Главная';
    protected static $indexChapter = 'Главная';
    protected static $tableOfContents = array();
    protected static $tableOfContentsHTML = '';
    protected static $section = '';
    protected static $chapter = '';
    protected static $fullPathToDir = '';
    protected static $fullPathToFile = '';
    protected static $searchinDirStatus = false;
    protected static $fakePaths = array();
    protected static $currDirName = '';

    public static function getSectionId() {
        return self::$sectionId;
    }

    public static function getChapterId() {
        return self::$chapterId;
    }

    public static function init($section, $chapter) {
        if($section == null) {
            $section = self::$coreSection;
        }
        if($chapter == null) {
            $chapter = self::$indexChapter;
        }
        self::$section = $section;
        self::$chapter = $chapter;
        self::$tableOfContents = self::getFullContentTree();
        self::searchSection(self::$tableOfContents, self::$section, self::$chapter);
        self::scanForErrors();
    }

    public static function getTableOfContents() {
        $array = self::$tableOfContents[self::$mdDir];
        self::getTableOfContentsHTML($array);
        return '<ul id="ilyatommenu">'.self::$tableOfContentsHTML.'</ul>';
    }

    public static function getFileContent() {
        $res = '';
        $fullFilename = self::$fullPathToFile;
        if (file_exists($fullFilename)) {
            include_once 'app/libs/ParseDown.php';
            $mkparser = new Parsedown();
            $res = $mkparser->text(file_get_contents($fullFilename));
        } else {
            $res = 'Страница ' . self::$chapter . ' раздела ' . self::$section . ' не найдена';
        }
        return $res;
    }

    public static function test() {
        $res = '';
        $res = self::$fullPathToFile;
        return $res;
    }

//--------------- PROTECTED -------------------------

    protected static function scanForErrors() {
        // не могут повторяться пары DIR-FILE
    }
    
    protected static function getTableOfContentsHTML($array) {
        foreach ($array as $key => $value) {
            if (is_array($value)) { // это папка
                self::$tableOfContentsHTML .= '<li><div>' . self::deletePrefix($key) . '</div>';
                self::$tableOfContentsHTML .= '<ul>';
                self::$currDirName = $key;
                self::getTableOfContentsHTML($value);
                self::$tableOfContentsHTML .= '</ul></li>';
            } else {
                self::$tableOfContentsHTML .= '<li><div><a href="?' . self::$sectionId . '=' . self::$currDirName . '&' . self::$chapterId . '=' . $value . '">' . self::deletePrefix($value) . '</a></div></li>';
            }
        }
    }

    protected static function deletePrefix($string) {
        return preg_replace('/^\d_/', '', $string);
    }

    protected static function getFullContentTree() {
        $tree = array();
        $tree[self::$mdDir] = self::getDirContent(self::$mdDir);
        return $tree;
    }

    protected static function isDir($name) {
        $res = true;
        if (preg_match('/\.md$/', $name)) {
            $res = false;
        }
        return $res;
    }

    protected static function getDirContent($path) {
        $res = scandir($path);
        unset($res[0]); // удаляем .
        unset($res[1]); // удаляем ..

        foreach ($res as $key => $name) {
            $innerPath = $path . '/' . $name;
            if (self::isDir($innerPath)) {
                unset($res[$key]);
                $res[$name] = self::getDirContent($innerPath);
            } else {
                $res[$key] = str_replace('.md', '', $name);
            }
        }
        return $res;
    }

    protected static function searchSection($array, $section, $chapter) {
        // меняем Главная на корневой каталог
        if (self::$section == self::$coreSection) {
            $section = self::$mdDir;
        }
        if (isset($array[$section])) {
            self::$searchinDirStatus = true;
            self::$fullPathToDir .= $section.'/';
            $check = self::$fullPathToDir;
            foreach (self::$fakePaths as $path) {
                $destroyPath = str_replace(self::$mdDir, '', $path);
//                echo 'Удаляем путь '.$destroyPath.'<br />';
                $check = str_replace($destroyPath, '/', $check);
            }
            
//            echo 'Проверяем путь '.$check.'<br />';
            $filename = $check . $chapter . '.md';
            if (file_exists($filename)) {
//                echo 'Файл найден по адресу' . self::$fullPathToDir . $chapter . '<br>';
                self::$fullPathToDir = $check;
                self::$fullPathToFile = $filename;
            } else {
//                echo 'Файл не найден' . self::$fullPathToDir . $chapter . ', поиски продолжаются' . '<br>';
                self::$fakePaths[] = $check;
            }
        } else {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    self::$fullPathToDir .= $key . '/';
                    self::searchSection($value, $section, $chapter);
                    if (self::$searchinDirStatus == false) {
                        self::$fullPathToDir = str_replace($key . '/', '', self::$fullPathToDir);
                    }
                }
            }
        }
    }

}
