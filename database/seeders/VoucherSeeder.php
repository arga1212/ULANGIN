<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Voucher; // Jangan lupa import

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vouchers = [
            'N4SKEPEN', 'BG4MMUTF', '58G93WIU', 'BNJQ0D3D', 'SOUXPD2A', 'UB7T1YUN', 
            'GTH5V1SZ', '63DS90RW', 'D1R3RAFN', 'D038D68E', 'NKKUBBJV', 'MU76UE38',
            'P0WRXAQA', 'IB1WLT90', 'N9SRNRE5', 'XULAIA0I', 'ZOFISY03', 'A0VMMD8F',
            'PH4KNWT8', 'EQF4HAKD', 'OQDUMAJR', 'X8WR70PA', 'WZA0HCZF', 'YIUTT7TX',
            'XUKBRYXV', '1UF79LLK', 'K6JLTFMC', 'Y4R9GW1Q', '6QVQ94GZ', '8PEKIUJW',
            '12W3FPQJ', '6VIVFH1G', 'Z8WVFJ02', 'Z3PXFP77', 'TUN72DW0', 'INA5VJ11',
            'HPIGQ1CU', 'KN6AHOD1', '7OUJZ2BE', 'O885YSQI', 'X4P9SJL8', 'S0JJTMDJ',
            'LQG0IFSO', '5OMSB4EM', 'UOC97YV1', '4SAW2O93', '8QB0E0MR', 'HB2T25MG',
            '4Z012EIO', 'A28P0CRE', 'DLOHS773', '36GTGF71', 'ZZS5CXME', '0Y6O8NA0',
            'YK7I2DTO', 'IVD9XWLP', 'Q62CHWWJ', 'PE26Y0LH', '6W58D6GE', 'OUKWFUB9',
            '3O6G32RB', '2VK171SR', 'TRNJXKMN', 'KDCLEUU7', 'O1IH105P', 'K7EMX7A0',
            'TP7T1KUK', '4YPWNKNZ', 'CKMEACUC', 'LKXOOUBZ', 'JM5K43J8', 'VORGN4XY',
            'C4BN8XK1', 'IZTPBNFM', 'YU310W9C', '5ETDZX0K', 'CE5JBUVV', 'JKXJMRRL',
            'UYCBIVOO', 'NJEUKZ43', 'R25OFW5W', 'Z417D0I3', '0E7M4ZE0', 'CSVKZRZ9',
            'FREVWKC6', 'KSX7Z1Y4', 'EXA4D756', '53909BWT', 'OYE67UVV', 'ZIOH45Y0',
            'C9EJORRT', 'PSQOVBAK', 'T9LK73LY', '5MMOXOPW', 'BPHEQLED', '6LXJ5JVG',
            'H6MW4UAX', '0K4IOOWH', 'I0X474GC', '0X7EMLPF', 'XJAK14G3', 'LBL1Y99W',
            'QLA3LB7W', 'EB82RZQW', 'UAGMV72T', 'G31PH9IV', 'T0640IXV', '0YEKIYDH',
            'UPRZKUL7', 'KCXH7W6J', 'EU4HGQ7K', 'BLF1DMYK', '1ICG1XGG', 'J3KFMCOW',
            '1N9AUB92', 'R7NPRMZN', 'XZU1D52B', 'W0QPGOU0', 'X550T5VT', '7OR78MDY',
            'RPVR7B7Y', '7GPCO4YA', 'CGQGUW2P', 'UCWKG05N', 'UUBG1QK6', 'IRR36OD8'
        ];

        foreach ($vouchers as $code) {
            Voucher::create([
                'code' => $code,
                'discount_percent' => 5, // Semua diskon 5%
                'is_active' => true,
            ]);
        }
    }
}