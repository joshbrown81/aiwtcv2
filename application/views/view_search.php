<?php
$entryarray = $_GET['q'];
$entryarray = unserialize($entryarray);
$type = $entryarray['type'];

if($type == "email"){
	$searchentry = $entryarray['email'];
	$check = $this->db->query("SELECT email FROM users");
		$string = "SELECT * FROM users WHERE email = '$searchentry'";
		$queryarray = array('string' => $string);

}elseif($type == "name"){
	$fname = $entryarray['fname'];
	$sname = $entryarray['sname'];
	$string = "SELECT * FROM users WHERE first_name = '$fname' AND last_name = '$sname'";
	$queryarray = array('string' => $string);
}

$querystring = $queryarray['string'];
$query = $this->db->query($querystring);
if($query->num_rows() > 0){
	foreach($query->result_array() as $row){

		$name = $row['first_name'] . ' ' . $row['last_name'];
		$location = $row['location'];
		$gravataremail = $this->encrypt->decode($row['email']);
		$useridofrow = $row['id'];
		if($useridofrow == $_SESSION['userid']){

		}else{
			?><div class="content-box col-md-3 centre-text">
			<div class="content"><?php
			echo '<h2>' . ucwords($name) . '</h2>';
			echo '<p>' . ucwords($location) . '</p>';
			?>
			<img src=<?php echo "http://www.gravatar.com/avatar/" . md5($gravataremail)?> class="gravimg">
			<p>
			<?php echo form_open('/main/invite'); 
						$options = array();
						$groupids = array();
						
						$userid = $_SESSION['userid'];
						$query = $this->db->query("SELECT groupid FROM userstogroups WHERE userid='$userid'");
						if($query->num_rows() > 0){foreach($query->result_array() as $row){
							$groupid = $row['groupid'];
							$query = $this->db->query("SELECT * FROM groups WHERE id='$groupid'");
							foreach($query->result_array() as $row){
								$groupname = ucwords($row['name']);
								array_push($options,$groupname);
								$groupid = $row['id'];
								array_push($groupids, $groupid);
							}
						}

						if($useridofrow == $userid){}else{

						echo form_dropdown('groups', $options, NULL, 'class="invite-background search"');
						echo form_hidden('useridofrow', $useridofrow);
						$this->session->set_flashdata('groupids', serialize($groupids));
						$this->session->set_flashdata('groupnames', serialize($options));

						$invite_data = array(
							'name'		=> 'invite-button',
							'class'		=> 'group-selection',
							'value'		=> '+ invite',
						);

						echo form_submit($invite_data);
						echo form_close();
						}
						?>
						</p>
			</div>
			</div><?php
		}
	}
}
}else{
	if($type === 'name'){
		echo '<p>Sorry, we couldn&#39;t find anybody with that name</p>';
	}else{
		echo '<p>Sorry, we couldn&#39;t find anybody with that email</p>';
	}
}
unset($queryarray);
unset($string);
?>