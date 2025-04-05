<?php

return [
	'' => function () {
	},
	'create' => function () {
		include __DIR__ . '/../views/create.php';
		exit;
	},
	'dashboard' => function () {
		include __DIR__ . '/../views/dashboard.php';
		exit;
	},
	
];
