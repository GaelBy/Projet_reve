<?php
$author_id = $avis->getIdAuthor();
$author_manager = new UserManager($link);
$author = $author_manager->getById($author_id)->getLogin();
$date = date('d/m/Y H:i', $avis->getDate());
$content = $avis->getContent();
$note = $avis->getNote();
require('views/avis_item.phtml');
?>