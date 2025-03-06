<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Currency;
class CurrencySeeder extends Seeder
{
    public function run()
    {
        Currency::insert ([
            ['name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$', 'country' => 'United States'],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€', 'country' => 'European Union'],
            ['name' => 'British Pound', 'code' => 'GBP', 'symbol' => '£', 'country' => 'United Kingdom'],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'symbol' => '¥', 'country' => 'Japan'],
            ['name' => 'Canadian Dollar', 'code' => 'CAD', 'symbol' => 'C$', 'country' => 'Canada'],
            ['name' => 'Swiss Franc', 'code' => 'CHF', 'symbol' => 'Fr.', 'country' => 'Switzerland'],
            ['name' => 'Australian Dollar', 'code' => 'AUD', 'symbol' => 'A$', 'country' => 'Australia'],
            ['name' => 'New Zealand Dollar', 'code' => 'NZD', 'symbol' => 'NZ$', 'country' => 'New Zealand'],
            ['name' => 'Chinese Yuan', 'code' => 'CNY', 'symbol' => '¥', 'country' => 'China'],
            ['name' => 'South Korean Won', 'code' => 'KRW', 'symbol' => '₩', 'country' => 'South Korea'],
            ['name' => 'Singapore Dollar', 'code' => 'SGD', 'symbol' => 'S$', 'country' => 'Singapore'],
            ['name' => 'Thai Baht', 'code' => 'THB', 'symbol' => '฿', 'country' => 'Thailand'],
            ['name' => 'Indonesian Rupiah', 'code' => 'IDR', 'symbol' => 'Rp', 'country' => 'Indonesia'],
            ['name' => 'Malaysian Ringgit', 'code' => 'MYR', 'symbol' => 'RM', 'country' => 'Malaysia'],
            ['name' => 'Philippine Peso', 'code' => 'PHP', 'symbol' => '₱', 'country' => 'Philippines'],
            ['name' => 'Indian Rupee', 'code' => 'INR', 'symbol' => '₹', 'country' => 'India'],
            ['name' => 'Vietnamese Dong', 'code' => 'VND', 'symbol' => '₫', 'country' => 'Vietnam'],
            ['name' => 'Russian Ruble', 'code' => 'RUB', 'symbol' => '₽', 'country' => 'Russia'],
            ['name' => 'South African Rand', 'code' => 'ZAR', 'symbol' => 'R', 'country' => 'South Africa'],
            ['name' => 'Turkish Lira', 'code' => 'TRY', 'symbol' => '₺', 'country' => 'Turkey'],
            ['name' => 'Mexican Peso', 'code' => 'MXN', 'symbol' => '$', 'country' => 'Mexico'],
            ['name' => 'Brazilian Real', 'code' => 'BRL', 'symbol' => 'R$', 'country' => 'Brazil'],
            ['name' => 'Argentine Peso', 'code' => 'ARS', 'symbol' => '$', 'country' => 'Argentina'],
            ['name' => 'Egyptian Pound', 'code' => 'EGP', 'symbol' => '£', 'country' => 'Egypt'],
        ]);

//        DB::table('currencies')->insert($currencies);
    }
}
