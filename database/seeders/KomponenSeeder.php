<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MasterData\KategoriKomponen;
use App\Models\MasterData\Komponen;

class KomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->dataKategoriKomponen() as $kategori) {
            try {
                DB::table('master_data_kategori_komponen')->updateOrInsert(
                    [
                        'id' => $kategori['id']
                    ],[
                        'nama_kategori_komponen' => $kategori['nama_kategori_komponen']
                    ]
                );
            } catch (Throwable $e) {
                report($e);
            }
        }

        foreach($this->dataKomponen() as $komponen) {
            try {
                DB::table('master_data_komponen')->updateOrInsert(
                    [
                        'id' => $komponen['id']
                    ],[
                        'kategori_id' => $komponen['kategori_id'],
                        'nama_komponen' => $komponen['nama_komponen']
                    ]
                );
            } catch (Throwable $e) {
                report($e);
            }
        }

    }

    protected function dataKategoriKomponen()
    {
        return [
            [
                'id' => '03c25feb-08be-4ead-a9c6-739fe933e056',
                'nama_kategori_komponen' => 'Motor Penggerak/Engine (Utama)'
            ],
            [
                'id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc03',
                'nama_kategori_komponen' => 'Transmisi/Transaxle Manual (Utama)'
            ],
            [
                'id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc04',
                'nama_kategori_komponen' => 'Transmisi/Transaxle Otomatis (Utama)'
            ],
            [
                'id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
                'nama_kategori_komponen' => 'Motor Penggerak/Engine (Pendukung)'
            ],
            [
                'id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a8',
                'nama_kategori_komponen' => 'Transmisi/Transaxle Manual (Pendukung)'
            ],
            [
                'id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a9',
                'nama_kategori_komponen' => 'Transmisi/Transaxle Otomatis (Pendukung)'
            ],
            [
                'id' => 'b56a610a-0834-4a3d-825e-310755a4f44b',
                'nama_kategori_komponen' => 'Clutch System'
            ],
            [
                'id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
                'nama_kategori_komponen' => 'Body Dan Sasis'
            ],
            [
                'id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
                'nama_kategori_komponen' => 'Steering System'
            ],
            [
                'id' => '51358838-9b48-4016-8d3d-047c624508b0',
                'nama_kategori_komponen' => 'Brake System'
            ],
            [
                'id' => '0e5a45f2-da57-4517-b36b-6bb6b8096996',
                'nama_kategori_komponen' => 'Suspension'
            ],
            [
                'id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
                'nama_kategori_komponen' => 'Komponen Universal'
            ]
        ];
    }

    protected function dataKomponen()
    {
        return [
            [
              'id' => '0a6048c4-5c24-4105-8250-9c170800c623',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Engine Hood'
            ],
            [
              'id' => '20ca81ad-3d39-4c1f-9298-49ff7278404c',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Cross Member'
            ],
            [
              'id' => '42026707-ab67-4fee-853b-f7eec2270741',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Fender'
            ],
            [
              'id' => '4fd4797b-b541-4e32-91a5-475a8b77e9ff',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Trunklid / Back Panel'
            ],
            [
              'id' => '665bf91f-e510-45f8-b006-a32ebafeaee9',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Floor'
            ],
            [
              'id' => 'b9b5d392-a13f-47d2-9f23-eba9b2d0183a',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Side Members'
            ],
            [
              'id' => 'cb5f7032-fb5a-499d-9762-2ffb3c2bd07b',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Side Panel'
            ],
            [
              'id' => 'dcf2ca00-79ba-4144-a792-b4688c5cd2d0',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Roof'
            ],
            [
              'id' => 'e5752872-9788-4f58-a73a-f1e8872fbf69',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Doors'
            ],
            [
              'id' => '42026707-ab67-4fee-853b-f7eec2270742',
              'kategori_id' => '00d47e42-0dad-4f78-867e-a87d475d027e',
              'nama_komponen' => 'Reinforcement'
            ],
            [
              'id' => 'f22b58a8-fac0-4488-9710-3387f8e85c6e',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e056',
              'nama_komponen' => 'Cylinder Head'
            ],
            [
              'id' => '286afa5a-5f79-4eac-8c85-2229666399b7',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e056',
              'nama_komponen' => 'Cylinder Block'
            ],
            [
              'id' => '3f419947-c355-4234-b7a0-575ebde06fcb',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e056',
              'nama_komponen' => 'Connecting Rod'
            ],
            [
              'id' => '92f8a325-b073-42ee-88be-e0316fd95fa6',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e056',
              'nama_komponen' => 'Camshaft'
            ],
            [
              'id' => 'c1547e14-977d-4ae9-ba57-80e9debc7ed2',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e056',
              'nama_komponen' => 'Crankshaft'
            ],
            [
              'id' => '114f5b53-dbd7-41a0-a1fb-0d2d7c3e3725',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Engine Hunger'
            ],
            [
              'id' => '1b380653-bf8a-40b2-95fd-ca5b57f6d751',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Bearing'
            ],
            [
              'id' => '22fa6bdc-b983-4475-b999-b3901fdd11fb',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Radiator'
            ],
            [
              'id' => '2a342a3f-49fc-4799-9be6-e3dfb94e0210',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Water Overflow Tank'
            ],
            [
              'id' => '2ee1af4d-7943-4b6d-ac19-bef2c41cfaa5',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Engine Mounting'
            ],
            [
              'id' => '3a1cc678-505d-432d-80a6-e805507bd199',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Timing Chain Cover'
            ],
            [
              'id' => '3aca6998-3c0e-46d3-b8e1-c8936322199a',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Air Intake Pipe'
            ],
            [
              'id' => '42a4c768-ebaa-4744-84aa-464262360de4',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Fan Shroud'
            ],
            [
              'id' => '50fceae2-63f6-46be-bf40-9f887636597f',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Exhaust Manifold'
            ],
            [
              'id' => '69c9a0c7-d91d-4ed8-8c79-df15b5d47b46',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Air Filter & Housing'
            ],
            [
              'id' => '7230b422-993f-4989-8aae-426f229c4aa3',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Oil Pan'
            ],
            [
              'id' => '72512b7c-dfd0-4e61-8311-b2504bbd1ac7',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Alternator'
            ],
            [
              'id' => '7f513a06-a70f-4062-8cc5-db50bfa25f3f',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Oil Filter'
            ],
            [
              'id' => '827af0c5-735a-417d-b571-b4709410da14',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Bearing Cap'
            ],
            [
              'id' => '88cb0216-c8b6-479e-a23f-3907a3da6835',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Puley Crankshaft'
            ],
            [
              'id' => '91972c2d-0b16-431b-a6b6-679a5f15f770',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Motor Starter'
            ],
            [
              'id' => '9596b72e-abb5-4302-accf-a27966e262e3',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Intake Manifold'
            ],
            [
              'id' => 'a1ac7c13-9f60-4c8b-a105-12e5bac9d3a0',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Gasket'
            ],
            [
              'id' => 'b59d7aa9-9d9e-4462-a252-a352e1f706fa',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Cover Cylinder Head'
            ],
            [
              'id' => 'c9947945-d551-4c30-a7a7-ead1155deb54',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Fuel Filter'
            ],
            [
              'id' => 'c9fde204-966a-4d5f-a440-437656540ef8',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Piston & Piston Ring'
            ],
            [
              'id' => 'db2b1ac9-dad7-4a05-ab78-17ddf8e645fa',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Spark Plug'
            ],
            [
              'id' => 'e69ef0a1-256e-4dad-9f88-60d499bc2529',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Rocker Arm'
            ],
            [
              'id' => 'ec851818-80f3-43e7-bac7-3453d9cdff75',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'V Belt & Timing Belt'
            ],
            [
              'id' => 'f11f2f6e-e611-4393-9d86-6f040f341408',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Fly Wheel'
            ],
            [
              'id' => 'ec851818-80f3-43e7-bac7-3453d9cdff76',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Valve (Exhaust & Intake)'
            ],
            [
              'id' => 'ec851818-80f3-43e7-bac7-3453d9cdff77',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Pump Assy Water'
            ],
            [
              'id' => 'c9947945-d551-4c30-a7a7-ead1155deb55',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Ignition Coil'
            ],
            [
              'id' => 'c9947945-d551-4c30-a7a7-ead1155deb56',
              'kategori_id' => '03c25feb-08be-4ead-a9c6-739fe933e057',
              'nama_komponen' => 'Body Assy Throttle'
            ],
            [
              'id' => '0d757d09-90db-4d40-819b-248f3b0c44c5',
              'kategori_id' => '0e5a45f2-da57-4517-b36b-6bb6b8096996',
              'nama_komponen' => 'Shock Absorber Front'
            ],
            [
              'id' => '0d757d09-90db-4d40-819b-248f3b0c44c6',
              'kategori_id' => '0e5a45f2-da57-4517-b36b-6bb6b8096996',
              'nama_komponen' => 'Shock Absorber Rear'
            ],
            [
              'id' => 'd2578894-6c0c-47aa-a299-bf022c0a9a0d',
              'kategori_id' => '0e5a45f2-da57-4517-b36b-6bb6b8096996',
              'nama_komponen' => 'Rear Spring'
            ],
            [
              'id' => 'e8409c90-d5f7-4fb3-bbea-9ba155a0fa20',
              'kategori_id' => '0e5a45f2-da57-4517-b36b-6bb6b8096996',
              'nama_komponen' => 'Front Spring'
            ],
            [
              'id' => '0504af23-189a-41e7-8b48-04c71632f83b',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Paint'
            ],
            [
              'id' => '0a4a6238-17df-4f99-9435-8f68cb4ed4a0',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Bumper'
            ],
            [
              'id' => '0ca1bd90-d94c-4248-8364-8145afdb8c76',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Battery/Accu'
            ],
            [
              'id' => '17aea095-b147-4c8e-8b80-f3c0d7b79cf6',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Pad Seat Back'
            ],
            [
              'id' => '17fb6bfd-6f8d-4ce4-9af5-932dc2b5cf4c',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Wheel Rim'
            ],
            [
              'id' => '2a1f17ff-7cf8-49fe-b55a-8ebcb3557c14',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Oil Seal'
            ],
            [
              'id' => '33005ac2-e5a9-4c8d-9ef1-da2457b43192',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Wiring Harness'
            ],
            [
              'id' => '340faf3d-8f65-4024-87b3-b4c26cef747f',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Cover Bearing Dust'
            ],
            [
              'id' => '37d8bb63-f3a0-47aa-8226-24e02a0d0b75',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Sticker'
            ],
            [
              'id' => '3866dc97-277d-4711-a2c0-5a36080c2b5c',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Wind Shield Washer'
            ],
            [
              'id' => '3f1b20ec-98f5-43a3-9fb1-a528acc53e9c',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Sliding Seat'
            ],
            [
              'id' => '425d29b6-2040-4548-99ff-e051b2a95237',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Weather Strip'
            ],
            [
              'id' => '480abdc5-06be-4b1b-8374-084165925edd',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Door Triming'
            ],
            [
              'id' => '4b81de66-ef11-4807-a303-79843e713d7f',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Muffler & Exhaust Pipe'
            ],
            [
              'id' => '666f56b7-fa2c-4348-8526-e608a6b69cd2',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Arm Rest'
            ],
            [
              'id' => '689cf9cf-54d5-4103-9d17-f9acedd0cb86',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Pad Seat Cushion'
            ],
            [
              'id' => '6932ec3b-8dae-4a61-8690-2b47c52301df',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Ornament Wheel Hub'
            ],
            [
              'id' => '73d304bd-390c-4a63-9cac-f6c38723f398',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Window Regulator'
            ],
            [
              'id' => '741a0596-cc0e-44c3-b86f-c1787cc17cf8',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'AC'
            ],
            [
              'id' => '7a71fdc0-2743-4039-abaa-4ee1c3365025',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Seat Frame'
            ],
            [
              'id' => '81b3aa07-3f7c-430f-a2a3-ebb243104f52',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Floor Mat'
            ],
            [
              'id' => '848a3949-3870-4156-8b71-57ac5e524612',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Tire'
            ],
            [
              'id' => '8b1bc4c4-0dcf-43b3-b124-f73a090adb2d',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Recleaning Seat'
            ],
            [
              'id' => '8ee64b02-a4ee-4546-b65f-dc0ec9a4fd98',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Head Lining'
            ],
            [
              'id' => '9d3f1fff-455b-4add-b615-c56b14014ced',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Radio Tape'
            ],
            [
              'id' => 'a562cee7-dbb9-4a88-ae8e-467f0688297d',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Safety Seat Belt'
            ],
            [
              'id' => 'a98c2056-6cd6-49af-a052-521986c3b047',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Brake Tube'
            ],
            [
              'id' => 'a98c2056-6cd6-49af-a052-521986c3b048',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Fuel Tube'
            ],
            [
              'id' => 'b1ee9484-612b-49ba-ae42-b7641e92c0b5',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Pull Handle'
            ],
            [
              'id' => 'bab15f23-f0f4-4a4f-bc2c-4e4304efd915',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Pad Ctr Armrest'
            ],
            [
              'id' => 'bde96e43-a351-4af7-8034-96667553a216',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Fuel Tank'
            ],
            [
              'id' => 'bf9a2e45-bf99-45f0-9e53-150a2d55cc45',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Control Cable'
            ],
            [
              'id' => 'c122b088-3b2e-440f-9341-43d479e74e1d',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Mirror'
            ],
            [
              'id' => 'c688fa51-4d82-4781-a0e2-b040239ef8e5',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Lamp'
            ],
            [
              'id' => 'c9d968c2-6548-453e-b27d-e5fea162f449',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Dashboard'
            ],
            [
              'id' => 'cfd5425c-5d5d-460f-a222-cc34108174ed',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Sun Visor'
            ],
            [
              'id' => 'df360657-1807-406c-b14c-8dcdd7fe347a',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Safety Glass'
            ],
            [
              'id' => 'e12fdf36-c21e-4f74-bef5-c57dd0891021',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Engine Control Unit'
            ],
            [
              'id' => 'e4b0a377-c99e-40bd-89a3-03fcbb00d5b7',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Pad Head Rest'
            ],
            [
              'id' => 'e4bee16e-e896-4e17-ad40-501367e7dae4',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Horn'
            ],
            [
              'id' => 'b1ee9484-612b-49ba-ae42-b7641e92c0b7',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Box assy Console'
            ],
            [
              'id' => 'b7205eff-51cb-4b79-9e27-8ae3936b2358',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Garnish Pillar'
            ],
            [
              'id' => 'b7205eff-51cb-4b79-9e27-8ae3936b2359',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Hose'
            ],
            [
              'id' => '9eedd5a7-64c4-4526-8461-65982c9022d5',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Protector, Wiring Harness'
            ],
            [
              'id' => '9eedd5a7-64c4-4526-8461-65982c9022d6',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Glass Adhesive'
            ],
            [
              'id' => 'e4bee16e-e896-4e17-ad40-501367e7dae5',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Protector, Back Door Panel',
            ],
            [
              'id' => 'e4bee16e-e896-4e17-ad40-501367e7dae6',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Plug Hole'
            ],
            [
              'id' => 'e4b0a377-c99e-40bd-89a3-03fcbb00d5b8',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Absorber Inner Mirror Arm'
            ],
            [
              'id' => 'e12fdf36-c21e-4f74-bef5-c57dd0891022',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Fuel Pipe'
            ],
            [
              'id' => 'e12fdf36-c21e-4f74-bef5-c57dd0891023',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Alarm dan/ atau Immobilizer'
            ],
            [
              'id' => 'c688fa51-4d82-4781-a0e2-b040239ef8e6',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Dongkrak pantograph/mekanis',
            ],
            [
              'id' => 'c688fa51-4d82-4781-a0e2-b040239ef8e7',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Speedometer (meter cluster)',
            ],
            [
              'id' => 'bf9a2e45-bf99-45f0-9e53-150a2d55cc46',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Door lock'
            ],
            [
              'id' => 'bf9a2e45-bf99-45f0-9e53-150a2d55cc47',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Pedal'
            ],
            [
              'id' => 'bde96e43-a351-4af7-8034-96667553a217',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Spoiler'
            ],
            [
              'id' => 'bde96e43-a351-4af7-8034-96667553a218',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Fuel Pump'
            ],
            [
              'id' => 'bab15f23-f0f4-4a4f-bc2c-4e4304efd916',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Grip Assist'
            ],
            [
              'id' => 'bab15f23-f0f4-4a4f-bc2c-4e4304efd917',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Heater Control'
            ],
            [
              'id' => '848a3949-3870-4156-8b71-57ac5e524613',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Register AC'
            ],
            [
              'id' => '848a3949-3870-4156-8b71-57ac5e524614',
              'kategori_id' => '2666388b-7fa3-4c6f-b013-15186ce52444',
              'nama_komponen' => 'Holder Cup'
            ],
            [
              'id' => '07ad53a1-1fc6-440e-9aba-00288391b3fb',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Backing Plate'
            ],
            [
              'id' => '1ada9eee-b65f-443b-8980-0732de1e11e4',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Support Caliper'
            ],
            [
              'id' => '235018e2-1637-45fa-9818-113f8433889e',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Drum Brake'
            ],
            [
              'id' => '235018e2-1637-45fa-9818-113f8433889f',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Disk Brake'
            ],
            [
              'id' => '39790944-527e-45de-9e55-c0e54c55aba3',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Brake Lining Pad'
            ],
            [
              'id' => '88b5e040-8b6d-4e49-8b2b-d8ea7e31a3bf',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Piston'
            ],
            [
              'id' => '992de0e8-5c75-4b79-9152-8713f38281d6',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Brake Shoe'
            ],
            [
              'id' => 'b1433247-865f-4e13-a2f2-acd6f84d3bf1',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Body Caliper'
            ],
            [
              'id' => 'c673f14b-a63d-4549-8e63-d7054479886e',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Cylinder Wheel'
            ],
            [
              'id' => '1ada9eee-b65f-443b-8980-0732de1e11e5',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Cable Parking Brake'
            ],
            [
              'id' => '1ada9eee-b65f-443b-8980-0732de1e11e6',
              'kategori_id' => '51358838-9b48-4016-8d3d-047c624508b0',
              'nama_komponen' => 'Master Cylinder'
            ],
            [
              'id' => '198eb3d6-4e48-440b-9897-c641443b041d',
              'kategori_id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
              'nama_komponen' => 'Cover Steering Column'
            ],
            [
              'id' => '446ba9bb-2dab-466a-939e-dbe0be94e8cb',
              'kategori_id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
              'nama_komponen' => 'Steering Gear'
            ],
            [
              'id' => '5a4c0e75-5d25-4ea3-85d6-0dc8fafe2592',
              'kategori_id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
              'nama_komponen' => 'Bearings'
            ],
            [
              'id' => '91326155-d03b-4038-92a5-b66264cdca63',
              'kategori_id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
              'nama_komponen' => 'Steering Shaft'
            ],
            [
              'id' => '99294a8e-6787-42d8-a3e9-33ae7340583f',
              'kategori_id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
              'nama_komponen' => 'Steering Column'
            ],
            [
              'id' => '9cb2095b-b12e-4cfb-86d9-b4fa4c886d35',
              'kategori_id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
              'nama_komponen' => 'Tie Rod End'
            ],
            [
              'id' => '9f3c418f-a259-4dad-817c-5602bb6353ae',
              'kategori_id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
              'nama_komponen' => 'Knuckle Arm'
            ],
            [
              'id' => 'ca47cc6b-40f0-4034-90fb-b566c9d2b40c',
              'kategori_id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
              'nama_komponen' => 'Steering Wheel'
            ],
            [
              'id' => 'fcdec65b-38f9-44b1-bb2b-1a97df587058',
              'kategori_id' => '690dc432-367c-4c50-ab24-557f1afc73d9',
              'nama_komponen' => 'Tie Rod Linkage'
            ],
            [
              'id' => '6562a2bc-c4cf-4176-863e-7047c1e33641',
              'kategori_id' => 'b56a610a-0834-4a3d-825e-310755a4f44b',
              'nama_komponen' => 'Cover'
            ],
            [
              'id' => '75ce38b8-0aea-4559-b42c-b120be236e6f',
              'kategori_id' => 'b56a610a-0834-4a3d-825e-310755a4f44b',
              'nama_komponen' => 'Diafragma'
            ],
            [
              'id' => '7d41fe74-a013-48c1-88bf-1afeab61cd5e',
              'kategori_id' => 'b56a610a-0834-4a3d-825e-310755a4f44b',
              'nama_komponen' => 'Hub'
            ],
            [
              'id' => '9eedd5a7-64c4-4526-8461-65982c9022d4',
              'kategori_id' => 'b56a610a-0834-4a3d-825e-310755a4f44b',
              'nama_komponen' => 'Facing'
            ],
            [
              'id' => 'b0d5b936-05a3-485b-9160-7bc55777f72a',
              'kategori_id' => 'b56a610a-0834-4a3d-825e-310755a4f44b',
              'nama_komponen' => 'Pressure Plate'
            ],
            [
              'id' => 'c2ee2a9e-fb24-4f9b-a018-67cc1f430cb9',
              'kategori_id' => 'b56a610a-0834-4a3d-825e-310755a4f44b',
              'nama_komponen' => 'Torsion Spring (Steel)'
            ],
            [
              'id' => '5debab63-7012-4575-9929-d17b82dad46e',
              'kategori_id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc03',
              'nama_komponen' => 'Transmission Case'
            ],
            [
              'id' => '361849e9-e000-4f21-94a8-47fc0809452a',
              'kategori_id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc03',
              'nama_komponen' => 'Gears'
            ],
            [
              'id' => '3a93397e-3334-4c94-a6b2-b3d5c9f3903e',
              'kategori_id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc03',
              'nama_komponen' => 'Shaft'
            ],
            [
              'id' => '71a188f8-0aeb-4cdd-958a-218ee5ce8d9e',
              'kategori_id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc03',
              'nama_komponen' => 'Clutch Housing'
            ],
            [
              'id' => '84b2009c-1383-44f1-a787-1b17e2c2cbb0',
              'kategori_id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc04',
              'nama_komponen' => 'Transmission Case'
            ],
            [
              'id' => '8a8bb867-28ea-453c-b7a4-209619fd17f7',
              'kategori_id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc04',
              'nama_komponen' => 'Gears'
            ],
            [
              'id' => '945ad49f-dddb-42af-9b0b-e74132bef288',
              'kategori_id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc04',
              'nama_komponen' => 'Shaft'
            ],
            [
              'id' => '97d7d4b9-abc7-4189-8136-153b9730dee8',
              'kategori_id' => 'd2e561d7-acbd-4dea-9de8-8e4d2e3acc04',
              'nama_komponen' => 'Clutch Housing'
            ],
            [
              'id' => 'b7205eff-51cb-4b79-9e27-8ae3936b2357',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a8',
              'nama_komponen' => 'Hub Wheel'
            ],
            [
              'id' => 'c138ebc7-c4cd-4b2b-bbcd-7c9d3685576c',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a8',
              'nama_komponen' => 'Shift Fork/ Speed Shaft'
            ],
            [
              'id' => '84b2009c-1383-44f1-a787-1b17e2c2cbb1',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a8',
              'nama_komponen' => 'Bearing'
            ],
            [
              'id' => '84b2009c-1383-44f1-a787-1b17e2c2cbb2',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a8',
              'nama_komponen' => 'Synchronizer'
            ],
            [
              'id' => '8a8bb867-28ea-453c-b7a4-209619fd17f6',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a8',
              'nama_komponen' => 'Propeller Shaft'
            ],
            [
              'id' => '8a8bb867-28ea-453c-b7a4-209619fd17f5',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a8',
              'nama_komponen' => 'Drive Shaft'
            ],
            [
              'id' => 'b7205eff-51cb-4b79-9e27-8ae3936b235',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a9',
              'nama_komponen' => 'Hub Wheel'
            ],
            [
              'id' => 'c138ebc7-c4cd-4b2b-bbcd-7c9d3685576d',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a9',
              'nama_komponen' => 'Cover'
            ],
            [
              'id' => '84b2009c-1383-44f1-a787-1b17e2c2cbb3',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a9',
              'nama_komponen' => 'Bearing'
            ],
            [
              'id' => '8a8bb867-28ea-453c-b7a4-209619fd17f4',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a9',
              'nama_komponen' => 'Propeller Shaft'
            ],
            [
              'id' => '8a8bb867-28ea-453c-b7a4-209619fd17f3',
              'kategori_id' => '833ce5dc-71e9-11ed-8a39-b0227a7358a9',
              'nama_komponen' => 'Extention Housing'
            ],
        ];
    }
}
