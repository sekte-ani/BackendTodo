<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Note::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['title' => 'Tugas Akuntansi', 'description' => 'Tugas dikumpulkan kapan saja, lebih cepat lebih baik'],
        ];

        foreach ($data as $value){
            Note::insert([
                'title' => $value['judul'],
                'description' => $value['rangkuman'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
