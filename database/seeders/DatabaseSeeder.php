<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Company;
use App\Models\Location;
use App\Models\Position;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Company::create([
            'companyId'        => 'CPN00001',
            'companyName'      => 'PT Citra Daya Purnama',
        ]);

        Location::create([
            'locationId'        => 'LCT00001',
            'companyId'         => 'CPN00001',
            'locationName'        => 'Tambun Selatan',
            'locationPhone'        => '0218802408',
            'locationEmail'        => 'cdp@pangansari.co.id',
            'locationAddress'        => 'Jl. Diponegoro KM. 39',
            'locationCity'        => 'Kabupaten Bekasi',
            'locationProvince'        => 'Jawa Barat',
        ]);

        Departement::create([
            'departementId'        => 'DPT00001',
            'departementName'      => 'IT',
        ]);

        Position::create([
            'positionId'        => 'PST00001',
            'positionName'      => 'Manager',
        ]);

        $permission = '{
            "dashboardIndex":{"index":true}, 
            "companyIndex":{"index":true}, 
            "companyCreate":{"index":true},
            "companyEdit":{"index":true},
            "companyDelete":{"index":true},
            "locationIndex":{"index":true}, 
            "locationCreate":{"index":true},
            "locationEdit":{"index":true},
            "locationDelete":{"index":true},
            "departementIndex":{"index":true}, 
            "departementCreate":{"index":true},
            "departementEdit":{"index":true},
            "departementDelete":{"index":true},
            "positionIndex":{"index":true}, 
            "positionCreate":{"index":true},
            "positionEdit":{"index":true},
            "positionDelete":{"index":true},
            "userIndex":{"index":true}, 
            "userCreate":{"index":true},
            "userPermission":{"index":true},
            "userEdit":{"index":true},
            "userDelete":{"index":true},
            "supplierIndex":{"index":true}, 
            "supplierCreate":{"index":true},
            "supplierEdit":{"index":true},
            "supplierDelete":{"index":true},
            "manufactureIndex":{"index":true}, 
            "manufactureCreate":{"index":true},
            "manufactureEdit":{"index":true},
            "manufactureDelete":{"index":true},
            "categoryIndex":{"index":true}, 
            "categoryCreate":{"index":true},
            "categoryEdit":{"index":true},
            "categoryDelete":{"index":true}
        }';

        // $permission = str_replace(array("\r", "\n", ' '), '', $permission);

        User::create([
            'userId'            => Str::uuid(),
            'employeeNumber'    => '1234567891',
            'employeeName'      => 'Adam Zein',
            'password'          => Hash::make('password'),
            'locationId'        => 'LCT00001',
            'departementId'     => 'DPT00001',
            'positionId'        => 'PST00001',
            'employeePhone'     => '081316671373',
            'employeeEmail'     => 'adamzein@pangansari.co.id',
            'employeeAddress'   => 'Jl. Anggrek Raya',
            'employeeCity'      => 'Kabupaten Bekasi',
            'employeeProvince'  => 'Jawa Barat',
            'permission'        => $permission
        ]); 

        // {"superuser":"0","admin":"0","import":"0","reports.view":"0","assets.view":"0","assets.create":"0","assets.edit":"0","assets.delete":"0","assets.checkin":"0","assets.checkout":"0","assets.audit":"0","assets.view.requestable":"0","assets.view.encrypted_custom_fields":"0","accessories.view":"0","accessories.create":"0","accessories.edit":"0","accessories.delete":"0","accessories.checkout":"0","accessories.checkin":"0","accessories.files":"0","consumables.view":"0","consumables.create":"0","consumables.edit":"0","consumables.delete":"0","consumables.checkout":"0","consumables.files":"0","licenses.view":"0","licenses.create":"0","licenses.edit":"0","licenses.delete":"0","licenses.checkout":"0","licenses.keys":"0","licenses.files":"0","components.view":"0","components.create":"0","components.edit":"0","components.delete":"0","components.checkout":"0","components.checkin":"0","components.files":"0","kits.view":"0","kits.create":"0","kits.edit":"0","kits.delete":"0","users.view":"0","users.create":"0","users.edit":"0","users.delete":"0","models.view":"0","models.create":"0","models.edit":"0","models.delete":"0","categories.view":"0","categories.create":"0","categories.edit":"0","categories.delete":"0","departments.view":"0","departments.create":"0","departments.edit":"0","departments.delete":"0","statuslabels.view":"0","statuslabels.create":"0","statuslabels.edit":"0","statuslabels.delete":"0","customfields.view":"0","customfields.create":"0","customfields.edit":"0","customfields.delete":"0","suppliers.view":"0","suppliers.create":"0","suppliers.edit":"0","suppliers.delete":"0","manufacturers.view":"0","manufacturers.create":"0","manufacturers.edit":"0","manufacturers.delete":"0","depreciations.view":"0","depreciations.create":"0","depreciations.edit":"0","depreciations.delete":"0","locations.view":"0","locations.create":"0","locations.edit":"0","locations.delete":"0","companies.view":"0","companies.create":"0","companies.edit":"0","companies.delete":"0","self.two_factor":"0","self.api":"0","self.edit_location":"0","self.checkout_assets":"0","self.view_purchase_cost":"0"}

        
    }
}
