<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BoughtLand;
use App\Models\Document;
use App\Models\Plot;
use App\Models\Project;
use App\Models\SoldLand;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        $projects = Project::factory(4)->create()->pluck('id');
        $documents = Document::factory(20)->create()
            ->each(function ($doc) use ($projects) {
                Plot::factory(1)->create([
                    'document_id' => $doc->id,
                    'project_id' => $projects->random()
                ]);
            })
            ->pluck('id');


        for ($i = 1; $i <= 20; $i++) {
            $docId = $documents->random();
            $plots = Plot::factory(1)->create([
                'project_id' => $projects->random(),
                'document_id' => $docId
            ])->pluck('id');
            $plotId = $plots->random();
            BoughtLand::factory(1)->create([
                'document_id' => $docId
            ]);
            SoldLand::factory(1)->create([
                'plot_id' => $plotId,
            ])->each(function () use ($plotId) {
                $plot = Plot::find($plotId);
                $plot->status = 'sold';
                $plot->save();
            });
        }
    }
}
