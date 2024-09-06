<?php

namespace App\Http\Controllers;

use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportController extends Controller
{
    public function array()
    {
        $handle = fopen(public_path('users.csv'), 'w');
        fputcsv($handle, ['ID', 'Name', 'Email']);
        User::query()->lazyById(2000, 'id')->each(function ($user) use ($handle) {
            fputcsv($handle, $user->only(['id', 'name', 'email']));
        });

        fclose($handle);

        return response()->download(public_path('users.csv'));
    }

    public function excel()
    {
        return Excel::download(new UsersExport, 'users.csv');
    }

    public function spatie()
    {
        $rows = [];

        User::query()->lazyById(2000, 'id')
            ->each(function ($user) use (&$rows) {
                $rows[] = $user->toArray();
            });
        SimpleExcelWriter::streamDownload('users.csv')
            ->noHeaderRow()
            ->addRows($rows);
    }

    protected function usersGenerator()
    {
        $users = User::query();

        $chunks_per_loop = 3000;
        $user_count = (clone $users)->count();
        $chunks = (int) ceil(($user_count / $chunks_per_loop));

        for ($i = 0; $i < $chunks; $i++) {
            $clonedUser = (clone $users)->skip($i * $chunks_per_loop)
                ->take($chunks_per_loop)
                ->cursor();

            foreach ($clonedUser as $user) {
                yield $user;
            }
        }
    }

    public function fastExcel()
    {
        $filename = 'users.csv';

        (new FastExcel($this->usersGenerator()))->export($filename);

        return response()->download(public_path($filename));
    }
}
