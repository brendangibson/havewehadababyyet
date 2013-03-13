<?
	$url = isset($url) ? $url : "javascript:void(0)";
	$extraClass = isset($extraClass) ? $extraClass : "";
	$idStr = isset($id) ? "id=\"$id\"" : "";
?>

<a href="<?= $url ?>" class="button <?= $extraClass ?>" <?= $idStr ?> >
    <span><?=$text?></span>
</a>