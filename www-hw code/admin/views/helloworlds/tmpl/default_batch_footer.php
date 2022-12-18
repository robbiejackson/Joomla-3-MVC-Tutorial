<?php
/**
 * Layout file for the footer component of the modal showing the batch options
 */
defined('_JEXEC') or die;
?>
<a class="btn" type="button" onclick="document.getElementById('batch-category-id').value='';document.getElementById('batch-access').value='';document.getElementById('batch-language-id').value='';document.getElementById('batch-user-id').value='';document.getElementById('batch-tag-id').value=''" data-dismiss="modal">
	<?php echo JText::_('JCANCEL'); ?>
</a>
<button class="btn btn-success" type="submit" onclick="Joomla.submitbutton('helloworld.batch');">
	<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
</button>