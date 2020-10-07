<?php
//DON'T CHANGE HERE ANYTHING!

namespace WebLogic;
require "db.php";
class WebLogic{

    static $version = "1.0";
    public static $modules =  array();
    public static function PrintModules(): void{
       var_dump(self::$modules);
    }
    public static function FindModule($module_name): bool{
        foreach (self::$modules as $key){
            if($key["name"] == $module_name){
                return true;
            }
        }
        return  false;
    }
}
/**
 * მოდულების ჩართვა/გამორთვა/მმართვა
 * @package WebLogic
 */

 class Module extends  WebLogic{
    private $dir; //Module Directory
    private $name; //Module Name
    private $mdversion; //Module Version
    private $dependence; //Module dependence
    private $active; //If active module
    private $json; //json file on module
    private $wbversion;// what version WebLogic support module
    private $files; //files that use module
    /**
     * Module constructor.
     * @param $dir
     */
    public function __construct($dir)
    {
        $this->dir = $dir;
        $json_file =  file_get_contents($this->dir);
        $this->json = json_decode($json_file, true);
        $this->name = $this->json["name"];
        $this->mdversion = $this->json["version"];
        $this->dependence = $this->json["dependence"];
        $this->wbversion = $this->json["WebLogic"];
        $this->files = $this->json["files"];
        $this->Connect();
    }
    public  function __destruct()
    {
      $this->Disable();
    }
     public function PrintJSON(): void{
        var_dump($this->json);
    }
    /**
     * მოდულის ჩართვა
     */
    public function Connect(): void{
        //Check Dependence
        $havedependence = false;
        if($this->dependence == null){
            //If Module does not have any dependence
            $havedependence = true;
        }
        else{
           foreach (self::$modules as $key){

                if($key["name"] == $this->dependence){
                    $havedependence = true;
               }
           }
        }
        if(!$havedependence){
            echo "Error: you doesn't have dependence module/modules for this module!";
            return;
        }
        //Check WebLogic Version
        if(strcmp($this->wbversion, self::$version)){
            echo "Error: Non support version WBlogic for module!";
            return;
        }
        $this->active = true;
        //Connect Files
        foreach ($this->files as $key){
            include "module/".$this->name."/".$key;
        }
       array_push(self::$modules, $this->json);
    }
    /**
     * მოდულის გათიშვა
     */
    private function Disable(): void{
        $this->active = false;
        for($i = 0; $i < sizeof(self::$modules); $i++){
            if(self::$modules[$i]["name"] == $this->name){
                unset(self::$modules[$i]);
                return;
            }
        }

    }
}

/**
 * გვერდის გენერაცია
 * @package WebLogic
 */
class PageMaker extends WebLogic
{
    static $pages = array();
    static $curpage;

    static function AddPage($page, $filename, $title, $js, $css)
    {
        array_push(self::$pages, ["/".$page, $filename, $title, $js, $css]);
    }
    static  function GetUrl(): string{
       return $_SERVER["REQUEST_URI"];
    }
    static function PageBuilder(): Page
    {
        if ("/" == self::GetUrl()) {
            return new Page("home", "home.php", "Main Page", null, null);
        }
        foreach (self::$pages as $page) {
            if ($page[0] == self::GetUrl()) {
                return new Page($page[0], $page[1], $page[2], $page[3], $page[4]);
            }
        }
        return new Page("404", "404.php", "Error Page", null, null);
    }


}
/**
 * გვერდის მმართვა
 */
class Page extends  PageMaker {
    public $name;
    public $dir;
    public $title;
    public $js = array();
    public $css = array();


    /**
     * Page constructor.
     * @param $name
     * @param $dir
     * @param $title
     * @param  $js
     * @param  $css
     */
    public function __construct($name, $dir, $title,  $js,  $css)
    {
        $this->name = $name;
        $this->dir = $dir;
        $this->title = $title;
        $this->js = $js;
        $this->css = $css;
    }
    public function ShowPage(): void{
        require_once "src/".$this->dir;
    }
    public function  ShowTitle(): void{
        echo $this->title;
    }
    public function ConnectCSS(): void{
        if($this->css != null) {
            foreach ($this->css as $key) {
                echo("<link rel='stylesheet' type='text/css' href='css/pages/".$key."'/>");
            }
        }
    }
    public function ConnectJS(): void{
        if($this->js != null) {
            foreach ($this->js as $key) {
                echo("<script src='js/pages/".$key."'></script>");
            }
        }
    }

}