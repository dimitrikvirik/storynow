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
switch (PageMaker::GetUrl()) {
    case  "/dog":
        PageMaker::AddPage("dog", "dog.php", "my dog page!", null, null);
        break;
    case "/about-us":
        PageMaker::AddPage("about-us", "about.php", "About Us", array("about.js", "about2.js"), array("about.css"));
        break;
}

$curpage = PageMaker::PageBuilder();
?>
<!DOCTYPE html>
<html lang="ge">
    <head>
        <meta charset="utf-8">
        <title><? $curpage->ShowTitle(); ?></title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <?
            $curpage->ConnectCSS();
           ?>
    </head>
    <body>
        <?
                $curpage->ShowPage();

        ?>
        <script src="js/main.js"></script>
        <?
        $curpage->ConnectJS();
        ?>
    </body>
</html>