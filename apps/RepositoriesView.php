<?php
/**
 * User: elron
 * Date: 16/09/12
 * Time: 12:25
 */

//$a_Repos = $_SESSION['a_Repos'];
//$b_ReloadData = (isset($_REQUEST['b_ReloadData']) ? $_REQUEST['b_ReloadData'] : false);

//if ($a_Repos !== null && !$b_ReloadData) {
// echo ('$a_Repos : '); var_dump($a_Repos);
    $o_Configuration = new Configuration();
    $a_Repos = $o_Configuration->getRepos();
   // $_SESSION['a_Repos'] = $a_Repos;
//}

if (isset($_REQUEST['sz_Repo'])) {
    $o_Repo = $a_Repos[$_REQUEST['sz_Repo']];

    error_log('sansie $_REQUEST[sz_Repo] : ' . $_REQUEST['sz_Repo']);
    error_log('sansie $o_Repo : ' . print_r($o_Repo, true));
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Smart Gitolite Admin</title>

    <link rel="stylesheet" href="styles/style.css"/>

    <!--[if IE 6]>
    <style>body {
        behavior: url("styles/ie6-hover-fix.htc");
    }</style>
    <link rel="stylesheet" href="styles/ie6.css"/>
    <![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="styles/ie7.css"/>
    <![endif]-->
    <!--[if IE 8]>
    <link rel="stylesheet" href="styles/ie8.css"/>
    <![endif]-->

</head>

<body>

<div id="top-banner"></div>

<div id="wrap">
    <div id="header">

        <h1><a href="index.html">[Smart Gitolite Admin]</a></h1>

        <h2></h2>

        <ul id="nav">
            <li class="current"><a href="index.html">Repositories</a><span>/</span>
                <ul>
                    <li><p style="padding: 10px;">Display all repositories</p></li> <?php //todo create css ?>
                </ul>
            </li>
            <li><a href="page.html">Configure Git</a><span>/</span>
                <ul>
                    <li><p style="padding: 10px;">Configure gitolite admin depot access</p></li>
                </ul>
            </li>
            <li><a href="contact.html">About</a></li>
        </ul>

    </div>
    <!--end header-->

    <div id="main">
        <div id="content">

            <form id="contact-form" method="post" action="scripts/contact-process.php">
                <fieldset>
                    <?php if ($o_Repo) : ?>
                        <h2><?php echo ($o_Repo->getName() !== null ? $o_Repo->getName() : "Name") ?></h2>
                        <label for="form_rights"><h3>Rights</h3></label>
                        <input id="form_rights" type="text" name="rights"
                               value="<?php echo ($o_Repo->getRights() !== null ? $o_Repo->getRights() : "Rights") ?>"
                               onfocus="if(this.value=='Email'){this.value=''};"
                               onblur="if(this.value==''){this.value='Email'};"/>
                        <label for="form_users"><h3>Users</h3></label>
                        <input id="form_users" type="text" name="users"
                               value="<?php echo ($o_Repo->getUsers() !== null ? implode(', ', $o_Repo->getUsers()) : "Users") ?>"
                               onfocus="if(this.value=='Subject'){this.value=''};"
                               onblur="if(this.value==''){this.value='Subject'};"/>

                        <p><input id="form_submit" class="button" type="submit" name="submit" value="Submit"/></p>

                        <div class="hide">
                            <label>Do not fill out this field</label>
                            <input name="spam_check" type="text" value=""/>
                        </div>
                    <?php endif; ?>
                </fieldset>
            </form>
        </div>
        <!--end content-->

        <div id="sidebar">
            <h3 class="sidebar-title">Repositories</h3>

            <?php if (empty($a_Repos)) : ?>
            No Repository found
            <?php else : ?>
            <?php $o_Repo = new Repo(); ?>
            <?php foreach ($a_Repos as $o_Repo) : ?>
                <p><b><a href="?sz_Repo=<?php echo $o_Repo->getName() ?>"><?php echo $o_Repo->getName()?></a></b><br>
                    [<?php echo implode(', ', $o_Repo->getUsers()); ?>]</p>
                <?php endforeach; ?>

            <?php endif; ?>
            <p style=""><input id="form_new" class="button" type="button" name="new" value="New..."/></p>


        </div>
        <!--end sidebar-->

    </div>
    <!--end main-->

    <div class="line"></div>

    <div id="footer">
œ   </div>
    <!--end footer-->

</div>
<!--end wrap-->
</body>
</html>