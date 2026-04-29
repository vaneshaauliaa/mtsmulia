<?php

namespace App\Filament\Resources\Gurus\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GuruForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_guru')
                    ->required(),
                TextInput::make('nama_guru')
                    ->required(),
                Select::make('jenis_kelamin')
                    ->options(['Laki-laki' => 'Laki laki', 'Perempuan' => 'Perempuan'])
                    ->required(),
                TextInput::make('jabatan')
                    ->require(),
                TextInput::make('no_telp')
                    ->tel()
                    ->required(),
                TextInput::make('alamat')
                    ->required(),
                TextInput::make('tarif_per_jam')
                    ->required()
                    ->numeric(),
            ]);
    }
}
