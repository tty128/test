<?php
	$array = array(
		"current_page"=>1,
		"first_page_url"=>"http:\/\/localhost:8000\/api\/post?page=1",
		"from"=>1,
		"last_page"=>1,
		"last_page_url"=>"http:\/\/localhost:8000\/api\/post?page=1",
		"next_page_url"=>null,
		"path"=>"http:\/\/localhost:8000\/api\/post",
		"per_page"=>12,
		"prev_page_url"=>null,
		"to"=>9,
		"total"=>9,
		"data"=>array(
			array("post_id"=>9,"post_author"=>3,"post_update_author"=>null,"created_at"=>"2021-05-25 10:14:24","updated_at"=>"2021-05-25 09:14:24","post_title"=>"title9","post_content"=>"sampletext9","post_status"=>"private","post_name"=>"\/9","post_parent"=>9,"deleted_at"=>null),
			array("post_id"=>2,"post_author"=>0,"post_update_author"=>null,"created_at"=>"2021-05-25 09:14:24","updated_at"=>"2021-05-25 09:14:24","post_title"=>"title2","post_content"=>"sampletext2","post_status"=>"public","post_name"=>"\/2","post_parent"=>2,"deleted_at"=>null),
			array("post_id"=>3,"post_author"=>0,"post_update_author"=>null,"created_at"=>"2021-05-25 09:14:24","updated_at"=>"2021-05-25 09:14:24","post_title"=>"title3","post_content"=>"sampletext3","post_status"=>"public","post_name"=>"\/3","post_parent"=>3,"deleted_at"=>null),
			array("post_id"=>4,"post_author"=>0,"post_update_author"=>null,"created_at"=>"2021-05-25 09:14:24","updated_at"=>"2021-05-25 09:14:24","post_title"=>"title4","post_content"=>"sampletext4","post_status"=>"public","post_name"=>"\/4","post_parent"=>4,"deleted_at"=>null),
			array("post_id"=>1,"post_author"=>0,"post_update_author"=>null,"created_at"=>"2021-05-25 09:14:24","updated_at"=>"2021-05-25 09:14:24","post_title"=>"title1","post_content"=>"sampletext1","post_status"=>"public","post_name"=>"\/1","post_parent"=>1,"deleted_at"=>null),
			array("post_id"=>6,"post_author"=>0,"post_update_author"=>null,"created_at"=>"2021-05-25 09:14:24","updated_at"=>"2021-05-25 09:14:24","post_title"=>"title6","post_content"=>"sampletext6","post_status"=>"public","post_name"=>"\/6","post_parent"=>6,"deleted_at"=>null),
			array("post_id"=>7,"post_author"=>0,"post_update_author"=>null,"created_at"=>"2021-05-25 09:14:24","updated_at"=>"2021-05-25 09:14:24","post_title"=>"title7","post_content"=>"sampletext7","post_status"=>"public","post_name"=>"\/7","post_parent"=>7,"deleted_at"=>null),
			array("post_id"=>10,"post_author"=>0,"post_update_author"=>null,"created_at"=>"2021-05-25 09:14:24","updated_at"=>"2021-05-25 09:14:24","post_title"=>"title10","post_content"=>"sampletext10","post_status"=>"public","post_name"=>"\/10","post_parent"=>10,"deleted_at"=>null),
			array("post_id"=>5,"post_author"=>0,"post_update_author"=>null,"created_at"=>"2021-05-25 09:14:24","updated_at"=>"2021-05-25 09:14:24","post_title"=>"title5","post_content"=>"sampletext5","post_status"=>"public","post_name"=>"\/5","post_parent"=>5,"deleted_at"=>null)
		)
	);
	echo json_encode($array);
?>