<?php

class Init {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up() {
		// BASE DATA
		Schema::create('authors', function($table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->string('nickname', 50)->nullable();
			$table->string('note', 200)->nullable();
			$table->timestamps();
		});
		Schema::create('translators', function($table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->string('nickname', 50)->nullable();
			$table->string('note', 200)->nullable();
			$table->timestamps();
		});
		Schema::create('compilers', function($table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->string('nickname', 50)->nullable();
			$table->string('note', 200)->nullable();
			$table->timestamps();
		});
		Schema::create('illustrators', function($table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->string('nickname', 50)->nullable();
			$table->string('note', 200)->nullable();
			$table->timestamps();
		});
		Schema::create('languages', function($table) {
			$table->increments('id');
			$table->string('name', 30);
			$table->timestamps();
		});
		Schema::create('sequences', function($table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->timestamps();
		});
		Schema::create('themes', function($table) {
			$table->increments('id');
			$table->string('name', 50);
			$table->timestamps();
		});
		Schema::create('publishers', function($table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->timestamps();
		});
		Schema::create('printhouses', function($table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->timestamps();
		});
		Schema::create('books', function($table) {
			$table->increments('id');
			$table->string('title', 100);
			$table->string('edition', 30)->nullable();
			$table->string('pub_date', 30)->nullable();
			$table->integer('volume')->nullable();
			$table->integer('pages')->nullable();
			$table->integer('sequence_id')->unsigned()->nullable();
			$table->integer('seq_num')->nullable();
			$table->string('note', 200)->nullable();
			$table->timestamps();
		});
		Schema::create('contents', function($table) {
			$table->increments('id');
			$table->integer('book_id')->unsigned();
			$table->integer('idx');
			$table->string('title', 250);
			$table->string('note', 200)->nullable();
			$table->timestamps();
			$table->foreign('book_id')->references('id')->on('books')
				->on_delete('cascade')->on_update('cascade');
		});

		// RELATIONS
		Schema::create('book_author', function($table) {
			$table->increments('id');
			$table->integer('book_id')->unsigned();
			$table->integer('author_id')->unsigned();
			$table->timestamps();
			$table->foreign('book_id')->references('id')->on('books')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('author_id')->references('id')->on('authors')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('book_compiler', function($table) {
			$table->increments('id');
			$table->integer('book_id')->unsigned();
			$table->integer('compiler_id')->unsigned();
			$table->timestamps();
			$table->foreign('book_id')->references('id')->on('books')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('compiler_id')->references('id')->on('compilers')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('book_illustrator', function($table) {
			$table->increments('id');
			$table->integer('book_id')->unsigned();
			$table->integer('illustrator_id')->unsigned();
			$table->timestamps();
			$table->foreign('book_id')->references('id')->on('books')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('illustrator_id')->references('id')->on('illustrators')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('book_language', function($table) {
			$table->increments('id');
			$table->integer('book_id')->unsigned();
			$table->integer('language_id')->unsigned();
			$table->timestamps();
			$table->foreign('book_id')->references('id')->on('books')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('language_id')->references('id')->on('languages')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('book_printhouse', function($table) {
			$table->increments('id');
			$table->integer('book_id')->unsigned();
			$table->integer('printhouse_id')->unsigned();
			$table->timestamps();
			$table->foreign('book_id')->references('id')->on('books')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('printhouse_id')->references('id')->on('printhouses')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('book_publisher', function($table) {
			$table->increments('id');
			$table->integer('book_id')->unsigned();
			$table->integer('publisher_id')->unsigned();
			$table->timestamps();
			$table->foreign('book_id')->references('id')->on('books')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('publisher_id')->references('id')->on('publishers')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('book_theme', function($table) {
			$table->increments('id');
			$table->integer('book_id')->unsigned();
			$table->integer('theme_id')->unsigned();
			$table->timestamps();
			$table->foreign('book_id')->references('id')->on('books')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('theme_id')->references('id')->on('themes')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('book_translator', function($table) {
			$table->increments('id');
			$table->integer('book_id')->unsigned();
			$table->integer('translator_id')->unsigned();
			$table->timestamps();
			$table->foreign('book_id')->references('id')->on('books')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('translator_id')->references('id')->on('translators')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('content_author', function($table) {
			$table->increments('id');
			$table->integer('content_id')->unsigned();
			$table->integer('author_id')->unsigned();
			$table->timestamps();
			$table->foreign('content_id')->references('id')->on('contents')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('author_id')->references('id')->on('authors')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('content_illustrator', function($table) {
			$table->increments('id');
			$table->integer('content_id')->unsigned();
			$table->integer('illustrator_id')->unsigned();
			$table->timestamps();
			$table->foreign('content_id')->references('id')->on('contents')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('illustrator_id')->references('id')->on('illustrators')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('content_language', function($table) {
			$table->increments('id');
			$table->integer('content_id')->unsigned();
			$table->integer('language_id')->unsigned();
			$table->timestamps();
			$table->foreign('content_id')->references('id')->on('contents')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('language_id')->references('id')->on('languages')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('content_theme', function($table) {
			$table->increments('id');
			$table->integer('content_id')->unsigned();
			$table->integer('theme_id')->unsigned();
			$table->timestamps();
			$table->foreign('content_id')->references('id')->on('contents')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('theme_id')->references('id')->on('themes')
				->on_delete('restrict')->on_update('restrict');
		});
		Schema::create('content_translator', function($table) {
			$table->increments('id');
			$table->integer('content_id')->unsigned();
			$table->integer('translator_id')->unsigned();
			$table->timestamps();
			$table->foreign('content_id')->references('id')->on('contents')
				->on_delete('cascade')->on_update('cascade');
			$table->foreign('translator_id')->references('id')->on('translators')
				->on_delete('restrict')->on_update('restrict');
		});

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('book_author');
		Schema::drop('book_compiler');
		Schema::drop('book_illustrator');
		Schema::drop('book_language');
		Schema::drop('book_printhouse');
		Schema::drop('book_publisher');
		Schema::drop('book_theme');
		Schema::drop('book_translator');
		Schema::drop('content_author');
		Schema::drop('content_illustrator');
		Schema::drop('content_language');
		Schema::drop('content_theme');
		Schema::drop('content_translator');
		Schema::drop('contents');
		Schema::drop('authors');
		Schema::drop('translators');
		Schema::drop('compilers');
		Schema::drop('illustrators');
		Schema::drop('languages');
		Schema::drop('sequences');
		Schema::drop('themes');
		Schema::drop('publishers');
		Schema::drop('printhouses');
		Schema::drop('books');
	}

}
