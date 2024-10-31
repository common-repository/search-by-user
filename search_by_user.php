<?php 
/* Plugin Name: Search by User
Description: Enables users to search posts and pages based on the author
Author: Michael Porter
Version: .1 */

add_action('restrict_manage_posts', 'sbu_restrict_manage_posts');
function sbu_restrict_manage_posts() {
	$users = get_users_of_blog();
	uasort($users,'sbu_compare_users');
	$author = $_GET['author'];
    ?>
			<select name='author' id='author' class='postform'>
				<option value=0>View all authors</option>
                <?php foreach ($users as $user) {
					print '<option value='.$user->user_id.(($author==$user->user_id)?' selected':'').'>'.$user->display_name.'</option>';
				} ?>
			</select>
    <?php
}

function sbu_compare_users($usera, $userb)
{
	$unamea = $usera->display_name;
	$unameb = $userb->display_name;
	if ($unamea == $unameb) {
		return 0;
	}
	return ($unamea < $unameb) ? -1 : 1;
}