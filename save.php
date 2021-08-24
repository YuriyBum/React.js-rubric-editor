<?php
/**
 * @var StructureController $this
 * @var Rubric $rubric
 * @var array $postRubricator
 * @var RubricRubricator  $rubricator
 * @var integer $cityId
 * @var RubricRubricatorItem[] $rubricatorItems
 */

 $codeRubricator = (isset($postRubricator[(integer)$rubricator->id]['title']) ? HtmlHelper::encode($postRubricator[(integer)$rubricator->id]['code_rubric']) : HtmlHelper::encode($rubricator->code_rubric));

?>
<style>
 tbody td {
   width: 150px;
 }

 .itemBold {
   font-weight: 700;
 }
</style>
<small>
<script type="text/javascript" src="/assets/eed9d7bb/js/ajax-upload.js"></script>
<script type="text/javascript" src="/assets/eed9d7bb/js/facebox.js"></script>
<script type="text/javascript" src="/assets/eed9d7bb/js/jquery.color.js"></script>
<script type="text/javascript" src="/assets/eed9d7bb/js/jquery-jcrop.js"></script>
<script type="text/javascript" src="/assets/eed9d7bb/js/cropper.js"></script>
<script type="text/javascript" src="/assets/eed9d7bb/js/uploader.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
jQuery(document).ready(function()
{
    var _config = {
        originalImage: {
                            min_width : "194",
                            min_height : "188",
                            max_width : "2000",
                            max_height : "2000",
                            max_file_size : "2097152",
                        end: true
        },
        cropImage: {
                            path : "//static.gorpom.ru/images/common/main_page/c8a1ee62671026da280430484e080300.jpg",
                            width : "194",
                        end: true
        },
        saveType: "auto",
        fieldInputName: "item[27414][logo_filename]",
        paramsHash: "=Qf9tjI0kTMiozM6M3OigGdkl2dioTN6M3OicGcq5CMwMDM4ATZ0gDNwMDNwgjMhRmNyATM3YjM2UWZxEGOj9SZnFGcf5Wah12Lu9Wbt92YvMXZnFWbp9Sdy5SbvBncvdmLjlGdhR3cv8iI6kzN6M3OigGdhBnI6QjOztnOyoTY7IyctFmchB3Xw9mcjJiOxEjOz13OyUTM3kDMyoTYToyOntzOjE1OiJvcmlnaW5hbF9wYXJhbXMiO2E6NTp7czo5OiJtaW5fd2lkdGgiO3M6MzoiMTk0IjtzOjEwOiJtaW5faGVpZ2h0IjtzOjM6IjE4OCI7czo5OiJtYXhfd2lkdGgiO2k6MjAwMDtzOjEwOiJtYXhfaGVpZ2h0IjtpOjIwMDA7czoxMzoibWF4X2ZpbGVfc2l6ZSI7a=",
        showRemoveButton: 0,
        saveCallback: function(response) {},
        deleteCallback: function() {}    };

            jQuery('#upload-1463a679dd4574157b90f6b1ce2782f13bfa07bd').uploader(_config);
    });
/*]]>*/
</script>


</small>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header tabs">
        <?php $this->widget('AdminTitle', array('pretitle' => 'Управление рубрикатором')); ?>
		<?php $this->widget('TabsMenu', array('defaultTab' => 2, 'checkAccess' => true, 'menu' => $this->rubricTabs));?>
		<div class="clear"></div>
    </div>
    <!-- End .content-box-header -->

    <div class="content-box-content" style="display: block; ">
        <form action="" method="post">
            <input type="hidden" name="back_url" value="<?php echo Yii::app()->createUrl('/cmscatalog/structure/editRubricator/', array('rubricId' => $rubric->id, 'cityId' => $cityId));?>">

			<p>
				<label><?php echo Yii::t('admin', 'Название');?>:</label>
				<input class="text-input small-input ajax-form-validation" field="title" model="rubricRubricator" type="text" name="rubricators[<?php echo (integer)$rubricator->id; ?>][title]" value="<?php echo (isset($postRubricator[(integer)$rubricator->id]['title']) ? HtmlHelper::encode($postRubricator[(integer)$rubricator->id]['title']) : HtmlHelper::encode($rubricator->title)); ?>">
			</p>

			<p>
				<label><?php echo Yii::t('admin', 'Город');?>:</label>
				<?php echo HtmlHelper::dropDownList('rubricators[' .(integer)$rubricator->id . '][city_id]',
					( (!empty($rubricator->city_id)) ? (integer)$rubricator->city_id : $cityId ),
					array_replace(array(0 => Yii::t('admin', 'Все города')), HtmlHelper::listData(City::model()->actual()->findAll(), 'id', 'title')),
					array(
						'class' => 'select2',
						'id' => 'changeCity',
						'data-url' => Yii::app()->createUrl('/cmscatalog/structure/editRubricator/', array('rubricId' => $rubric->id))
					)
				); ?>
			</p>

      <p>
          <label><?php echo Yii::t('admin', 'Интерактивный рубрикатор');?>:</label>
          <textarea id="codeRubricatorField" class="text-input ajax-form-validation" style="display: none;" type="text" model="rubricRubricator"
          mid="<?php echo $rubricator->rubric_id;?>"
          type="text" name="rubricators[<?php echo (integer)$rubricator->id; ?>][code_rubric]">
             <?php echo $codeRubricator; ?>
          </textarea>
      </p>

      <p>
        <div id="Constructor"></div>
      </p>

      <p style="margin-top:40px;">
        <div id="PictureManager">
          <p>
            <label><?php echo Yii::t('admin', 'Менеджер изображений');?>:</label>
            <?php
            $this->widget('ext.EAjaxCropper.EAjaxCropper', array(
              'cropParams' => array(
                'original_params' => array(
                  'min_width' => 100,
                  'min_height' => 100,
                  'max_width' => 9999,
                  'max_height' => 9999,
                  'max_file_size' => 4096000
                ),
                'crop_params' => array(
                  'path' => '//static.gorpom.ru/images/common/rubrics/fvaprvapr.jpg',
                  'width' => PlaceInfo::CATALOG_PLACE_LOGO_WIDTH,
                  'height' => PlaceInfo::CATALOG_PLACE_LOGO_HEIGHT,
                )
              ),
              'saveType' => EAjaxCropper::AUTO_SAVE_TYPE,
              'fieldInputName' => 'rubricators[<?php echo (integer)$rubricator->id; ?>][imgfilepath]',
              'templateType' => EAjaxCropper::TEMPLATE_ONLY_PREVIEW,
              'showRemoveButton' => false,
            )); ?>

          </p>
        </div>

      </p>
      <p>
        <label><?php echo Yii::t('admin', 'Название шаблона, оставьте пустым, чтобы не сохранять как шаблон, название БЕЗ пробелов, не слово list');?>:</label>
				<input id="tmplf" class="text-input small-input ajax-form-validation" field="temlate_name" model="rubricRubricator"
        oninput="ForbideSpace()" type="text" name="rubricators[<?php echo (integer)$rubricator->id; ?>][template_name]" value="<?php echo (isset($postRubricator[(integer)$rubricator->id]['template_name']) ? HtmlHelper::encode($postRubricator[(integer)$rubricator->id]['template_name']) : HtmlHelper::encode($rubricator->template_name)); ?>">
      </p>

            <p>
                <input type="submit" value="<?php echo Yii::t('admin', 'Сохранить');?>" class="button">
            </p>

        </form>

        <div id="codeRubricatorContainer" style="display: none;"><?php print_r(htmlspecialchars_decode($codeRubricator)); ?></div>

    </div>
    <!-- End .content-box-content -->
