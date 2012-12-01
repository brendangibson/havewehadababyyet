<h1>Admin</h1>

<form action="">
    <input type="button" value="Born" id="bornbutton" data-path="<?=$this->account->getPath()?>" <? if ($this->account->isBorn()) { ?>disabled="disabled"<?}?>/>

</form>
