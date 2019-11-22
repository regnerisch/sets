<?php

$finder = PhpCsFixer\Finder::create()
	->in([
		__DIR__ . '/src',
		__DIR__ . '/tests',
	]);

return PhpCsFixer\Config::create()
	->setRules([
		'@PSR2' => true,
		'@Symfony' => true,
		'concat_space' => ['spacing' => 'one'],
		'declare_strict_types' => true,
	])
	->setFinder($finder);
