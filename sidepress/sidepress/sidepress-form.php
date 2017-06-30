

<form method="post" id="sidepress" action="">
	
<?php wp_nonce_field('update-options'); ?>	

<script src="../wp-content/plugins/sidepress/anaa.js" type="text/javascript"></script>
<script src="../wp-content/plugins/sidepress/sidepress.js" type="text/javascript"></script>
	
<script type="text/javascript">
  sidepress_restore();
</script>	
	
<fieldset class="options" style="margin:16px"><legend>Sidepress</legend>
  <table width="100%" cellspacing="2" cellpadding="5" class="editform">
    <tr> 
      <td> 
        <h3>Define the summary</h3>
      </td>
    </tr>
    <tr> 
      <td>Number of entries 
        <input type="text" id="number" name="number" value="10">
      </td>
    </tr>
    <tr>
      <td>Adding dates 
        <input type="checkbox" name="date" value="checkbox">
      </td>
    </tr>
    <tr> 
      <td>Adding descriptions 
        <input type="checkbox" name="description" value="checkbox" checked>
      </td>
    </tr>
    <tr> 
      <td>Max size of descriptions 
        <input type="text" id="next" name="descsize" value="128">
      </td>
    </tr>
  </table>

</fieldset>


<p  style="margin:16px;">
    <input type="button" name="update" class="button" value="Update" 
          onclick="javascript:sidepress_save()"
    />
</p>

	

</form>


