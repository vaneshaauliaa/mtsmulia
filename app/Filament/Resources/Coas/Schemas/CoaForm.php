<?php

namespace App\Filament\Resources\Coas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;


class CoaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_akun')
                    ->required(),
                TextInput::make('nama_akun')
                    ->required(),
                TextInput::make('header_akun')
                    ->required(),
                TextInput::make('saldo_awal')
                    ->required(),
            ]);
    }
}
