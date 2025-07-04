<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    public function run()
    {
        Place::insert([
            [
                'name' => 'Chợ Bến Thành',
                'desc' => 'Khu chợ nổi tiếng ở TP. HCM.',
                'address' => 'Đường Lê Lợi, Quận 1, TP. HCM',
                'provinces' => 'TP. Hồ Chí Minh',
                'tag' => 'chợ, du lịch, mua sắm',
                'lat' => 10.7722713,
                'lon' => 106.6984256,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hồ Gươm',
                'desc' => 'Danh lam thắng cảnh nổi tiếng Hà Nội.',
                'address' => 'Quận Hoàn Kiếm, Hà Nội',
                'provinces' => 'Hà Nội',
                'tag' => 'hồ, lịch sử, tham quan',
                'lat' => 21.028511,
                'lon' => 105.854444,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bà Nà Hills',
                'desc' => 'Khu du lịch nổi tiếng ở Đà Nẵng.',
                'address' => 'Hòa Vang, Đà Nẵng',
                'provinces' => 'Đà Nẵng',
                'tag' => 'du lịch, nghỉ dưỡng, núi',
                'lat' => 15.9955,
                'lon' => 107.9939,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Núi Sam',
                'desc' => 'Khu du lịch tâm linh nổi tiếng ở An Giang.',
                'address' => 'Châu Đốc, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'tâm linh, núi, chùa',
                'lat' => 10.6889,
                'lon' => 105.0803,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tháp Nhạn',
                'desc' => 'Di tích Champa cổ tại Phú Yên.',
                'address' => 'Tuy Hòa, Phú Yên',
                'provinces' => 'Phú Yên',
                'tag' => 'di tích, văn hóa, lịch sử',
                'lat' => 13.0798,
                'lon' => 109.3125,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Biển Mỹ Khê',
                'desc' => 'Một trong những bãi biển đẹp nhất Việt Nam.',
                'address' => 'Quận Sơn Trà, Đà Nẵng',
                'provinces' => 'Đà Nẵng',
                'tag' => 'biển, tắm biển, nghỉ dưỡng',
                'lat' => 16.0662,
                'lon' => 108.2397,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thung lũng tình yêu',
                'desc' => 'Địa điểm du lịch nổi tiếng tại Đà Lạt.',
                'address' => 'Đà Lạt, Lâm Đồng',
                'provinces' => 'Lâm Đồng',
                'tag' => 'du lịch, tình yêu, cảnh đẹp',
                'lat' => 11.9766,
                'lon' => 108.4485,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Côn Đảo',
                'desc' => 'Hòn đảo lịch sử và du lịch nổi tiếng.',
                'address' => 'Bà Rịa - Vũng Tàu',
                'provinces' => 'Bà Rịa - Vũng Tàu',
                'tag' => 'đảo, lịch sử, biển',
                'lat' => 8.6959,
                'lon' => 106.6010,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chùa Một Cột',
                'desc' => 'Ngôi chùa có kiến trúc độc đáo ở Hà Nội.',
                'address' => 'Ba Đình, Hà Nội',
                'provinces' => 'Hà Nội',
                'tag' => 'chùa, lịch sử, kiến trúc',
                'lat' => 21.0356,
                'lon' => 105.8344,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Núi Bà Đen',
                'desc' => 'Nóc nhà Nam Bộ với cáp treo hiện đại.',
                'address' => 'Tây Ninh',
                'provinces' => 'Tây Ninh',
                'tag' => 'núi, cáp treo, du lịch',
                'lat' => 11.3775,
                'lon' => 106.1421,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Núi Cấm',
                'desc' => 'Ngọn núi cao nhất An Giang, được mệnh danh là "nóc nhà miền Tây".',
                'address' => 'Xã An Hảo, huyện Tịnh Biên, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'núi, tâm linh, du lịch sinh thái',
                'lat' => 10.5280,
                'lon' => 105.1040,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Miếu Bà Chúa Xứ Núi Sam',
                'desc' => 'Địa điểm tâm linh thu hút hàng triệu du khách mỗi năm.',
                'address' => 'Núi Sam, TP. Châu Đốc, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'tâm linh, lễ hội, tín ngưỡng',
                'lat' => 10.6889,
                'lon' => 105.0803,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rừng Tràm Trà Sư',
                'desc' => 'Khu rừng ngập nước nổi tiếng với hệ sinh thái đa dạng.',
                'address' => 'Xã Văn Giáo, huyện Tịnh Biên, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'rừng tràm, thiên nhiên, sinh thái',
                'lat' => 10.2431,
                'lon' => 105.0675,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Làng Chăm Châu Giang',
                'desc' => 'Làng dân tộc Chăm độc đáo với thánh đường Hồi giáo.',
                'address' => 'Phường Châu Phong, TP. Châu Đốc, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'văn hóa, dân tộc, lịch sử',
                'lat' => 10.6931,
                'lon' => 105.1217,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chợ Tịnh Biên',
                'desc' => 'Chợ biên giới nổi tiếng với hàng hóa từ Campuchia.',
                'address' => 'Thị trấn Tịnh Biên, huyện Tịnh Biên, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'mua sắm, biên giới, đặc sản',
                'lat' => 10.5398,
                'lon' => 105.0113,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hồ Soài So',
                'desc' => 'Hồ nước trong lành, nơi thư giãn giữa thiên nhiên.',
                'address' => 'Huyện Tri Tôn, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'hồ nước, dã ngoại, thiên nhiên',
                'lat' => 10.3815,
                'lon' => 105.1348,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chùa Hang (Phước Điền Tự)',
                'desc' => 'Ngôi chùa nổi tiếng trên sườn Núi Sam.',
                'address' => 'Núi Sam, TP. Châu Đốc, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'chùa, Phật giáo, núi',
                'lat' => 10.6906,
                'lon' => 105.0824,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Núi Tô',
                'desc' => 'Một trong bảy núi (Thất Sơn), thích hợp trekking.',
                'address' => 'Huyện Tri Tôn, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'núi, phượt, thiên nhiên',
                'lat' => 10.4650,
                'lon' => 105.0915,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chùa Tây An',
                'desc' => 'Ngôi chùa cổ kết hợp phong cách Việt - Ấn độc đáo.',
                'address' => 'Gần Miếu Bà Chúa Xứ, Núi Sam, Châu Đốc',
                'provinces' => 'An Giang',
                'tag' => 'chùa, kiến trúc, lịch sử',
                'lat' => 10.6894,
                'lon' => 105.0810,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lăng Thoại Ngọc Hầu',
                'desc' => 'Lăng mộ người có công khai phá vùng Châu Đốc.',
                'address' => 'Núi Sam, TP. Châu Đốc, An Giang',
                'provinces' => 'An Giang',
                'tag' => 'lịch sử, nhân vật, văn hóa',
                'lat' => 10.6887,
                'lon' => 105.0795,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
