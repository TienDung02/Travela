<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\Tour;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Hà Nội khám phá', 'Sài Gòn năng động', 'Huế mộng mơ', 'Đà Nẵng biển xanh',
            'Nha Trang nghỉ dưỡng', 'Hội An cổ kính', 'Sa Pa sương mù', 'Hạ Long kỳ quan',
            'Cần Thơ sông nước', 'Phú Quốc thiên đường', 'Buôn Ma Thuột đại ngàn', 'Đà Lạt ngàn hoa',
            'Bình Thuận biển đẹp', 'Quy Nhơn hoang sơ', 'Tây Ninh núi thiêng', 'Vũng Tàu thư giãn',
            'Ninh Bình non nước', 'Bắc Kạn hồ Ba Bể', 'Yên Bái ruộng bậc thang', 'Cao Bằng thác Bản Giốc',
            'Lào Cai Fansipan', 'Lạng Sơn chợ vùng biên', 'Phan Thiết nắng gió', 'Kon Tum yên bình'
        ];

        $tours = Tour::inRandomOrder()->limit(24)->get();

        foreach ($names as $index => $name) {
            Package::create([
                'name' => $name,
                'desc' => 'Trải nghiệm ' . strtolower($name) . ' với các hoạt động hấp dẫn, ẩm thực đặc sắc và văn hóa độc đáo.',
                'price' => rand(1500000, 5000000),
                'tour_id' => $tours[$index % $tours->count()]->id,
                'main_image' => 'packages-' . ($index + 1) . '.jpg',
                'duration' => rand(3, 5),
                'people' => rand(2, 10)
            ]);
        }
    }
}