</div>

<?php if (!empty($rubricator->id)): ?>
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<?php $this->widget('AdminTitle', array('pretitle' => 'Управление содержимым рубрикатора')); ?>
		<div class="clear"></div>
	</div>
	<!-- End .content-box-header -->

	<div class="content-box-content" style="display: block; ">
		<div class="tab-content default-tab" id="tab2" style="display: block; ">
			<?php if (Yii::app()->user->checkAccess('editRubricatorsItems')): ?>
			<form action="<?php echo Yii::app()->createUrl('/cmscatalog/structure/editRubricatorsItems', array('rubricatorId' => $rubricator->id)); ?>" method="post">
			<?php endif; ?>
			<!-- This is the target div. id must match the href of this div's tab -->
			<table>
				<thead>
				<tr>
					<th class="tdtinyfix"><input class="check-all" type="checkbox"></th>
					<th class="tdtinyfix"></th>
					<th class="tdtinyfix"></th>
					<th><?php echo Yii::t('admin', 'Название'); ?></th>
					<th><?php echo Yii::t('admin', 'Тип'); ?></th>
					<th><?php echo Yii::t('admin', 'URL'); ?></th>
					<th class="tdtinyfix"><?php echo Yii::t('admin', 'Управление'); ?></th>
				</tr>
				</thead>

				<tfoot>
				<tr>
					<td colspan="7">
						<div class="bulk-actions align-left">
							<?php if (!empty($rubricatorItems) && Yii::app()->user->checkAccess('editRubricatorsItems')): ?>
								<select url="<?php echo Yii::app()->createUrl('/cmscatalog/structure/editRubricatorsItems', array('rubricatorId' => $rubricator->id));?>" array="rubricatorsItems">
									<option value=""><?php echo Yii::t('admin', 'Выберите действие...'); ?></option>
									<option value="<?php echo Constants::NOT_ENABLED;?>" field="status"><?php echo Yii::t('admin', 'Отключить'); ?></option>
									<option value="<?php echo Constants::ENABLED;?>" field="status"><?php echo Yii::t('admin', 'Включить'); ?></option>
									<?php if (Yii::app()->user->checkAccess('deleteRubricatorsItems')): ?>
										<option value="<?php echo Constants::YES; ?>" field="is_deleted" url="<?php echo Yii::app()->createUrl('/cmscatalog/structure/deleteRubricatorsItems', array('rubricatorId' => $rubricator->id));?>" array="itemsIds" no_subarrays="1"><?php echo Yii::t('admin', 'Удалить'); ?></option>
									<?php endif; ?>
								</select>
								<a class="button do-action" href="javascript:void(0);"><?php echo Yii::t('admin', 'Применить'); ?></a>
								<input type="submit" value="<?php echo Yii::t('admin', 'Сохранить');?>" class="button">
							<?php endif; ?>
						</div>

						<div class="bulk-actions align-right">
							<?php if (Yii::app()->user->checkAccess('createRubricatorsItems')): ?>
								<a class="button" href="<?php echo Yii::app()->createUrl('/cmscatalog/structure/createRubricatorsItems', array('rubricatorId' => $rubricator->id));?>"><?php echo Yii::t('admin', 'Добавить новый пункт рубрикатора'); ?></a>
							<?php endif; ?>
						</div>

						<div class="clear"></div>
					</td>
				</tr>
				</tfoot>

				<tbody>
				<?php if (!empty($rubricatorItems)): ?>
					<?php foreach ($rubricatorItems as $item):?>
						<tr>
							<td><input class="item_id" item_id="<?php echo $item->id;?>" type="checkbox"></td>
							<td item_id="<?php echo $item->id; ?>" url="<?php echo Yii::app()->createUrl('/cmscatalog/structure/editRubricatorsItems', array('rubricatorId' => $rubricator->id));?>" array="rubricatorsItems" field="status" class="structure <?php if ($item->status == Constants::YES): ?>tddeactivate<?php else: ?>tdactivate<?php endif; ?>"></td>
							<td><?php if (Yii::app()->user->checkAccess('editRubricatorsItems')):?><input type="text" class="text-input" name="rubricatorsItems[<?php echo $item->id; ?>][sort_order]" value="<?php echo $item->sort_order; ?>" size="1" style="text-align: center;"><?php else: ?><?php echo $item->sort_order; ?><?php endif; ?></td>
							<td><a href="<?php if ($item->type == RubricRubricatorItem::TYPE_SECTION): ?><?php echo Yii::app()->createUrl('/cmscatalog/structure/rubricatorsChildrenItems', array( 'parentItemId' => $item->id, 'rubricatorId' => $rubricator->id)); ?><?php else: ?><?php echo Yii::app()->createUrl('/cmscatalog/structure/editRubricatorsItems', array( 'itemId' => $item->id, 'rubricatorId' => $rubricator->id)); ?><?php endif; ?>"><?php echo HtmlHelper::encode(($item->type == RubricRubricatorItem::TYPE_SECTION) ? $item->title : $item->template->rubric->title);?></a></td>
							<td><?php if ($item->type == RubricRubricatorItem::TYPE_SECTION): ?><?php echo Yii::t('admin', 'Раздел'); ?><?php else: ?><?php echo Yii::t('admin', 'Ссылка на рубрику'); ?><?php endif; ?></td>
							<td><?php if ($item->type == RubricRubricatorItem::TYPE_LINK): ?><a href="<?php echo $item->template->getFullUrl(); ?>" target="_blank"><?php echo $item->template->getFullUrl(); ?></a><?php endif; ?></td>
							<td>
								<!-- Icons -->
								<?php if (Yii::app()->user->checkAccess('editRubricatorsItems')): ?>
									<a href="<?php echo Yii::app()->createUrl('/cmscatalog/structure/editRubricatorsItems', array('itemId' => $item->id, 'rubricatorId' => $rubricator->id));?>" title="<?php echo Yii::t('admin', 'Редактирование');?>"><img src="<?php echo BASE_HTTP_IMAGES_URL;?>/admin/icons/pencil.png" alt="<?php echo Yii::t('admin', 'Редактирование');?>"></a>
								<?php endif;?>

								<?php if (Yii::app()->user->checkAccess('deleteRubricatorsItems')): ?>
									<a class="confirm-me" href="<?php echo Yii::app()->createUrl('/cmscatalog/structure/deleteRubricatorsItems', array('itemsIds' => $item->id, 'rubricatorId' => $rubricator->id));?>" title="<?php echo Yii::t('admin', 'Удалить');?>"><img src="<?php echo BASE_HTTP_IMAGES_URL;?>/admin/icons/cross.png" alt="<?php echo Yii::t('admin', 'Удалить');?>"></a>
								<?php endif;?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else:?>
					<tr>
						<td colspan="7">
							<?php echo Yii::t('admin', 'У данного рубрикатора отсутствует содержимое.'); ?>
						</td>
					</tr>
				<?php endif; ?>
				</tbody>

			</table>

			<?php if (Yii::app()->user->checkAccess('editRubricatorsItems')): ?>
				</form>
			<?php endif; ?>

		</div>
		<!-- End #tab1 -->

	</div>
	<!-- End .content-box-content -->

