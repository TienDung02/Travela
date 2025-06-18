<?php

use Illuminate\Database\Seeder;
use App\Models\Category; // Đảm bảo bạn đã tạo model Category

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Xóa tất cả danh mục hiện có nếu muốn chạy lại seeder sạch
        // Category::truncate();

        $fixedCategories = [
            // Danh mục cấp 1: Nhóm sản phẩm chính
            ['name' => 'Phụ kiện Hành lý', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Thiết bị Điện tử Du lịch', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Trang phục Du lịch', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Chăm sóc Cá nhân & Y tế', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Vật dụng Cắm trại & Dã ngoại', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Sản phẩm An toàn & Bảo mật', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Vật phẩm Lưu niệm & Quà tặng', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Sách & Hướng dẫn Du lịch', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Phụ kiện cho Trẻ em', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
        ];

        // Chèn các danh mục cha trước để lấy ID
        foreach ($fixedCategories as $categoryData) {
            Category::create($categoryData);
        }

        // Lấy ID của các danh mục cha để gán cho danh mục con
        $luggageAccId = Category::where('name', 'Phụ kiện Hành lý')->first()->id;
        $electronicsId = Category::where('name', 'Thiết bị Điện tử Du lịch')->first()->id;
        $apparelId = Category::where('name', 'Trang phục Du lịch')->first()->id;
        $personalCareId = Category::where('name', 'Chăm sóc Cá nhân & Y tế')->first()->id;
        $campingId = Category::where('name', 'Vật dụng Cắm trại & Dã ngoại')->first()->id;
        $safetyId = Category::where('name', 'Sản phẩm An toàn & Bảo mật')->first()->id;
        $souvenirsId = Category::where('name', 'Vật phẩm Lưu niệm & Quà tặng')->first()->id;
        $booksId = Category::where('name', 'Sách & Hướng dẫn Du lịch')->first()->id;
        $kidsAccId = Category::where('name', 'Phụ kiện cho Trẻ em')->first()->id;


        $subCategories = [
            // Phụ kiện Hành lý
            ['name' => 'Vali', 'parent_id' => $luggageAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Balo Du lịch', 'parent_id' => $luggageAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Túi Xách & Túi Đeo Chéo', 'parent_id' => $luggageAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Túi Đựng Mỹ phẩm / Đồ dùng cá nhân', 'parent_id' => $luggageAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Túi Bọc Vali', 'parent_id' => $luggageAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Khóa hành lý', 'parent_id' => $luggageAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Thẻ hành lý', 'parent_id' => $luggageAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Dây đai hành lý', 'parent_id' => $luggageAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],

            // Thiết bị Điện tử Du lịch
            ['name' => 'Sạc dự phòng', 'parent_id' => $electronicsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Bộ chuyển đổi sạc Quốc tế', 'parent_id' => $electronicsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Loa di động', 'parent_id' => $electronicsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Tai nghe khử tiếng ồn', 'parent_id' => $electronicsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Camera hành trình', 'parent_id' => $electronicsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Gậy selfie', 'parent_id' => $electronicsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Thiết bị phát Wifi di động', 'parent_id' => $electronicsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],

            // Trang phục Du lịch
            ['name' => 'Áo Khoác Du lịch', 'parent_id' => $apparelId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Áo Thun & Polo', 'parent_id' => $apparelId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Quần Short & Dài Du lịch', 'parent_id' => $apparelId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Giày dép Du lịch', 'parent_id' => $apparelId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Đồ bơi', 'parent_id' => $apparelId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Mũ & Nón', 'parent_id' => $apparelId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Găng tay', 'parent_id' => $apparelId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],

            // Chăm sóc Cá nhân & Y tế
            ['name' => 'Bộ dụng cụ vệ sinh mini', 'parent_id' => $personalCareId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Kem chống nắng', 'parent_id' => $personalCareId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Thuốc men cá nhân & Túi y tế', 'parent_id' => $personalCareId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Bình nước du lịch', 'parent_id' => $personalCareId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Gối kê cổ', 'parent_id' => $personalCareId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Bịt mắt, bịt tai', 'parent_id' => $personalCareId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],

            // Vật dụng Cắm trại & Dã ngoại
            ['name' => 'Lều cắm trại', 'parent_id' => $campingId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Túi ngủ', 'parent_id' => $campingId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Đèn pin / Đèn lều', 'parent_id' => $campingId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Dụng cụ nấu ăn dã ngoại', 'parent_id' => $campingId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Bàn ghế dã ngoại gấp gọn', 'parent_id' => $campingId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],

            // Sản phẩm An toàn & Bảo mật
            ['name' => 'Khóa TSA', 'parent_id' => $safetyId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Túi chống trộm', 'parent_id' => $safetyId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Dụng cụ sơ cứu khẩn cấp', 'parent_id' => $safetyId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Còi báo động cá nhân', 'parent_id' => $safetyId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],

            // Vật phẩm Lưu niệm & Quà tặng
            ['name' => 'Móc khóa', 'parent_id' => $souvenirsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Bút & Sổ tay du lịch', 'parent_id' => $souvenirsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Đồ thủ công mỹ nghệ', 'parent_id' => $souvenirsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Đặc sản địa phương (đóng gói)', 'parent_id' => $souvenirsId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],

            // Sách & Hướng dẫn Du lịch
            ['name' => 'Cẩm nang du lịch', 'parent_id' => $booksId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Sách ảnh du lịch', 'parent_id' => $booksId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Bản đồ', 'parent_id' => $booksId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],

            // Phụ kiện cho Trẻ em
            ['name' => 'Ghế ngồi ô tô du lịch cho bé', 'parent_id' => $kidsAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Xe đẩy du lịch gấp gọn', 'parent_id' => $kidsAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Đồ chơi du lịch cho bé', 'parent_id' => $kidsAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Bình sữa / Túi giữ nhiệt cho bé', 'parent_id' => $kidsAccId, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
        ];

        foreach ($subCategories as $categoryData) {
            Category::create($categoryData);
        }
    }
}
