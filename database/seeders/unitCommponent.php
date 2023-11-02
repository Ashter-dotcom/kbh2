<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MasterData\Komponen;

class unitCommponent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataUnitCommponent() as $unit => $komponen) {
            try {
                Komponen::whereIn('nama_komponen', $komponen)->update(['unit' => $unit]);
            } catch (Throwable $e) {
                report($e);
            }
        }
    }

    protected function dataUnitCommponent()
    {
        return [
            'Kg' => [
                'Paint'
            ],
            'Set' => [
                'Bearings',
                'Clutch Housing',
                'Gears',
                'Hub Wheel',
                'Pad Head Rest',
                'Pad Seat Back',
                'Pad Seat Cushion',
                'Pull Handle',
                'Recleaning Seat',
                'Seat & Seat Frame',
                'Shaft dan Main Shaft',
                'Shift Fork/ Speed Shaft',
                'Sliding Seat',
                'Steering Gear',
                'Sun Visor',
                'Synchronizer',
                'Tie Rod End',
                'Tie Rod Linkage',
                'Transaxle/ Transmission Case',
                'Transmisi/Transaxle Otomatis',
                'Window Regulator',
                'Yoke'
            ],
            'Pcs' => [
                'AC',
                'Air Filter & Housing',
                'Air Intake Pipe',
                'Alternator',
                'Arm Rest',
                'Backing Plate',
                'Battery',
                'Bearing',
                'Bearing Cap',
                'Bearings',
                'Body Caliper',
                'Brake/ Fuel Tube',
                'Brake Lining Pad',
                'Brake Shoe',
                'Bumper',
                'Camshaft',
                'Connecting Rod',
                'Control Cable',
                'Cover',
                'Cover Cylinder Head',
                'Cover Steering Column',
                'Crankshaft',
                'Cross Member',
                'Cylinder Block',
                'Cylinder Head',
                'Cylinder Wheel',
                'Dashboard',
                'Diafragma',
                'Door Triming',
                'Doors',
                'Drum/ Disc',
                'Engine Control Unit',
                'Engine Hood',
                'Engine Hunger',
                'Engine Support',
                'Exhaust Manifold',
                'Extention Housing',
                'Facing',
                'Fan Shroud',
                'Fender',
                'Floor',
                'Floor Mat',
                'Fly Wheel',
                'Front Spring',
                'Fuel Filter',
                'Fuel Tank (Plastic)',
                'Fuel Tank (Steel)',
                'Gasket',
                'Head Lining',
                'Horn',
                'Hub',
                'Intake Manifold',
                'Knuckle Arm',
                'Lamp',
                'Mirror',
                'Motor Starter',
                'Muffler & Exhaust Pipe',
                'Oil Filter',
                'Oil Pan',
                'Oil Seal',
                'Pad Ctr Armrest',
                'Piston',
                'Piston & Piston Ring',
                'Plastic Part',
                'Pressure Plate',
                'Puley Crankshaft',
                'Radiator',
                'Radio Tape',
                'Rear Spring',
                'Rocker Arm',
                'Roof',
                'Rubber Part',
                'Safety Glass',
                'Safety Seat Belt',
                'Shockabsorber',
                'Side Members',
                'Side Panel',
                'Spark Plug',
                'Steering Column',
                'Steering Shaft',
                'Steering Wheel',
                'Sticker',
                'Support Caliper',
                'Timing Chain Cover',
                'Tire',
                'Torsion Spring (Steel)',
                'Trunklid / Back Panel',
                'V Belt & Timing Belt',
                'Water Overflow Tank',
                'Weather Strip',
                'Wheel Rim',
                'Wind Shield Washer',
                'Wiring Harness',
                'Pump Assy Water',
                'Transmission Case',
            ]
        ];
    }
}
