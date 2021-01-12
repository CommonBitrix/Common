<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>
 <head>
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle();?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">


	<?
	use Bitrix\Main\Page\Asset;
	Asset::getInstance()->addString("<link rel='canonical' href='https://getbootstrap.com/docs/5.0/examples/blog/'>");
	Asset::getInstance()->addString("<link href='".SITE_TEMPLATE_PATH."/assets/dist/css/bootstrap.min.css' rel='stylesheet'>");
	?>


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      img {
	      margin: 0px 20px 20px 0px;
	      float: left;
      }
    </style>


	<?
	Asset::getInstance()->addString("<link href='https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap' rel='stylesheet'>");
	Asset::getInstance()->addString("<link href='blog.css' rel='stylesheet'>");
	?>


  </head>






	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>

<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-12 text-center">
        <a class="blog-header-logo text-dark" href="#">RBC Feed</a>
      </div>
    </div>
  </header>

