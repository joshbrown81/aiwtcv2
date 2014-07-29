<script type="text/javascript">
	
	function delitem(itemid){

		var r=confirm("Do you really want to delete this item?");
		if (r==true){
		  window.location.href = "/main/deleteitem?itemid="+itemid;
		  }else{
		  
		  }
		}
</script>

<?php 
$userid=$_SESSION['userid'];
$query=$this->db->query("SELECT * FROM users WHERE userid='$userid'");
foreach($query->result_array() as $row){
	$fname = $row['fname'];
	$sname = $row['sname'];
	echo "<h1>YOUR WISHLIST</h1>";
}

$attributes = array('class' => 'form clearfix', 'id' => 'wishlist_create_item_form');
echo form_open('makeitem', $attributes);

	$title_data = array(
		'name' => 'title',
		'class' => 'text-input col-md-3 col-xs-12',
		'placeholder' => 'What would you like?',
	);

	echo form_input($title_data);

	$desc_data = array(
		'name' => 'description',
		'class' => 'text-input col-md-3 col-xs-12',
		'placeholder' => 'Need to describe it?',
	);

	echo form_input($desc_data);


	$link_data = array(
		'name' => 'link',
		'class' => 'text-input col-md-3 col-xs-12',
		'placeholder' => 'Where can you get it?',
	);

	echo form_input($link_data);


	$create_data = array(
	'name'		=> 'create-item',
	'id'		=> 'wishlist_create_button',
	'class'		=> 'submit col-md-3 col-xs-12',
	'value'		=> 'create',
	);

echo form_submit($create_data);
echo form_close(); ?>

<div class="errors">
	<?php if($this->session->flashdata('error')){echo "<p>".$this->session->flashdata('error')."</p>"; } ?>
</div>

<div id="wishlist-results">
<?php
$userid = $_SESSION['userid'];
/* Gets all item id's related to user */
$count = 0;
$query = $this->db->query("SELECT * FROM items WHERE userid='$userid'");
foreach($query->result_array() as $row){

if($count == 0){
	?><div class="row"><?php }
	$count++;
	?><div class="content-box col-md-4 col-xs-12"><div class="content">
	<?php 
	$itemid = $row['itemid'];
	echo "<h2>" . ucwords($itemname = $row['itemname']) . "</h2><br><p>" . $row['itemdescription'] . "<br>" . $row['itemlink'] . "</p>"; ?>

		<input type="button" onClick='delitem(<?php echo $itemid ?>)' class="submit max-width" value="delete"/>
		<?php echo form_open();
			$delete_data = array(
					'value'	=> $itemid,
				);

				echo form_hidden($delete_data); ?><?php
		echo form_close();

	?>
	</div>
	</div>
<?php
if($count == 3){
	$count = 0;
	?></div><?php
}
} 
?>
</div>
