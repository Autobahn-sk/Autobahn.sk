<?php namespace AppChat\Comment\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    /*
     * October Up
     */
    public function up()
    {
        Schema::create('appchat_comment_comments', function(Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('commentable_id')->nullable()->index('commentable_id');
            $table->string('commentable_type')->nullable()->index('commentable_type');
            $table->unsignedBigInteger('creatable_id')->nullable()->index('creatable_id');
            $table->string('creatable_type')->nullable()->index('creatable_type');
            $table->text('content')->nullable();
            
            $table->unsignedBigInteger('parent_id')->nullable()->index('parent_id');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }
    
    /*
     * October Down
     */
    public function down()
    {
        Schema::dropIfExists('appchat_comment_comments');
    }
};
