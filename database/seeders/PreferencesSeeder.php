<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Preference;

class PreferencesSeeder extends Seeder
{
    public function run()
    {
        Preference::insert([
            ['name' => 'Ẩm thực', 'description' => 'Khám phá các món ăn đặc sản và ẩm thực địa phương.'],
            ['name' => 'Thể thao & Phiêu lưu', 'description' => 'Trải nghiệm các hoạt động thể thao mạo hiểm như leo núi, nhảy dù, lướt sóng.'],
            ['name' => 'Di tích lịch sử & Văn hóa', 'description' => 'Tham quan các địa danh lịch sử, bảo tàng và di tích văn hóa.'],
            ['name' => 'Nghệ thuật & Giải trí', 'description' => 'Thưởng thức các buổi biểu diễn nghệ thuật, xem phim, kịch và âm nhạc.'],
            ['name' => 'Thiên nhiên & Sinh thái', 'description' => 'Khám phá thiên nhiên, công viên quốc gia và khu bảo tồn sinh thái.'],
            ['name' => 'Mua sắm', 'description' => 'Tham quan các trung tâm thương mại, chợ địa phương và cửa hàng thời trang.'],
            ['name' => 'Thư giãn & Nghỉ dưỡng', 'description' => 'Tận hưởng các khu nghỉ dưỡng, suối nước nóng và bãi biển đẹp.'],
            ['name' => 'Cắm trại & Dã ngoại', 'description' => 'Trải nghiệm cắm trại ngoài trời và các hoạt động dã ngoại thú vị.'],
            ['name' => 'Khám phá hang động', 'description' => 'Tham quan các hang động nổi tiếng và kỳ bí.'],
            ['name' => 'Lễ hội & Sự kiện', 'description' => 'Tham gia các lễ hội văn hóa, âm nhạc và sự kiện đặc biệt.'],
            ['name' => 'Du thuyền & Lặn biển', 'description' => 'Trải nghiệm du thuyền sang trọng và khám phá đại dương qua lặn biển.'],
            ['name' => 'Leo núi & Trekking', 'description' => 'Chinh phục các ngọn núi và những cung đường trekking đầy thử thách.'],
            ['name' => 'Chụp ảnh phong cảnh', 'description' => 'Khám phá những địa điểm đẹp để chụp ảnh và lưu giữ kỷ niệm.'],
            ['name' => 'Khám phá địa phương', 'description' => 'Gặp gỡ người dân địa phương và tìm hiểu về phong tục tập quán.'],
            ['name' => 'Thể thao dưới nước', 'description' => 'Thử sức với các môn thể thao như lướt ván, chèo thuyền và bơi lội.'],
            ['name' => 'Công viên giải trí', 'description' => 'Trải nghiệm các trò chơi hấp dẫn tại công viên giải trí.'],
            ['name' => 'Trải nghiệm Homestay', 'description' => 'Ở cùng người dân địa phương và trải nghiệm cuộc sống bản địa.'],
            ['name' => 'Đi tàu & Đường sắt du lịch', 'description' => 'Hành trình trên những chuyến tàu du lịch thú vị.'],
            ['name' => 'Khám phá động vật hoang dã', 'description' => 'Tham quan vườn thú, safari và khu bảo tồn động vật.'],
            ['name' => 'Tham quan trang trại', 'description' => 'Khám phá trang trại, vườn trái cây và trải nghiệm cuộc sống nông thôn.'],
            ['name' => 'Câu cá & Thư giãn bên hồ', 'description' => 'Câu cá giải trí và tận hưởng không gian yên bình bên hồ.'],
            ['name' => 'Du lịch tâm linh', 'description' => 'Tham quan chùa chiền, nhà thờ và các điểm du lịch tâm linh.'],
            ['name' => 'Giao lưu văn hóa bản địa', 'description' => 'Tìm hiểu và tham gia vào các hoạt động văn hóa của các dân tộc.'],
            ['name' => 'Chèo thuyền & Kayak', 'description' => 'Trải nghiệm chèo thuyền kayak trên sông, hồ và biển.'],
            ['name' => 'Tham quan rừng quốc gia', 'description' => 'Khám phá hệ sinh thái rừng và tham gia các chuyến đi bộ xuyên rừng.'],
            ['name' => 'Du lịch sức khỏe & Spa', 'description' => 'Tận hưởng các liệu pháp spa, yoga và chăm sóc sức khỏe.'],
            ['name' => 'Trượt tuyết & Thể thao mùa đông', 'description' => 'Thử sức với các môn thể thao mùa đông như trượt tuyết, trượt băng.'],
            ['name' => 'Lướt sóng & Kitesurfing', 'description' => 'Trải nghiệm cảm giác mạnh với lướt sóng và kitesurfing.'],
            ['name' => 'Tham quan làng nghề thủ công', 'description' => 'Tìm hiểu quy trình làm nghề thủ công truyền thống.'],
            ['name' => 'Khám phá kiến trúc độc đáo', 'description' => 'Tham quan những công trình kiến trúc nổi bật và độc đáo.'],
        ]);
    }
}
