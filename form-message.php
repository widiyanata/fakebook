
<form method='post' action='messages.php?view=<?php echo $view ?>'>
<h4>Send messages:</h4>
<textarea name='text' rows='8' cols='40'></textarea>
<p>
  Public <input type='radio' name='pm' value='0' checked='checked'>
</p>
<p>
  Private <input type='radio' name='pm' value='1'>
</p>
<p>
  <input type='submit' value='Send'>
</p>
</form>
