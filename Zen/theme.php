<?php

function top() {

        global $nuked, $op, $file, $user, $theme, $bgcolor1, $bgcolor2, $bgcolor3, $page, $language;

        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
        <head>
        <title><?php echo $nuked['name']; ?> - <?php echo $nuked['slogan']; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="keywords" lang="fr" content="<?php echo $nuked['keyword']; ?>" />
        <meta name="Description" content="<?php echo $nuked['description']; ?>" />
        <meta http-equiv="content-style-type" content="text/css" />
        <link title="style" type="text/css" rel="stylesheet" href="themes/<?php echo $theme; ?>/style.css" />
        <link rel="shortcut icon"  href="<?php echo $nuked[url]; ?>/images/favicon.ico" />
        <link rel="alternate" title="Nuked-Klan RSS : Les 20 derniéres news" href="<?php echo $nuked[url]; ?>/rss/news_rss.php" type="application/rss+xml" />
        <link rel="alternate" title="Nuked-Klan RSS : Les 20 derniers articles" href="<?php echo $nuked[url]; ?>/rss/sections_rss.php" type="application/rss+xml" />
        <link rel="alternate" title="Nuked-Klan RSS : Les 20 derniers téléchargements" href="<?php echo $nuked[url]; ?>/rss/download_rss.php" type="application/rss+xml" />
        <link rel="alternate" title="Nuked-Klan RSS : Les 20 derniers liens" href="<?php echo $nuked[url]; ?>/rss/links_rss.php" type="application/rss+xml" />
        <link rel="alternate" title="Nuked-Klan RSS : Les 20 derniéres images" href="<?php echo $nuked[url]; ?>/rss/gallery_rss.php" type="application/rss+xml" />
        <link rel="alternate" title="Nuked-Klan RSS : Les 20 derniers sujets" href="<?php echo $nuked[url]; ?>/rss/forum_rss.php" type="application/rss+xml" />
        <link rel="search" type="application/opensearchdescription+xml" href="<?php echo $nuked[url]; ?>/opensearch.php" title="Nuked-Klan" />
        </head>

        <body>
        <div style="text-align:center;"><img src="themes/<?php echo $theme; ?>/images/header.png" alt="" /></div><br />
        <?php
        echo '<div class="container">'
        . '<div class="content left">';

        if ($_REQUEST['op'] == "index" && $file != "Admin" && $page != "admin") get_blok('centre');

}

function footer() {

        global $nuked, $theme, $file, $page, $user;

        $nb = nbvisiteur();
        echo '</div>';
        echo '<div class="sidebar left">';
        get_blok('droite');
        echo '</div>';

        echo '<div class="clear"></div><br />';

        if ($_REQUEST['op'] == "index" && $file != "Admin" && $page != "admin") get_blok('bas');

        ?> <br />
        <table style="margin: auto;border:2px solid #130C07;width:750px;border-radius:10px;" cellspacing="0" cellpadding="0">
        <tr><td style="border-bottom: 2px solid #130C07;height:25px;background: url(themes/<?php echo $theme; ?>/images/fond_tab.png);border-top-left-radius:9px;border-top-right-radius:9px;">&nbsp;Footer</td></tr>
        <tr><td style="background: url(themes/<?php echo $theme; ?>/images/mbg.png);text-align:center;border-bottom-left-radius:9px;border-bottom-right-radius:9px;">
        <br /><?php

        if($nuked['footmessage'] != '') echo $nuked['footmessage'] .'<br />';

        echo "Il y a&nbsp;" . $nb[0] . " visiteur(s), " . $nb[1] . " membre(s) et " . $nb[2] . " administrateur(s) en ligne .<br />Membres en ligne : ";

        $i = 0;
        $online = mysql_query("SELECT username FROM ". NBCONNECTE_TABLE ." WHERE type > 0 ORDER BY date");
        while (list($name) = mysql_fetch_row($online)) {
        	$i++;
                if ($i == $nb[3]) $sep = "";
                else $sep = ", ";

                $sq_user_flag = mysql_query("SELECT country, avatar FROM " . USER_TABLE . " WHERE pseudo = '". $name ."'");
	        list($country, $avatar) = mysql_fetch_array($sq_user_flag);
                $pays = explode(".", $country);
                if($avatar == "") $avatar_aff = '<img src="modules/Members/images/pas_image.jpg" alt="" />';
                else $avatar_aff = '<img src="'. $avatar .'" alt="" />';
                echo "<img style=\"vertical-align:middle;\" src=\"images/flags/". $country ."\" alt=\"\" title=\"". $pays[0] ."\" />&nbsp;<a href=\"index.php?file=Members&amp;op=detail&amp;autor=". urlencode($name) ."\" onmouseover=\"AffBulle('". urlencode($name) ."', '". htmlentities($avatar_aff) ."', 200)\" onmouseout=\"HideBulle()\">" . $name . "</a>" . $sep;
        }

        ?><br /><br />
        Thème du site <a href="http://www.chezyann.net" onclick="window.open(this.href,'_blank');return false;">chezyann.net</a> offert pour la communauté Nuked Klan<br />
        <br /> </td>
        </tr>
        </table><br />

        <?php
}

function block_droite($block) {
        echo '<div class="block_gauche">'
        . '<div class="header_block_gauche"><div class="block_inner">&nbsp;'. $block['titre'] .'</div></div>'
        . '<br />'. $block['content'] .'<br /></div><br />';
}

function block_centre($block) {
        $block['content'];
}

function block_bas($block) {
        global $theme;
        echo '<table style="margin: auto;border:2px solid #130C07;width:750px;border-radius:10px;" cellspacing="0" cellpadding="0">
        <tr><td style="border-bottom: 2px solid #130C07;height:25px;background: url(themes/'. $theme .'/images/fond_tab.png);border-top-left-radius:9px;border-top-right-radius:9px;">&nbsp;'. $block['titre'] .'</td></tr>
        <tr><td style="background: url(themes/'. $theme .'/images/mbg.png);text-align:center;border-bottom-left-radius:9px;border-bottom-right-radius:9px;">'
        . '<br />'. $block['content'] .'<br /></td>
        </tr>
        </table>';
}

function OpenTable() {
        echo '<div class="block_centre">'
        . '<div class="header_block_centre"><div class="block_inner">&nbsp;</div></div>';
}

function CloseTable() {
        echo '</div>';
}

function news($data) {

        global $theme;
        echo '<div class="block_centre">'
        . '<div class="header_block_centre"><div class="block_inner">&nbsp;'. _NEWSPOSTBY .' <a href="index.php?file=Members&amp;op=detail&amp;autor='. $data['auteur'] .'">'. $data['auteur'] .'</a>  '. _THE .' '. $data['date'] .' '. _AT .' '. $data['heure'] .'</div></div>'
        . '<img src="themes/'. $theme .'/images/posticon.png" alt="" />&nbsp;'. $data['titre'] .'<br /><br />'. $data['texte'] .'
        <br /><br /><a href="index.php?file=News&amp;op=index_comment&amp;news_id='. $data['id'] .'">'. _NEWSCOMMENT .'</a> ('. $data['nb_comment'] .')<br /> <br />
        </div><br />';

}

?>