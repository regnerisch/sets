<?php

$finder = PhpCsFixer\Finder::create()
	->in([
		__DIR__ . '/src',
	]);

return PhpCsFixer\Config::create()
	->setRules([
		'@PSR2' => true,
		'@Symfony' => true,
		'concat_space' => ['spacing' => 'one'],
		'phpdoc_summary' => true,
		'indentation_type' => true
	])
	->setIndent("\t")
	->setFinder($finder);
