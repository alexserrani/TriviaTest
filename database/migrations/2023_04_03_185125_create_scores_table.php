use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAndScoresTables extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('score');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scores');
        Schema::dropIfExists('users');
    }

    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
