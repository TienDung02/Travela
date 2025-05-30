    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('place_media');
        Schema::create('place_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id')->constrained()->onDelete('cascade');
            $table->text('media'); // đường dẫn ảnh/video
            $table->string('media_type'); // image/video
            $table->boolean('is_primary')->default(false); // Thêm cột đánh dấu ảnh/video chính
            $table->timestamps();
            $table->softDeletes();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
            $table->dropColumn('remember_token');
        });
    }
};
