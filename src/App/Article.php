<?php

namespace App;

class Article
{
	public string $title = '';

	public function getSlug(): string
	{
		$slug = trim($this->title);
		$slug = preg_replace('/\s+/', '_', $slug);

		return preg_replace('/\W+/', '', $slug);
	}
}