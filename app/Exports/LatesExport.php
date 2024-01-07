<?php

namespace App\Exports;

use App\Models\lates;
use App\Models\rayons;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LatesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()-> role == 'ps') {
            $rayon = rayons::where('user_id', Auth::user()->id)->first();

            $late = lates::withCount('students')
            ->whereHas('students', function ($query) use ($rayon) {
                $query->where('rayon_id', $rayon->id);
            })->get();
            return $late;
        }
                // Mengambil semua data terlambat beserta relasi siswa dan menghitung jumlah terlambat
                $lates = lates::with('students')->get();

                // Mengelompokkan data berdasarkan siswa dan menghitung jumlah keterlambatan
                $students = $lates->groupBy('student_id')->map(function ($late) {
                    return [
                        'students' => $late->first()->students,
                        'lates_count' => $late->count()
                    ];
                });
                return $students;
    }

    public function headings(): array
    {
        return [
            "NIS", "Nama", "Rombel", "Rayon", "Total Keterlambatan"
        ];
    }

    public function map($item): array
    {
        if (Auth::user()-> role == 'ps') {
           return [
                $item->students->nis,
                $item->students->name,
                $item->students->rombel->rombel,
                $item->students->rayon->rayon,
                $item->students_count,
            ];
        }
        return [
            $item['students']->nis,
            $item['students']->name,
            $item['students']->rombel->rombel,
            $item['students']->rayon->rayon,
            $item['lates_count'],
        ];
    }
}

// $item->students->nis,
// $item->students->name,
// $item->students->rombel->rombel,
// $item->students->rayon->rayon,
// $item->students_count,
// ];