</div>
<?php endif; ?>

<script>
//Рубрикаторы для нового шаблона
//Элементы данных, по которым формируются рубрикаторы
 let startData2 = '<?php ($codeRubricator[0] == '{') ? print_r(htmlspecialchars_decode($codeRubricator)) : ""; ?>';
 let RubricatorData = [];
 let ItemsList = [];
 let GroupsList = new Map();
 let wrongImg = 'Изображение или иконка должны быть с сайта static.gorpom.ru, воспользуйтесь формой на этой странице' +
 + 'или на вкладке SEO-шаблоны вкладок ПС заведения';

 var parser = new DOMParser();
 let downIconStr = '<svg aria-hidden="true" class="Icon Icon--dropdown Icon--big"><use xlink:href="#icon-dropdown"></use></svg>';
 let rightIconStr = '<svg aria-hidden="true" class="Icon Rubricator__DropDownItemArrow Icon--menu-right Icon--massive NHFilters"><use xlink:href="#icon-menu-right"></use></svg>';
 let massIconStr = '<svg aria-hidden="true" class="Icon Icon--arrow Icon--massive"><use xlink:href="#icon-arrow"></use></svg>';
 let dropIcon = parser.parseFromString(downIconStr, "image/svg+xml");

 //ItemsList.push("parentId", "id", "img", "title", "type", "url", "bold");
//id рубрики и города, используется при формировании id элементов
 let cRubric = "<?php echo (integer)$rubricator->id; ?>";
 let cCity = "<?php echo (!empty($rubricator->city_id)) ? (integer)$rubricator->city_id : $cityId; ?>";
   //RubricatorData.push(["name", "id", "img", "url"]);

   function ForbideSpace () {
     let
     field = document.getElementById('tmplf'),
     val = field.value;
     field.value = val.toString().replace(" ", "");
     if (val == 'list')
     field.value = "";
   }


 function ExtractListJson() {
   let dtt = document.getElementById("codeRubricatorField").innerHTML;
   //console.log(dtt);
   try {
      let dataList = JSON.parse(dtt);
      let rrs = dataList.Rubricators;
      let newRRData = [];
      let newItemData = [];
      //console.log(rrs);
      rrs.forEach((rr) => {
        newRRData.push([rr.name, rr.id, rr.img, rr.url, (rr.imgType) ? rr.imgType : "icon", (rr.sortIndex) ? rr.sortIndex : 0]);
      });
        RubricatorData = newRRData;

      let itms = dataList.Items;
 //ItemsList.push("parentId", "id", "img", "title", "type", "url", "bold");
      itms.forEach((itm) => {
        newItemData.push([itm.parentId, itm.id, itm.img, itm.title, itm.type, itm.url, itm.bold, itm.rubricator,itm.ImgType, (itm.sortIndex) ? itm.sortIndex : 0]);
      });
      ItemsList = newItemData;
      //console.log(newItemData);
   } catch (e) {
        return false;
    }
 }

 function RenderListJson() {
   let container = document.createElement('p');
   let jsonRes = '{"Rubricators": [], "Items" : []}';
   let jsonRow = '';
   let jsonItems = '';
   let rub = JSON.parse(jsonRes);
   RubricatorData.forEach((item, i) => {
       /*let row = JSON.stringify({
         "name" : item[0],
         "id" : item[1],
         "img" : ImgUrl(item[2]),
         "url" : item[3]
       });*/
       let row = '{"name" :"'+item[0]+'","id":"'+item[1]+'","img" :"'+ ImgUrl(item[2]) +'","url":"'+((item[3]) ? item[3].toString() : null) +'","imgType":"'+((item[4]) ? item[4] : 'icon') +'","sortIndex":"'+((item[5]) ? item[5] : 0)+'" }';
       if (i < (RubricatorData.length - 1)) row +=',';
       jsonRow +=row;
       rub.Rubricators.push(row);
   });
//ItemsList.push("parentId", "id", "img", "title", "type", "url", "bold", "rubricator", "ImgType");
   ItemsList.forEach((item, i) => {
     //console.log(item);
     let row = '{"parentId":"'+ item[0]
     +'", "id":"'+ item[1]
     +'","img":"'+ ImgUrl(item[2])
     +'","title":"'+ item[3]
     +'","type":"'+ item[4]
     +'","url":"'+ item[5]
     +'","bold":"'+ item[6]
     +'","rubricator":"'+ ((item[7]) ? item[7] : exRubricator(item[1]))
     +'","ImgType":"'+ item[8]
     +'","sortIndex":"'+ item[9]
     +'"}';
     if (i < (ItemsList.length - 1)) row +=',';
     jsonItems += row;
     rub.Items.push(row);

   });

   jsonRes = '{"Rubricators": ['+jsonRow+'], "Items" : ['+jsonItems+']}';
   //jsonRes = JSON.stringify(rub);
   /*jsonRes += JSON.stringify({
     "Rubricators" : jsonRow,
   });*/
   container.innerHTML = jsonRes;
   return container;
 }

 function SetupResultJson() {
   document.getElementById("codeRubricatorField").innerHTML = RenderListJson().innerHTML;
 }
//Получение массивов данных. Получает их из сформированного html (хранится в базе он)
function ExtractList() {
    RubricatorData = [];
    ItemsList = [];
    let ParentContainer = document.getElementById("codeRubricatorContainer");
    let Rubricators = Array.from(ParentContainer.getElementsByClassName("FastLinks__item"));
    //console.log(Rubricators);
    //Список рубрикаторов
    Rubricators.forEach((rr) => {
      let rubName = Array.from(rr.getElementsByClassName("Button__text"))[0].innerHTML;
      let rubId = rr.id;
      let rubImg = Array.from(rr.getElementsByTagName("a"))[0].style.backgroundImage;
      let rubUrl = rr.getAttribute('lnk');
      //console.log(rubUrl);
      RubricatorData.push([rubName, rubId, rubImg, rubUrl]);
    });


    //Список элементов
    let modals = Array.from(ParentContainer.getElementsByClassName("Rubricator__DropDownItem"));
    //console.log(modals);
    modals.forEach((item, i) => {
      if (!item.classList.contains("Rubricator__DropDownItem--title")){
      let itemType = item.getAttribute("type");
      let itemParent = item.getAttribute("parent");
      let itemTitle = item.getAttribute("title");
      let itemHref = item.getAttribute("href");
      let itemIcon = item.style.backgroundImage;
      let itemId = itemParent + "_" + itemType + "_" + i;
      let itemB = item.getAttribute("bold");
      let itemRR = exRubricator(itemId);
      ItemsList.push([itemParent, itemId, itemIcon, itemTitle, itemType, itemHref, itemB, itemRR]);
      //console.log("img: " + itemIcon);
      //console.log("parent " + itemParent);
    }

    });
    //console.log(ItemsList);

    return RubricatorData;
}


//Получить часть массива элементов рубрикатора. Получает значение и номер колонки, по которому искать
//Возвращает новый массив
function GetItemsList (selectorId, index) {
  let resItems = [];
  ItemsList.forEach((item) => {
    if(item[index] == selectorId)
    resItems.push(item);
  });
  return resItems;
}
//Получить часть массива рубрикаторов. Получает значение и номер колонки, по которому искать
//Возвращает новый массив, как правило из единственного элемента GetRubricator (selectorId, index)[0]
function GetRubricator (selectorId, index) {
  let resItems = [];
  RubricatorData.forEach((item) => {
    if(item[index] == selectorId)
    resItems.push(item);
  });
  return resItems;
}

//Получить id рубрикатора по id элемента
//Получает id элемента, возвращает id рубрикатора
function exRubricator(str) {
  let dats = str.split("_");
  let res = dats[0] + "_" + dats[1] + "_"+dats[2]+ "_" + dats[3];
  return res;
}
//Преобразует ссылку на изображение в значение элемента background-image
function ImgAttribute(url) {
  return 'url("'+url+'")';
}
//Функция обратная предыдущей
function ImgUrl(arg) {
  let subRes = arg.replace('url("', '');
  return subRes.replace('")', '');
}

function SetupResult() {
  document.getElementById("codeRubricatorField").innerHTML = RenderList().innerHTML;
}

function StrLastDigit(str) {
  let
  comps = Array.from(str.split("_")),
  itms = Array.from(comps[comps.length - 1]),
  res = "";
  itms.forEach((item) => {
    if (parseInt(item) == parseInt(item))
    res += "" + item;
  });
  return (parseInt(res) == parseInt(res)) ? parseInt(res) : 0;
}

function SetupDefaultIndexes(delta = 1) {
  RubricatorData.forEach((rr, i) => {
    rr[5] = (i * delta);
  });
  ItemsList.forEach((itm, i) => {
    itm[9] = (i * delta);
  });
  SetupResultJson();
  return true;
}

function SortAllByIndex() {
  RubricatorData.sort(function (a, b) {
    if (parseInt(a[5]) > parseInt(b[5])) return 1;
    if (parseInt(a[5]) == parseInt(b[5])) return 0;
    if (parseInt(a[5]) < parseInt(b[5])) return -1;
  });
  ItemsList.sort(function (a, b) {
    if (parseInt(a[9]) > parseInt(b[9])) return 1;
    if (parseInt(a[9]) == parseInt(b[9])) return 0;
    if (parseInt(a[9]) < parseInt(b[9])) return -1;
  });
  SetupResultJson();
  return true;
}

/*window.onload = function () {
  ExtractList();
  let readyContainer = document.getElementById("codeRubricatorContainer");
  readyContainer.innerHTML = RenderList().innerHTML;
  document.getElementById("codeRubricatorContainer").style.display='block';
}*/

</script>

<script type="text/babel">
  class RubricatorConstructor extends React.Component {
    constructor(props) {
     super(props);
      this.state = {
        rubricators: RubricatorData,
        items: ItemsList,
        shablons: []
      };
     };

     componentDidMount () {
       ExtractListJson();
       //document.getElementById("codeRubricatorContainer").style.display='block';
       this.setState({
         rubricators: RubricatorData,
         items: ItemsList
       });

       this.LoadTemplatelist();

     }
  <?php //Функция асинхронно загружает список шаблонов ?>
     LoadTemplatelist() {
       let templateField = document.getElementById("templateSelect");
       fetch(document.location.href + "?templatename=list")
       .then(res => res.text())
       .then((res) => {
         let proc = new DOMParser().parseFromString(res, "text/html"),
         listData = Array.from(proc.getElementsByTagName('tname')),
         options = [];
         listData.forEach((item) => {
           let itm = item.innerHTML;
           options.push(itm);
         });
         this.setState({
           shablons: options
         });
         //console.log(this.state.shablons);
       });
     }

     LoadFromTemplate() {
       let val = document.getElementById("templateSelect").value;
       //console.log(val);
       if (confirm("Все рубрикаоры будут перезаписаны! Продолжить?")) {
         fetch (document.location.href + "?templatename=" + val)
         .then(response => response.text())
         .then((res) => {
           let proc = new DOMParser().parseFromString(res, "text/html"),
           listData = Array.from(proc.getElementsByTagName('tdata'))[0].innerHTML;
           //console.log(listData);
           let df = document.getElementById("codeRubricatorField");
           df.innerHTML = listData;
           ExtractListJson();
           this.setState({
             rubricators: RubricatorData,
             items: ItemsList
           });
         });
       }
     }

     RehideRow (currentId, replaceId) {
       document.getElementById(currentId).style.display='none';
       document.getElementById(replaceId).style.display='';
     }

     RubricatorAdd() {
         let nums = [];

        this.state.rubricators.forEach((rr) => {
         let cId = StrLastDigit(rr[1]);
         //console.log(cId);
         nums.push(cId);
       });

       let newNum = (nums.length > 0) ? Math.max.apply(null, nums) + 1 : 0;

       let NewRRId = "Rubricator_" + cRubric + "_" + cCity + "_" + newNum;
       //console.log(NewRRId);
       let
       newName = document.getElementById("RRAddName").value,
       newUrl = document.getElementById("RRAddUrl").value,
       newImg = document.getElementById("RRAddImg").value,
       newImgType = document.getElementById("RRAddImgType").value,
       newIndex = document.getElementById("RRAddIndex").value;
      if(newImg.indexOf('static.gorpom') > 0  || newImg == "") {
       if (newName && newName != '' && newName != null) {
         //console.log(newName);
         //RubricatorData.push(["name", "id", "img", "url"]);
         let sortindex = (newIndex) ? newIndex : 0;
         RubricatorData.push([newName, NewRRId, newImg, newUrl, newImgType, sortindex]);
         SortAllByIndex();
         SetupResultJson();
         this.setState({
           rubricators: RubricatorData,
           items: ItemsList
         });
       } else {
         alert('Необходимо указать имя!');
       }
     } else {
       alert(wrongImg);
     }


     }

     RubricatorUpdate(itId) {
       let
       editId = itId + "_edit",
       rowId = itId + "_row";
       //console.log(editId);
       let
       newName = document.getElementById(editId + "_name").value,
       newUrl = document.getElementById(editId + "_url").value,
       newImg = document.getElementById(editId + "_img").value,
       newImgType = document.getElementById(editId + "_ImgType").value,
       newIndex = document.getElementById(editId + "_index").value;
       if(newImg.indexOf('static.gorpom') > 0 || newImg == "") {
       RubricatorData.forEach((rr) => {
         if (rr[1] == itId) {
           //console.log(rr[1]);
           rr[0] = (newName == '') ? rr[0] : newName;
           rr[2] = (newImg == '') ? rr[2] : newImg;
           rr[3] = (newUrl == '') ? rr[3] : newUrl;
           rr[4] = (newImgType != rr[4]) ? newImgType : rr[4];
           rr[5] = (newIndex) ? newIndex : rr[5];
         }

       });
       SortAllByIndex();
       this.setState({
         rubricators: RubricatorData,
         items: ItemsList
       });
       SetupResultJson();
       this.RehideRow( editId, rowId);
     } else {
       alert(wrongImg);
     }
     }

     RubricatorDelete(itId) {
       let newRR = [];
       RubricatorData.forEach((rr) => {
         if (rr[1] != itId) {
           newRR.push(rr);
         }
       });
       //Удаляем дочерние элменты рубрикатора
       let newItems = []
       ItemsList.forEach((im) => {
         if (im[7] != itId) {
           newItems.push(im);
         }
       });
       ItemsList = newItems;
       RubricatorData = newRR;
       this.setState({
         rubricators: RubricatorData,
         items: ItemsList
       });
       SetupResultJson();
       alert(wrongImg);
     }

     ItemAdd() {
       let
       newName = document.getElementById("RRItemName").value,
       newParent = document.getElementById("RRItemdParent").value,
       newType = document.getElementById("RRItemType").value,
       newUrl = document.getElementById("RRItemUrl").value,
       newImg = document.getElementById("RRItemImg").value,
       newImgType = document.getElementById("RRItemImgType").value,
       newBold = document.getElementById("RRItemBold").value,
       newIndex = document.getElementById("RRItemIndex").value;
       if(newImg.indexOf('static.gorpom') > 0  || newImg == "") {
      //Вычисление id
       let parentItems = GetItemsList (newParent, 0);
       let nums = [];
       let idType = (newType == "group") ? "group" : "item";
      parentItems.forEach((rr) => {
          let cId =  StrLastDigit(rr[1]);
          nums.push(cId);
      });
       let newNum = (nums.length > 0) ? Math.max.apply(null, nums) + 1 : 0;
       let NewItemId = newParent + "_" + idType + newNum;
       let currentRR = exRubricator(NewItemId);
       //Конец - вычисление id

       if (newName && newName != '' && newName != null) {
         //console.log(newName);
         //ItemsList.push("parentId", "id", "img", "title", "type", "url", "bold", "rubricator", "ImgType");
         ItemsList.push([newParent, NewItemId, newImg, newName, newType, newUrl, newBold, currentRR, newImgType, (newIndex) ? newIndex : 0]);
         SortAllByIndex();
         SetupResultJson();
         this.setState({
           rubricators: RubricatorData,
           items: ItemsList
         });
       } else {
         alert('Необходимо указать имя!');
       }
       this.ItemFilter();
      } else {
       alert(wrongImg);
      }
     }

     ItemUpdate(itId) {
       let
       rowId = itId + "_row",
       editId = itId + "_edit",
       newItems = [];

       let
       newName = document.getElementById(editId + "_Name").value,
       //newParent = document.getElementById(editId + "_Parent").value,
       newType = document.getElementById(editId + "_Type").value,
       newUrl = document.getElementById(editId + "_Url").value,
       newImg = document.getElementById(editId + "_Img").value,
       newImgType = document.getElementById(editId + "_ImgType").value,
       newBold = document.getElementById(editId + "_Bold").value,
       newIndex = document.getElementById(editId + "_Index").value;
       let currentRR = exRubricator(itId);
       if(newImg.indexOf('static.gorpom') > 0  || newImg == "") {

        //ItemsList.push("parentId", "id", "img", "title", "type", "url", "bold", "rubricator");
       ItemsList.forEach((item) => {
           if (item[1] == itId) {
             //console.log(item[1]);
            if (newImg != '') item[2] = newImg;
            if (newName != '') item[3] = newName;
            if (newType != item[4]) item[4] = newType;
            if (newUrl != '') item[5] = newUrl;
            if (newBold != item[6]) item[6] = newBold;
            if (newImgType != item[8]) item[8] = newImgType;
            if (newIndex != item[9] && newIndex != "") item[9] = newIndex;
         }

       });
       SortAllByIndex();
       SetupResultJson();
       this.setState({
         rubricators: RubricatorData,
         items: ItemsList
       });
       this.RehideRow( editId, rowId);
       this.ItemFilter();
     } else {
       alert(wrongImg);
     }
     }

     ItemDelete(itId) {
       let
       rowId = itId + "_row",
       editId = itId + "_edit",
       newItems = [];

       ItemsList.forEach((item) => {
         //console.log(item[1]);
         //console.log(itId);
         if (item[1] != itId) {
           newItems.push(item);
         }
       });
       ItemsList = newItems;

       SetupResultJson();
       this.setState({
         rubricators: RubricatorData,
         items: ItemsList
       });

       //console.log(rowId);
       this.RehideRow.bind(this, editId, rowId);
       this.ItemFilter();
     }

     ItemFilter () {
       let filter = document.getElementById("ParentFilterList");
       let fValue = filter.value;
       console.log("filter: " + fValue);
       ItemsList.forEach((item) => {
         if(item[0] == fValue) {
           console.log(item);
           document.getElementById(item[1] + "_row").style.display='';
         } else {
           document.getElementById(item[1] + "_row").style.display='none';
         }
       });
      //Задаем значение по умолчанию в форме добавления элемента - такое же, как выбрано в фильтре
       let newAddFilter = document.getElementById("RRItemdParent");
       let opts = Array.from(newAddFilter.getElementsByTagName('option'));
       opts.forEach((opt) => {
         opt.selected = (opt.value == fValue);
       });

       //Выделяем непосредственно дочерние элементы

     }

    render() {

        //RubricatorData.push(["name", "id", "img", "url"]);
      let
      rrs = [],
      rrItems = [],
      parentsList = [],
      parentsListCode = [],
      templatesList = [],
      templs = this.state.shablons,
      rrList = this.state.rubricators,
      itemList = this.state.items;

      parentsList.push(
        <option value={""} disabled selected>{"Выберите группу"}</option>
      );

      templs.forEach((tmpl) => {
        templatesList.push(
          <option value={tmpl}>{tmpl}</option>
        );
      });

      rrList.forEach((item) => {
        let
        rowId = item[1] + "_row",
        editId = item[1] + "_edit";

        let filter = document.getElementById("ParentFilterList");
        let ValueCheck = (filter.value == item[1]);
        let ValueIcon = (item[4] == "image") ? "Картинка" : "Иконка";
        let ValueIndex = (item[5]) ? item[5] : 0;


        parentsList.push(
          <option value={item[1]} selected={ValueCheck}>Рубрикатор - {item[0]}</option>
        );
        parentsListCode.push([item[0], item[1]]);

        rrs.push(
          <tr id={rowId} rubId={item[1]}>
           <td>{item[0]}
           </td>
           <td>{item[3]}
           </td>
           <td>{ImgUrl(item[2])}
           </td>
           <td>{ValueIcon}
           </td>
           <td>{ValueIndex}
           </td>
          <td>
            <button type={"button"} onClick={this.RehideRow.bind(this, rowId, editId)}>Изменить</button>
          </td>
          <td>
            <button type={"button"} onClick={this.RubricatorDelete.bind(this, item[1])}>Удалить</button>
          </td>
          </tr>);
        rrs.push(
          <tr id={editId} rubId={item[1]} style={{display: 'none'}}>
          <td><input id={editId + "_name"} type={"text"} placeholder={"Название"}></input>
          </td>
          <td><input id={editId + "_url"} type={"text"} placeholder={"Ссылка"}></input>
          </td>
          <td><input id={editId + "_img"} type={"text"} placeholder={"Изображение"}></input>
          </td>
          <td><select id={editId + "_ImgType"}>
          <option value="icon" selected={(item[4] != "image")}>Иконка</option>
          <option value="image" selected={(item[4] == "image")}>Изображение</option>
          </select>
          </td>
          <td><input id={editId + "_index"} type={"number"}></input>
          </td>
          <td>
            <button type={"button"} onClick={this.RubricatorUpdate.bind(this, item[1])}>Сохранить</button>
          </td>
          <td>
            <button type={"button"} onClick={this.RehideRow.bind(this, editId, rowId)}>Отменить</button>
          </td>
          </tr>
        );
      });


   //ItemsList.push("parentId", "id", "img", "title", "type", "url", "bold", "rubricator", "ImgType");

      itemList.forEach((item, i, arr) => {

        let
        rowId = item[1] + "_row",
        editId = item[1] + "_edit";

        let firstParent = (document.getElementById("ParentFilterList")) ? document.getElementById("ParentFilterList").value : arr[0][0];
        //console.log(firstParent);

        let parentRR = GetRubricator (item[7], 1);

        if(item[4] == "group" && parentRR.length > 0) {
          parentsList.push(
            <option value={item[1]}>{item[3]}, рубрикатор: {parentRR[0][0]}</option>
          );
          parentsListCode.push([item[0], item[1]]);
        }
        //console.log(parentsListCode);
        let parentNames = GetItemsList (item[0], 1);
        if (parentNames.length = 0) parentNames = GetItemsList (item[0], 7);
        //console.log("parentNames: ");
        //console.log(parentNames);
        //if (parentName) console.log(parentName[3]);
        let parentN = '(parentNames) ? parentName[3]:item[3]';
        //console.log(item[4]);
        let itemType = (item[4] == "group") ? "Группа" : "Элемент";
        let itemBold = (item[6] == "1") ? "Да" : "Нет";
        let itemIType = (item[8] == "image") ? "Изображение" : "Иконка";
        let itemIndex = (item[9]) ? item[9] : 0;
        //console.log("Жирный: " + itemIType);
        rrItems.push(
          <tr id={rowId} style={{display: (firstParent == item[0]) ? '' : 'none'}}>
           <td>{item[3]}
           </td>
           <td>{itemType}
           </td>
           <td>{(item[5] != null && item[5] != "") ? item[5] : "Не задана"}
           </td>
           <td>{(item[2] != null && item[2] != "") ? item[2] : "Не задано"}
           </td>
           <td>{itemIType}
           </td>
           <td>{itemBold}
           </td>
           <td>{itemIndex}
           </td>
           <td><button type={"button"} onClick={this.RehideRow.bind(this, rowId, editId)}>Изменить</button>
           </td>
           <td><button type={"button"} onClick={this.ItemDelete.bind(this, item[1])}>Удалить</button>
           </td>
          </tr>
        );
        rrItems.push(
          <tr id={editId} style={{display: 'none'}}>
          <td><input id={editId + "_Name"} type={"text"} placeholder={"Название"}></input></td>
          <td><select id={editId + "_Type"} type={"text"} placeholder={"Тип"}>
          <option value={"single"}>Элемент</option>
          <option value={"group"}>Группа</option>
          </select></td>
          <td><input id={editId + "_Url"} type={"text"} placeholder={"Ссылка"} ></input></td>
          <td><input id={editId + "_Img"} type={"text"} placeholder={"Изображение"}></input></td>
          <td><select id={editId + "_ImgType"}>
          <option value="icon" selected={(item[8] != "image")}>Иконка</option>
          <option value="image" selected={(item[8] == "image")}>Изображение</option>
          </select></td>
          <td><select id={editId + "_Bold"}>
          <option value="0" selected={(item[6] != "1")}>Нет</option>
          <option value="1" selected={(item[6] == "1")}>Да</option>
          </select></td>
          <td><input id={editId + "_Index"} type={"number"} placeholder={"Индекс"}></input></td>
          <td><button type={"button"} onClick={this.ItemUpdate.bind(this, item[1])}>Сохранить</button>
          </td>
          <td><button type={"button"} onClick={this.RehideRow.bind(this, editId, rowId)}>Отменить</button>
          </td>
          </tr>
        );

      });

      return <table>
                <tbody style={{display: 'block'}}>
                <tr>
                   <th>Загрузить из шаблона</th>
                   <th><select id={"templateSelect"}>{templatesList}</select></th>
                   <th><button type={"button"} onClick={this.LoadFromTemplate.bind(this)}>Загрузить</button></th>
                </tr>
                <tr>
                 <th><h3>Рубрикаторы</h3></th>
                 </tr>
                 <tr>
                <td><b>Название</b></td>
                <td><b>Ссылка</b></td>
                <td><b>Изображение</b></td>
                <td><b>Тип</b></td>
                <td><b>Индекс</b></td>
                <td><b>Править</b></td>
                </tr>
                {rrs}
                <tr>
                 <td><input id={"RRAddName"} type={"text"} placeholder={"Название"}></input></td>
                 <td><input id={"RRAddUrl"} type={"text"} placeholder={"Ссылка"}></input></td>
                 <td><input id={"RRAddImg"} type={"text"} placeholder={"Изображение"}></input></td>
                 <td><select id={"RRAddImgType"}>
                 <option value="icon" selected>Иконка</option>
                 <option value="image" >Изображение</option>
                 </select></td>
                 <td><input id={"RRAddIndex"} type={"number"}></input></td>
                 <td><button type={"button"} onClick={this.RubricatorAdd.bind(this)}>Добавить</button></td>
                </tr>
                </tbody>
                <tbody style={{display: 'block'}}>
                <tr>
                 <th><h3>Элементы</h3></th>
                 </tr>
                 <tr>
                 <th><b>Группа:</b></th><th><b><select id={"ParentFilterList"} onChange={this.ItemFilter.bind(this)}>
                 {parentsList}</select></b></th>
                </tr>
                <tr>
                 <td>Название</td>
                 <td>Тип</td>
                 <td>Ссылка</td>
                 <td>Изображение</td>
                 <td>Тип</td>
                 <td>Жирный</td>
                 <td>Индекс</td>
                </tr>
                {rrItems}
                </tbody>
                <tbody style={{display: 'block'}}>
                <tr>
                 <th><h3>Добавить элемент</h3></th>
                </tr>
                <tr>
                 <td><b>Название</b></td>
                 <td><b>Группа</b></td>
                 <td><b>Тип</b></td>
                 <td><b>Ссылка</b></td>
                 <td><b>Изображение</b></td>
                 <td><b>Тип изображения</b></td>
                 <td><b>Жирный</b></td>
                 <td>Индекс</td>
                </tr>
                <tr>
                 <td><input id={"RRItemName"} type={"text"} placeholder={"Название"}></input></td>
                 <td><select id={"RRItemdParent"} type={"text"} placeholder={"Родитель"}>
                 {parentsList}</select></td>
                 <td><select id={"RRItemType"} type={"text"} placeholder={"Тип"}>
                 <option value={"single"}>Элемент</option>
                 <option value={"group"}>Группа</option>
                 </select></td>
                 <td><input id={"RRItemUrl"} type={"text"} placeholder={"Ссылка"}></input></td>
                 <td><input id={"RRItemImg"} type={"text"} placeholder={"Изображение"}></input></td>
                 <td><select id={"RRItemImgType"} type={"text"} >
                 <option value="icon" selected>Иконка</option>
                 <option value="image">Изображение</option>
                 </select></td>
                 <td><select id={"RRItemBold"} type={"text"} placeholder={"Жирный"}>
                  <option value={0}>Нет</option>
                  <option value={1}>Да</option>
                 </select></td>
                 <td><input id={"RRItemIndex"} type={"number"}></input></td>
                 <td><button type={"button"} onClick={this.ItemAdd.bind(this)}>Добавить</button></td>
                </tr>
                </tbody>
             </table>;
    }
  }

window.onload = () => {
  ReactDOM.render(
    <RubricatorConstructor />,
    document.getElementById("Constructor")
  );
}
</script>
