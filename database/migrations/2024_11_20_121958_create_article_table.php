<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Assumes a foreign key relationship with users table
            $table->foreignId('package_id')->constrained(); // Foreign key to packages table
            $table->foreignId('category_id')->constrained(); // Foreign key to categories table
            $table->foreignId('country_id')->constrained(); // Foreign key to countries table
            $table->foreignId('company_id')->constrained(); // Foreign key to companies table
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('slug', 255);
            $table->text('content');
            $table->string('description', 255);
            $table->string('image', 191);
            $table->string('alt_tag', 255);
            $table->integer('feed');
            $table->integer('most_viewed');
            $table->dateTime('publish_datetime');
            $table->string('meta_title', 191);
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->string('press_type', 10);
            $table->tinyInteger('status')->default(1); // 1 = Active, 0 = Inactive
            $table->tinyInteger('type');
            $table->string('video_url', 255)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users'); // Assuming foreign key to users
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes(); // For soft deleting articles
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
