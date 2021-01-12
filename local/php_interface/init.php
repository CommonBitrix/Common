<?

function My_Agent_Function()
{
CModule::IncludeModule("iblock");
$arRes = CIBlockRSS::GetNewsEx("http://static.feed.rbc.ru", 80, "/rbc/logical/footer/news.rss", "ID=3&LANG=ru&TYPE=news&LIMIT=5");

foreach($arRes['item'] as $item)
	{
	SaveNews($item['#']);
	}
   return "My_Agent_Function();";
}

function SaveNews(&$item)	{
    $el = new CIBlockElement;
    $iblock_id = 1;
	$arFile = CFile::MakeFileArray($item['enclosure'][0]['@']['url']);
	$arPreviewFile = CFile::MakeFileArray($item['enclosure'][0]['@']['url']);

    CAllFile::ResizeImage($arPreviewFile,
          array(
           "width" => 140,  // новая ширина
           "height" => 120 // новая высота
          ),
          BX_RESIZE_IMAGE_EXACT // метод масштабирования. обрезать прямоугольник без учета пропорций
        );
 	$fid = CFile::SaveFile($arPreviewFile, "commonimages");

    $fields = array(
        "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дата создания
        "IBLOCK_ID" => $iblock_id, //ID информационного блока
        "NAME" => $item['title'][0]['#'],
        "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
        "PREVIEW_TEXT" => $item['description'][0]['#'], //Анонс
        "DETAIL_TEXT"    => $item['description'][0]['#'],
		"CODE" => $item['guid'][0]['#'],
		'DETAIL_PICTURE' => $arFile,
		'PREVIEW_PICTURE' => $arPreviewFile,
		"PROPERTY_VALUES" => array('AUTHORS'=>$item['author'][0]['#'],'IMAGEPATH'=>$item['enclosure'][0]['@']['url'],'PUBDATE'=>$item['pubDate'][0]['#'])

    );
    //Результат в конце отработки
    if ($ID = $el->Add($fields)) {
    } else {
    }
}



?>