<?php
/**
 * Show a list of attachments in a long horizontal table.
 * @author $Author: holman $
 * @version $Id: attachments.php 8002 2009-04-07 11:24:23Z holman $
 */

require_once('config.inc.php');
require_once('classes/AttachmentManager.php');

$refreshDir = false;

// Check for any sub-directory request.
// Check that the requested sub-directory exists and valid.
if (isset($_REQUEST['dir'])) {
	$path = rawurldecode($_REQUEST['dir']);
	if ($manager->validRelativePath($path)) {
		$relative = $path;
	}
}

$manager = new AttachmentManager($AMConfig);

// Get the list of files and directories
$list = $manager->getFiles($_REQUEST['article_id']);


/**
 * Draw the files in a table.
 */
function drawFiles($list, &$manager)
{
    global $relative;

    foreach($list as $entry => $file)
    {
?>
    <td>
      <table width="100" cellpadding="0" cellspacing="0">
      <tr>
        <td class="block" onclick="CampsiteAttachmentDialog.select(<?php echo $file['attachment']->getAttachmentId(); ?>, '<?php echo $file['attachment']->getAttachmentUrl(); ?>', '<?php echo $file['alt']; ?>');">
          <a href="javascript:;" onclick="CampsiteAttachmentDialog.select(<?php echo $file['attachment']->getAttachmentId(); ?>, '<?php echo $file['attachment']->getAttachmentUrl(); ?>', '<?php echo $file['alt']; ?>');" title="<?php echo $file['alt']; ?>">linkable icon</a>
        </td>
      </tr>
      <tr>
        <td class="edit">
        <?php
	/*
        if ($file['image']) {
            echo $file['image'][0].'x'.$file['image'][1];
        } else {
            echo " ";
        }
	*/
        ?>
        </td>
      </tr>
      </table>
    </td>
  <?php
  }//foreach
}//function drawFiles


function drawNoResults()
{
?>
<table width="100%">
  <tr>
    <td class="noResult"><script>document.write(i18n("No Attachments Found"));</script></td>
  </tr>
</table>
<?php
} // fn drawNoResults


function drawErrorBase(&$manager)
{
?>
<table width="100%">
  <tr>
    <td class="error">Invalid base directory: <?php echo $manager->config['base_dir']; ?></td>
  </tr>
</table>
<?php
} // fn drawErrorBase
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>Image List</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/attachmentlist.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="assets/dialog.js"></script>
  <script type="text/javascript">
  /*<![CDATA[*/
      if(window.top)
          I18N = window.top.I18N;

      function hideMessage()
      {
          var topDoc = window.top.document;
          var messages = topDoc.getElementById('messages');
          if(messages)
              messages.style.display = "none";
      }

      init = function()
      {
          hideMessage();
          var topDoc = window.top.document;

      <?php
      //we need to refesh the drop directory list
      //save the current dir, delete all select options
      //add the new list, re-select the saved dir.
      if($refreshDir)
      {
          $dirs = $manager->getDirs();
      ?>
          var selection = topDoc.getElementById('dirPath');
		var currentDir = selection.options[selection.selectedIndex].text;

		while(selection.length > 0)
		{	selection.remove(0); }

		selection.options[selection.length] = new Option("/","<?php echo rawurlencode('/'); ?>");
		<?php foreach($dirs as $relative=>$fullpath) { ?>
		selection.options[selection.length] = new Option("<?php echo $relative; ?>","<?php echo rawurlencode($relative); ?>");
		<?php } ?>

		for(var i = 0; i < selection.length; i++)
		{
			var thisDir = selection.options[i].text;
			if(thisDir == currentDir)
			{
				selection.selectedIndex = i;
				break;
			}
		}
<?php } ?>
	}

	function editImage(image)
	{
		var url = "editor.php?img="+image;
		Dialog(url, function(param)
		{
			if (!param) // user must have pressed Cancel
				return false;
			else
			{
				return true;
			}
		}, null);
	}

/*]]>*/
    </script>

  <script type="text/javascript" src="../../tiny_mce_popup.js"></script>
  <script type="text/javascript" src="js/campsiteattachment.js"></script>
  <script type="text/javascript" src="assets/images.js"></script>
</head>
<body>
<?php if ($manager->isValidBase() == false) { drawErrorBase($manager); }
      elseif(count($list) > 0) { ?>
  <table>
  <tr>
<?php drawFiles($list, $manager); ?>
  </tr>
  </table>

<?php
    $firstAttachment = array_shift($list);
    if (!empty($firstAttachment)) {	?>
  <!-- automatically select the first attachment -->
  <script>
    CampsiteAttachmentDialog.select(<?php echo $firstAttachment["attachment"]->getAttachmentId(); ?>, '<?php echo $firstAttachment["attachment"]->getAttachmentUrl(); ?>', '<?php echo $firstAttachment["alt"]; ?>');
  </script>
<?php } ?>

<?php } else { drawNoResults(); } ?>
</body>
</html>