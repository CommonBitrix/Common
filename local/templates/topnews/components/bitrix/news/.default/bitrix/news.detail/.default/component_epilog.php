<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader; 
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;

if (CheckUnicClick($arResult)) SaveClick($arResult);


function CheckUnicClick(&$arResult)
{
if (CModule::IncludeModule('highloadblock')) {
   $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(2)->fetch();
   $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
   $strEntityDataClass = $obEntity->getDataClass();
}

//Получение списка:
if (CModule::IncludeModule('highloadblock')) {
   $rsData = $strEntityDataClass::getList(array(
      'select' => array('ID','UF_NEWSID','UF_IP'),
      'order' => array('ID' => 'ASC'),
	  'filter' =>  array("=UF_NEWSID"=>$arResult['CODE'],"=UF_IP"=> $_SERVER['REMOTE_ADDR']),
      'limit' => '10',
   ));
}
	if ($rsData->getSelectedRowsCount()>0) return false; else return true;
}

function SaveClick(&$arResult)
{

Loader::includeModule("highloadblock"); 
$hlbl = 2; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
$entity_data_class = $entity->getDataClass(); 

   // Массив полей для добавления
   $data = array(
      "UF_NEWSID"=>$arResult['CODE'],
      "UF_IP"=> $_SERVER['REMOTE_ADDR']
   );

   $result = $entity_data_class::add($data);
	AddCount($arResult);
}

function AddCount(&$arResult)
{

$arSelect = array("ID", "NAME", "PROPERTY_NUMVIEWS");
$res = CIBlockElement::GetList(array(), array("ID"=>$arResult['ID']), false, array(), $arSelect);

$ob = $res->GetNextElement();
$arFields = $ob->GetFields();
$el = new CIBlockElement;
$arLoadProductArray = Array(
	"PROPERTY_VALUES"=> array("NUMVIEWS"=>$arFields[PROPERTY_NUMVIEWS_VALUE]+1)
  );
$res = $el->Update($arResult['ID'], $arLoadProductArray);

}
?>