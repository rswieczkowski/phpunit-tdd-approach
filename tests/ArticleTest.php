<?php

use App\Article;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
	private Article $article;

	public function setUp(): void
	{
		$this->article = new Article;
	}

	public function testTitleIsEmptyByDefault()
	{
		$this->assertEmpty($this->article->title);
	}

	public function testSlugIsEmptyWithNoTitle()
	{
		$this->assertsame('', $this->article->getSlug());
	}

	public static function titleProvider(): array
	{
		return [
			'Slug Has Spaces Replaced By Underscores' =>
				['An example article', 'An_example_article'],
			'Slug Has Whitespace Replaced By Single Underscores' =>
				["An          example \n      article", 'An_example_article'],
			'Slug Does Not Start Or End With An Underscore' =>
				['    An example article       ', 'An_example_article'],
			'Slug Does Not Have Any Non Word Characters' =>
				['Read! This! Now!', 'Read_This_Now']
		];
	}

	#[DataProvider('titleProvider')]
	public function testSlug($title, $slug)
	{
		$this->article->title = $title;

		$this->assertEquals($this->article->getSlug(), $slug);
	}
}