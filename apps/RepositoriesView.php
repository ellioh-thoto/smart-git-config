<?php
/**
 * User: elron
 * Date: 16/09/12
 * Time: 12:25
 */


// Edition

if ($_REQUEST['submit']) {

    $o_Repo = new Repo();
    $o_Repo->setName($_REQUEST['sz_Repo']);
    $o_Repo->setRights($_REQUEST['rights']);
    $a_Users = explode(',', $_REQUEST['users']);
    $o_Repo->setUsers($a_Users);

    $o_Configuration = new Configuration();
    $a_Repos = $o_Configuration->getRepos();
    $a_Repos[$_REQUEST['sz_Repo']] = $o_Repo;


    $o_Configuration->setRepos($a_Repos);
    $o_Configuration->writeFile();
    $sz_Message = "File updated";

}

$o_Configuration = new Configuration();
$a_Repos = $o_Configuration->getRepos();

// Current repo
if (isset($_REQUEST['sz_Repo'])) {
    $o_Repo = $a_Repos[$_REQUEST['sz_Repo']];

    error_log('sansie $_REQUEST[sz_Repo] : ' . $_REQUEST['sz_Repo']);
    error_log('sansie $o_Repo : ' . print_r($o_Repo, true));
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Smart Gitolite Admin</title>

    <link rel="stylesheet" href="styles/style.css"/>

    <link rel="stylesheet" href="styles/bootstrap.min.css"/>

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

            <?php if (isset ($sz_Message)) echo "$sz_Message" ?>

            <form id="contact-form" method="get" action="?" name="o_EditForm">
                <fieldset>
                    <?php if ($o_Repo) : ?>

                    <h2><a><?php echo ($o_Repo->getName() !== null ? $o_Repo->getName() : "Name") ?></a></h2>
                    <hr/>
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

                    <input type="hidden" name="sz_Repo" value="<?php echo $o_Repo->getName() ?>">
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
        œ
    </div>
    <!--end footer-->

</div>
<!--end wrap-->
</body>
</html>