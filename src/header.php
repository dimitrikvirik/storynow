<?php session_start(); ?>
<header>
     <? if(!isset($_SESSION['user_logined'])):  //მომხმარებელი არაა შესული?>
        <!--შესვლა ან რეგისტრაცია-->
        <div id="join">
            <!--შესვლა-->
            <form id="login" method="post" action="doc/client.php">
                <input type="text" id="login_username" name="login_username" class="join_input">
                <input type="password" id="login_password" name="login_password" class="join_input">
                <input type="checkbox" id="login_remember"  name="login_remember" join_checkbox">
                <input type="submit" value="შესვლა" id="login_submit" name="login_submit" class="join_button">
            </form>
            <!--რეგისტრაცია-->
            <form id="reg" method="post" action="doc/client.php">
                <input type="text" id="reg_username" name="reg_username" class="join_input">
                <input type="text" id="reg_firstname" name="reg_firstname" class="join_input">
                <input type="text" id="reg_lastname" name="reg_lastname" class="join_input">
                <input type="date" id="reg_date" name="reg_date" class="join_date">
                <input type="password" id="reg_password" name="reg_password" class="join_input">
                <input type="checkbox" id="reg_remember"  name="reg_remember" join_checkbox">
                <input type="submit" value="რეგისტრაცია" id="reg_submit" name="reg_submit" class="join_button">
            </form>
        </div>
    <? else:  //მომხმარებელი შესულია?>
        <span div="welcome">სალამი <? echo ($_SESSION['user_username']); ?> !</span>
        <div id="profile">
            <form id="profile_form" method="post" action="doc/client.php">
                <input type="submit" value="პროფილზე გადასვლა" id="profile_submit" name="profile_submit" class="user_form">
            </form>
        </div>
        <!--გამოსვლა-->
        <div id="logout">
           <form id="logout_form" method="post" action="doc/client.php">
               <input type="submit" value="გამოსვლა" id="logout_submit" name="logout_submit" class="user_form">
           </form>
        </div>
    <? endif;?>
    <!--ყველა-->
    <div id="logo"></div>
    <div id="search">
        <!--ძებნა-->
        <form id="find" method="post" action="doc/search.php">
            <input type="text" id="find_input" name="find_input">
            <input type="submit" id="find_submit" name="find_submit">
        </form>
    </div>
    <div id="category"></div>
</header>