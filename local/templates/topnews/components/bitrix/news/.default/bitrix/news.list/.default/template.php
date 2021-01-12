<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<main class="container">
  <div class="row">
    <div class="col-md-12">


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<article class="blog-post" style="display: table;">
        <h2 class="blog-post-title">
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" style="text-decoration: none;"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
			<?endif;?>
		</h2>
			<p class="blog-post-meta"><? echo $arItem['PROPERTIES']['PUBDATE']['VALUE']; echo (strlen($arItem['PROPERTIES']['AUTHORS']['VALUE'])>0) ? " by ".$arItem['PROPERTIES']['AUTHORS']['VALUE'] : ""; echo " ( просмотров: ".(($arItem['PROPERTIES']['NUMVIEWS']['VALUE']>0) ? $arItem['PROPERTIES']['NUMVIEWS']['VALUE'] : "0")." )";?></p>
			<img src="<?echo $arItem['PREVIEW_PICTURE']['SRC']?>" width="140px" height="120px">
        <p>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		</p>
      </article><!-- /.blog-post -->
<?endforeach;?>



<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


    </div>
  </div><!-- /.row -->
</main><!-- /.container -->
