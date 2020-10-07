<?php
include_once "core/weblogic.php";

//Connect Here Modules json file
//IMPORTANT: DON'T USE UNSET() FOR MODULES! BECAUSE IT MAY HAVE ERROR WITH DEPENDENCE!
use WebLogic\Module as Module;
$user_module = new Module("module/user/user.json");
$find_module = new Module("module/search/search.json");
//Add Here Pages
//IMPORTANT: DON'T FORGET ADD LINE to .htacces
//EXAMPLE: RewriteRule ^yourpage ?page=yourpage [NC,L]
use WebLogic\PageMaker as PageMaker;
PageMaker::AddPage("dog", "dog.php", "my dog page!", null, null);
PageMaker::AddPage("about-us", "about.php", "About Us", array("about.js", "about2.js"), array("about.css"));

use WebLogic\Page as Page;

$curpage = PageMaker::PageBuilder();
?>
<html lang="ge">
    <head>
        <meta charset="utf-8">
        <title><? $curpage->ShowTitle(); ?></title>
        <?
            $curpage->ConnectCSS();
           ?>
        <script src="js/jquery-3.5.1.min.js"></script>
        <?
            $curpage->ConnectJS();
        ?>
    </head>
    <body>
        <?
                echo "Test 100!;";
                $curpage->ShowPage();
        ?>
    </body>
</html>