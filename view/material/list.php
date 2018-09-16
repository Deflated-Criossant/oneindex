<?php view::layout('layout')?>
<?php
function file_ico($item){
  $ext = strtolower(pathinfo($item['name'], PATHINFO_EXTENSION));
  if(in_array($ext,['bmp','jpg','jpeg','png','gif'])){
  	return "image";
  }
  if(in_array($ext,['mp4','mkv','webm','avi','mpg', 'mpeg', 'rm', 'rmvb', 'mov', 'wmv', 'mkv', 'asf'])){
  	return "ondemand_video";
  }
  if(in_array($ext,['ogg','mp3','wav'])){
  	return "audiotrack";
  }
  return "insert_drive_file";
}
?>

<?php view::begin('content');?>

<div class="mdui-container-fluid">

<?php if($head):?>
<div class="mdui-typo" style="padding: 20px;">
	<?php e($head);?>
</div>
<?php endif;?>


<div class="mdui-row">
	<ul class="mdui-list">
        <li class="mdui-list-item th">
            <div class="mdui-col-xs-4 mdui-col-sm-7 list-sort-title">文件名 <i class="mdui-icon material-icons icon-sort" data-sort="name" data-order="downward">arrow_downward</i></div>
            <div class="mdui-col-xs-4 mdui-col-sm-3 mdui-text-right list-sort-title">修改时间 <i class="mdui-icon material-icons  icon-sort" data-sort="date" data-order="downward">arrow_downward</i></div>
            <div class="mdui-col-xs-4 mdui-col-sm-2 mdui-text-right list-sort-title">大小 <i class="mdui-icon material-icons icon-sort" data-sort="size" data-order="downward">arrow_downward</i></div>
        </li>
		<?php if($path != '/'):?>
		<li class="mdui-list-item mdui-ripple">
			<a href="<?php echo get_absolute_path($root.$path.'../');?>">
			  <div class="mdui-col-xs-12 mdui-col-sm-7">
				<i class="mdui-icon material-icons">arrow_upward</i>
		    	..
			  </div>
			  <div class="mdui-col-sm-3 mdui-text-right"></div>
			  <div class="mdui-col-sm-2 mdui-text-right"></div>
		  	</a>
		</li>
		<?php endif;?>

		<?php foreach((array)$items as $item):?>
			<?php if(!empty($item['folder'])):?>
                <li class="mdui-list-item mdui-ripple" folder-sort data-sort-name="<?php e($item['name']);?>" data-sort-date="<?php echo $item['lastModifiedDateTime'];?>" data-sort-size="<?php echo $item['size'];?>">
			<a href="<?php echo get_absolute_path($root.$path.rawurlencode($item['name']));?>">
			  <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
				<i class="mdui-icon material-icons">folder_open</i>
		    	<?php e($item['name']);?>
			  </div>
			  <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']);?></div>
			  <div class="mdui-col-sm-2 mdui-text-right"><?php echo onedrive::human_filesize($item['size']);?></div>
		  	</a>
		</li>
            <?php elseif (file_ico($item)=="image"):?>
                <li class="mdui-list-item file mdui-ripple mdui-col-sm-6 mdui-col-xs-6" data-sort data-sort-name="<?php e($item['name']);?>" data-sort-date="<?php echo $item['lastModifiedDateTime'];?>" data-sort-size="<?php echo $item['size'];?>">
                    <a href="<?php echo get_absolute_path($root.$path).rawurlencode($item['name']);?>" target="_blank">
                        <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-text-truncate">
                            <i class="mdui-icon material-icons"><?php echo file_ico($item);?></i>
                            <?php e($item['name']);?>
                        </div>
                        <div class="mdui-col-sm-4 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']);?></div>
                        <div class="mdui-col-sm-2 mdui-text-right"><?php echo onedrive::human_filesize($item['size']);?></div>
                        <img class="mdui-img-fluid scrollLoading img-center" data-url="<?php echo get_absolute_path($root.$path).rawurlencode($item['name']);?>?t=400|400" alt="<?php e($item['name']);?>" src="/loading.gif">
                    </a>
                </li>
			<?php else:?>
                <li class="mdui-list-item file mdui-ripple" data-sort data-type="<?php file_ico($item)?>" data-sort-name="<?php e($item['name']);?>" data-sort-date="<?php echo $item['lastModifiedDateTime'];?>" data-sort-size="<?php echo $item['size'];?>">
			<a href="<?php echo get_absolute_path($root.$path).rawurlencode($item['name']);?>" target="_blank">
			  <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
				<i class="mdui-icon material-icons"><?php echo file_ico($item);?></i>
		    	<?php e($item['name']);?>
			  </div>
			  <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']);?></div>
			  <div class="mdui-col-sm-2 mdui-text-right"><?php echo onedrive::human_filesize($item['size']);?></div>
		  	</a>
		</li>
			<?php endif;?>
		<?php endforeach;?>
	</ul>
</div>
<?php if($readme):?>
<div class="mdui-typo mdui-shadow-3" style="padding: 20px;margin: 20px; 0">
	<div class="mdui-chip">
	  <span class="mdui-chip-icon"><i class="mdui-icon material-icons">face</i></span>
	  <span class="mdui-chip-title">README.md</span>
	</div>
	<?php e($readme);?>
</div>
<?php endif;?>
</div>
<script>
$ = mdui.JQ;

$.fn.extend({
    sortElements: function (comparator, getSortable) {
        getSortable = getSortable || function () { return this; };

        var placements = this.map(function () {
            var sortElement = getSortable.call(this),
                parentNode = sortElement.parentNode,
                nextSibling = parentNode.insertBefore(
                    document.createTextNode(''),
                    sortElement.nextSibling
                );

            return function () {
                parentNode.insertBefore(this, nextSibling);
                parentNode.removeChild(nextSibling);
            };
        });

        return [].sort.call(this, comparator).each(function (i) {
            placements[i].call(getSortable.call(this));
        });
    }
});

$(function () {
    $('.file a').each(function () {
        $(this).on('click', function () {
            var form = $('<form target=_blank method=post></form>').attr('action', $(this).attr('href')).get(0);
            $(document.body).append(form);
            form.submit();
            $(form).remove();
            return false;
        });
    });

    $('.list-sort-title').on('click', function () {
        jQuery(this).children('i').trigger("click" );
    });

    $('.icon-sort').on('click', function () {
        var sort_type = $(this).attr("data-sort"), sort_order = $(this).attr("data-order");
        var sort_order_to = (sort_order === "downward") ? "upward" : "downward";


        $('li[data-sort]').sortElements(function (a, b) {
            var data_a = $(a).attr("data-sort-" + sort_type), data_b = $(b).attr("data-sort-" + sort_type);
            var rt = data_a.localeCompare(data_b, undefined, {numeric: true});
            return (sort_order === "downward") ? 0-rt : rt;
        });

        $(this).attr("data-order", sort_order_to).text("arrow_" + sort_order_to);
        window.scrollBy(0,1);

        $('li[folder-sort]').sortElements(function (a, b) {
            var data_a = $(a).attr("data-sort-" + sort_type), data_b = $(b).attr("data-sort-" + sort_type);
            var rt = data_a.localeCompare(data_b, undefined, {numeric: true});
            return (sort_order === "downward") ? 0-rt : rt;
        });
    })

});
</script>
<?php view::end('content');?>
