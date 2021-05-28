<?php
	$array = array(
		'data' => array(
			'post' => array(
				'post_id' => 0,
				'post_title' => 'page1',
				'post_content' => '
					<h4>contents0</h4>
					<p>contentscontentststsstststsst</p>
					<script>console.log("aaaaaa")<script>
					',
				'create_at'=>'0000-00-00',
				'update_at'=>'2020-01-01',
				'post_excerpt' =>  'text',
				'post_status' => 'public',
				'post_name' => 'postA',
				'post_parent' => 1,
			),
			'term_taxonomy' => array(
				array(
					'term' => array(
						'name' => 'tagA',
						'slug' => '/tagA',
						'term_group' => 0,
					),
					'taxonomy' => 'taggable',
					'description' => 'nomal tag',
					'parent' => '',
					'count' => 10,
				),
				array(
					'term' => array(
						'name' => 'tagB',
						'slug' => '/tagB',
						'term_group' => 0,
					),
					'taxonomy' => 'taggable',
					'description' => 'nomal tag',
					'parent' => '',
					'count' => 10,
				),
				array(
					'term' => array(
						'name' => 'categoryA',
						'slug' => '/categoryA',
						'term_group' => 0,
					),
					'taxonomy' => 'category',
					'description' => 'nomal category',
					'parent' => '',
					'count' => 3,
				),
			)
		),
	);
	header("Access-Control-Allow-Origin: *");
	echo json_encode($array);

?>